/**
 * @ngdoc service
 * @name cacambas_app.service:AuthService
 * @description
 * # AuthService
 * Service for set the properties and functions for Authentication.
 * The service manage the $http requests with backend, CSRF token,
 * sessions (local storage), current_user data, profiles and remind / reset passwords
 */
app.service('AuthService', ['$rootScope', '$http', '$q', '$sanitize', 'StorageService',
    
    function($rootScope, $http, $q, $sanitize, StorageService) {

        // Block Login UI when user is authenticated
        this.menu_login = null;


        // Method for set the Roles of the user in LocalStorage 
        // (from API response)
        var setRoles = function(data_roles){
            
            var roles = [];

            // For each user role
            for (var size = data_roles.length, i = 0; i < size; i++){
                // Create a JSON Custom
                var role = {
                    id        : data_roles[i].id,
                    nome      : data_roles[i].nome,
                    descricao : data_roles[i].descricao,
                    status    : data_roles[i].pivot.status // Status of the User role authenticated
                };
                // Set the role in roles array
                roles.push(role);
            }
            // Store the roles in LocalStorage, 
            // with user_roles key
            StorageService.set('user_roles', roles);
        };


        // Method for set the user data in LocalStorage
        // From API response
        var setUser = function(data){
            // Create a custom JSON
            var user = {
                id             : data.id,
                nome           : data.nome,
                email          : data.email, 
                login          : data.login,
                remember_token : data.remember_token,
                last_activity  : data.updated_at 
            };
            // Store the JSON in LocalStorage
            StorageService.set('user_profile', user);
        };


        /**
         * [setToken] check rootScope and set the csrf token
         * IF    opt == 'head', the token is get from header
         * ELSE  the token is get from API backend
         */
        var setToken = function(opt) {
            var that = this;
            // Check if user has logged first time
            if (opt == 'head')
                // Set the $http.defaults.headers
                $http.defaults.headers.common['X-CSRF-Token'] = $rootScope.token;

            else {
                // Call the API for get token
                $http.get('/backend/auth/token')
                // If call success
                .success(function(token, status, headers, config) {
                    // Set default header for future post http
                    $http.defaults.headers.common['X-CSRF-Token'] = token;
                    $rootScope.token = token;
                    //that.token = token;
                })
                // If request error 
                .error(function(data, status, headers, config) {
                    console.log('Not get a valid token!');
                });
            }
        };


        // Return the user authenticated session
        this.userSession = function(){
            return StorageService.get('user_session');
        };   


        // Return the user authenticated profile (user data)
        this.userProfile = function(){
            return StorageService.get('user_profile');
        };


        // Return the roles of the user authenticated 
        this.userRoles = function(){
            return StorageService.get('user_roles');
        };


        // Call the set token IF the user not authenticated
        this.getToken = function(opt){
            if(!StorageService.get('authenticated'))
                setToken(opt);
        };


        // Method to call API for logout the user 
        this.logout = function(){
           var that = this;

           // IF user is logged
           if (this.check())
                //Return a promise with the $http and the response
                return $http.get('/backend/logout')
                    // Success function
                    .success(function(response){
                        // Destroy the Session on LocalStorage
                        StorageService.destroy();
                        // Set null for CSRF Token
                        $http.defaults.headers.common['X-CSRF-Token'] = null;
                        // Fix the bug of the Token
                        // IF user tried to access to log in
                        // after being authenticated 
                        // OR the user has login and logout for first time
                        if(that.menu_login <= 2)
                            // then get the token via HTTP
                            that.getToken('http');
                    })
                    // Error Function
                    .error(function(error){
                        return error;
                    });
        };


        /**
         * Check if user is logged
         * @return {boolean} true if the user has logged
         */
        this.check = function() {
            // If not exists the session, user not logged
            return StorageService.get('authenticated');
        };


        /**
         * Reset function to call the backend for reset the password 
         * of the user by a token sent for the email
         * @param  {JSON} credentials : object with the credentials
         * @return {angular.promise}  : with the response from API
         */
        this.reset = function(credentials){
            // Return a promise from HTTP, afther running then
            return $http.post("/password/reset", {

                email                 : $sanitize(credentials.email), 
                password              : $sanitize(credentials.pass_a),
                password_confirmation : $sanitize(credentials.pass_b),
                token                 : $sanitize(credentials.token)

            })
            // Run Success or Fail response
            .then(
                // Success Function
                function(response){
                    return response.data;
                }, 
                // Error function
                function(error){
                    throw error.data;
                }
            );
        };


        /**
         * Function for send a email with password reset (reminder)
         * @param  {[JSON]} remember : object with the email of the user
         * @return {[angular.promise]} with response of the http
         */
        this.remind = function(remember){
            // Return a promise from HTTP, afther running then
            return $http.post("/password/remind", {

                email : $sanitize(remember.email)

            })
            // Run Success or Fail response
            .then(
                // Success Function
                function(response){
                    return response.data;
                }, 
                // Error function
                function(error){
                    throw error.data;
                }
            );
        };


        /**
         * [attempt] Make or not the loggin for an user
         * @return {angular.$promise} with the resolve of http request
         */
        this.attempt = function(credentials) {
            
            // Check if the user is not logged
            if(!this.check()){

                // Set Token 
                this.getToken('head');

                // Return a promise from HTTP, after running then
                return $http.post("/backend/login", {
                    
                    usuario: $sanitize(credentials.usuario),
                    senha: $sanitize(credentials.senha)

                })
                // Run then for success or fail of the request 
                .then(
                    // Success Function
                    function(response, status, headers, config) {
                        
                        // Set Flag 
                        StorageService.set('authenticated', true);
                        // Set Session
                        StorageService.set('user_session', response.data.data.sessao);
                        // Set the User Roles
                        setRoles(response.data.data.perfis);
                        // Set the User data (profile)
                        setUser(response.data.data.usuario);
                        // return response
                        return response.data;                    
                    },
                    // Error Function
                    function(reason, status, headers, config) {
                        // Type exception error
                        var type_exception =  (reason.data.error !== undefined) ? reason.data.error.type.split(/\\/)[2] : null;

                        // If status == 500 or is Exception, is a invalid token 
                        if(reason.status === 500 && type_exception == "TokenMismatchException")
                            // Error Exception in JSON pattern
                            throw error = {
                                'success' : false,
                                'message' : 'auth-token-exception', 
                                'data'    : {'error' : reason.data.error}
                            };
        
                        // Error for Status 401, not authorized
                        else if(reason.status === 401 || reason.status === 400)
                            throw reason.data;                
                    }

                ); 
            }

        };



    }
]);
