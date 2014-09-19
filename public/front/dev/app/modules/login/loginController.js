/**
 * @ngdoc function
 * @name cacambas_app.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the cacambas_app
 */
app.controller('LoginCtrl', ['$scope', '$rootScope', '$routeSegment', '$routeParams', '$location', '$timeout', '$q', '$log', 'AuthService', 'paths', 'ui_messages',

    function($scope, $rootScope,  $routeSegment, $routeParams, $location, $timeout, $q, $log, AuthService, paths, ui_messages) {

        // Scope local for route segment
        $scope.$routeSegment = $routeSegment;

        // Module Permissions
        $scope.permissions = $routeSegment.chain[0].params.permissions;

        // Var for login in / reset flipping
        $scope.flip = null;

        // Var for shake effect
        $scope.shake = null;

        // Loading variable for class loading
        $scope.load      = null;

        // Credentials for login
        $scope.credentials = {
            usuario : null, 
            senha   : null
        };

        $scope.remember = {
            email : null
        };

        $scope.reset_pass = {
            email  : null, 
            pass_a : null, 
            pass_b : null, 
            token  : null
        };

        // JSON for Messages Error
        $scope.feedback = ui_messages;

        // CSS Class for error display
        $scope.error_pass = false;
        $scope.error_pass2 = false;
        $scope.error_user = false;
        $scope.error_email = false;
        $scope.error_msg  = false;
        $scope.error_compare_pass = false;

        // CSS Class for reminder password email sent and reset success
        $scope.remind_sent = false;
        $scope.reset_sent =  false;

        // Rand index for Background List
        $scope.bg_index = Math.floor((Math.random() * 2) + 1) - 1;

        // Backgrounds Paths and Configs 
        $scope.bg_paths = [{
            video: { 
                mp4:  paths.videos + '/video-001.mp4',
                ogv:  paths.videos + '/video-001.ogv',
                webm: paths.videos + '/video-001.webm'
            },
            background: 1
        }, {
            video: {
                mp4:  paths.videos + '/video-002.mp4',
                ogv:  paths.videos + '/video-002.ogv',
                webm: paths.videos + '/video-002.webm'
            },
            background: 2
        }];


        // Spin (Loader) Config
        $scope.spin_opts = {
            lines: 14, // The number of lines to draw
            length: 13, // The length of each line
            width: 6, // The line thickness
            radius: 19, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 77, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#666', // #rgb or #rrggbb or array of colors
            speed: 2, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'loadspin', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: '0', // Top position relative to parent
            left: '0' // Left position relative to parent  
        };
        
        // Spin
        $scope.load_spin = false;


        // Check for autofill (remember pass) in Firefox
        $scope.autofill = function(){
            var a = angular.element('#usuario').val(), 
                b = angular.element('#senha').val();

            if ((a !== null && b !== null) && (a != '' && b != '')){
                $scope.credentials.usuario = a;
                $scope.credentials.senha = b;
                return true;
            }
            else
                return false;
        };

        // Show the loading
        $scope.loading = function(){
            // Spin Make, by Spin.js
            $scope.spin = new Spinner($scope.spin_opts).spin();
            // Insert the spin in div
            angular.element('.load-spin').html($scope.spin.el); 

            // Load class for load in click button
            $scope.load = $scope.load == 'load' ? 'unload' : 'load';
            // Toogle spin
            $scope.load_spin = $scope.load == 'load' ? true :  $timeout(function(){ return false; }, 500);           
        };


        // Firefox Problem 
        $scope.ff_hide = 'ff_hide';
        $timeout(function(){$scope.ff_hide = ''}, 100);


        // Return a Dynamic Background for Login 
        $scope.getBG = function() {
            return $scope.bg_paths[$scope.bg_index];
        };


        // Method for set flip property
        $scope.flipping = function() {
            // Hide Error Messages
            $scope.error_msg = false;

            // Remove loading
            $scope.load = null;

            $timeout(function(){$scope.flip = $scope.flip !== null ? null : 'hover'}, 100);
        }


        // Add shake class for alert
        $scope.shaking = function() {
            // Add Class Shake
            $scope.shake = $scope.shake !== null ? null : ' animated shake ';
            // Remove class Shake
            $timeout(function(){ $scope.shake = null }, 700);
        }


       

        // Validation the input for show the class
        $scope.validation = function(input_data, error){
            return ((input_data.$invalid && !input_data.$pristine) || error) ? true : false;
        };


        // Set the error messages based on response text error
        $scope.showMessage = function(error){

            // Show Div for Error message with timeout 
            $timeout(function(){
                $scope.error_msg = true;
            }, 600);
          
            // Error message for token CSRF
            if (error.message == 'auth-token-exception')
                $scope.message = $scope.feedback.token;

            else if (error.message == 'reset-invalid-token')
                $scope.message = $scope.feedback.reset_token;

            else if (error.message == 'auth-login-error')
                $scope.message = $scope.feedback.auth_login_error;

            // Error message for Login Exception
            else if (error.message == 'auth-login-exception')
                $scope.message = $scope.feedback.auth_exception;

            else if (error.message == 'remind-invalid-user' || error.message == 'reset-invalid-user')
                $scope.message = $scope.feedback.remind_invalid_user;

            else if (error.message == 'reset-invalid-password')
                $scope.message = $scope.feedback.reset_password;

            else {  
                // Error message for not authorized in backend  
                if (error.message == 'auth-not-authorized')
                    $scope.message = $scope.feedback.auth_error;

                // Error message if validation fail on backend                
                else if (error.message == 'auth-validator-fail')
                    $scope.message = $scope.feedback.validation_error_login;
                
                // Icon errors on fields of the Login
                $scope.error_user = true;
                $scope.error_pass = true;
            }

        };


        /** 
         * Redirect to home path if logged
         */
        $scope.endLogin  = function(){
            $location.path('usuarios');
        };

        


        /**
         * Login: Function for control the login attempt proccess 
         * @param  {Boolean} is_valid: sent for view, a ng-valid for form_data
         */
        $scope.login = function(is_valid){
            // Error Div for false
            $scope.error_msg = false;

            is_valid = (is_valid) ? true : $scope.autofill();

            // IF form_data is valid 
            if(is_valid) {
                
                // Loading animation and insert Spin for UI
                $scope.loading();

                
                // Attempt to Login with credentials, via AuthService
                AuthService.attempt($scope.credentials)
                            // After running attempt(), check the response, and
                            // redirect to home path
                            .then($scope.endLogin)
                            // Catch for custom errors
                            .catch(
                                // Function error for catch
                                function(error){                       
                                    // Toggle the Spin
                                    $scope.loading();
                                    
                                    // Message error
                                    $scope.showMessage(error);  
                                }
                            );
            }

            else {
                // Add shaking class
                $scope.shaking();
        
                if($scope.credentials.usuario === null || $scope.credentials.usuario === undefined)
                    $scope.error_user = true;

                if($scope.credentials.senha === null || $scope.credentials.senha === undefined)
                    $scope.error_pass = true;
            }  
        };




        // Functions for Remind and Reset password on Login

        // Function for show the success message DIV after email has sent
        $scope.remindSuccess = function(response){
            $scope.load_spin = false;
            $timeout(function(){  $scope.remind_sent = (response.message == 'remind-sent') ? true : false; }, 150);   
        };


        // Function for check if two passwords are equal. 
        $scope.match = function(){
            var status =  angular.equals($scope.reset_pass.pass_a, $scope.reset_pass.pass_b);
            // set the CSS error on field for pass_comparison
            $scope.error_pass2 = !status;

            // Reset Error after Post
            if($scope.message !== null)
                if (!status){
                    $scope.message = $scope.feedback.reset_password;
                    $scope.error_msg = false;
                }

            // return the status
            return !status;
        };


        // Function for block the error css class on pass_confirmation 
        // on reset password view
        $scope.error_match = function(a, b){        
            var v = ((a.$invalid) || (b.$invalid || b.$pristine) ) ? true : false;
            
            if(v)
                $scope.error_compare_pass = false; 
            else 
                $scope.error_compare_pass = (!($scope.match())) ?  false : true; 

            return v;
        };


        /** 
         * Set the Token for change the password 
         */
        $scope.resetToken = function(){
            $scope.reset_pass.token  = $routeParams.token ;
        };


        // Function for show the success message DIV after pass change success
        $scope.resetSuccess = function(response){
            $scope.load_spin = false;
            $timeout(function(){  $scope.reset_sent = (response.message == 'reset-password-success') ? true : false; }, 150);  
            $timeout(function(){  $location.path('/login');  }, 1500);   
        };


        /** 
         * Post Form Controller for Reset Password
         * @param  {Boolean} is_valid : form is valid or not
         */
        $scope.reset = function(is_valid){
            
            if(is_valid){
                // Loading animation and insert Spin for UI
                $scope.loading();
                // Set error false
                $scope.error_msg = false;
                

                // Post via AuthService the credentials
                // with the new pass and the token 
                AuthService.reset($scope.reset_pass)
                            // Success sent the remind
                            .then($scope.resetSuccess)
                            // Catch for custom errors
                            .catch(
                                // Function error for catch
                                function(error){                       
                                    // Toggle the Spin
                                    $scope.loading();
                                    // Message error
                                    $scope.showMessage(error);
                                }
                            );
            }
            // Not Valid Form
            else {
                // Add shaking class
                $scope.shaking();
                
                // Errors class
                if($scope.reset_pass.email === null || $scope.reset_pass.email === undefined)
                    $scope.error_email = true;

                if($scope.reset_pass.pass_a === null || $scope.reset_pass.pass_a === undefined)
                    $scope.error_pass = true;

                if($scope.reset_pass.pass_b === null || $scope.reset_pass.pass_b === undefined)
                    $scope.error_pass2 = true;                

            }
        };


        /**
         * Forgot: function for control the reminder password. 
         * 
         * @param  {Boolean} is_valid - validation of the form data
         */
        $scope.forgot = function(is_valid){
            
            if(is_valid){
                // Loading animation and insert Spin for UI
                $scope.loading();
                // Set error false
                $scope.error_msg = false;

                AuthService.remind($scope.remember)
                            // Success sent the remind
                            .then($scope.remindSuccess)
                            // Catch for custom errors
                            .catch(
                                // Function error for catch
                                function(error){                       
                                    // Toggle the Spin
                                    $scope.loading();              
                                    // Message error
                                    $scope.showMessage(error);  
                                    // show class Error
                                    $scope.error_email = true;
                                }
                            );
            }

            else {
                // Add shaking class
                $scope.shaking();
                // IF email has null, show error icon + class
                if($scope.remember.email === null || $scope.remember.email === undefined)
                    $scope.error_email = true;

                if($scope.remember.email !== null){
                    // Set Message Error;
                    $scope.message = $scope.feedback.email;
                    // Show the message on ui
                    $timeout(function(){$scope.error_msg = true;}, 1000);
                }
            }
        }




    }
]);
