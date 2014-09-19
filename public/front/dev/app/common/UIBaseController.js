/**
 * @ngdoc function
 * @name cacambas_app.controller:UsuariosCtrl
 * @description
 * # UsuariosCtrl
 * Controller of the cacambas_app
 */
app.controller('UIBaseCtrl', ['$scope', '$rootScope', 'ui', 'paths', 'UIBaseService', 'AuthService', '$location', '$routeSegment', 'jquery',

    function($scope, $rootScope, ui, paths, UIBaseService, AuthService, $location, $routeSegment, jquery) {

        // User Profile
        $scope.usuario = AuthService.userProfile();

        // Configuration of ui templates path
        $scope.ui = ui;

        // Variable to control the access to main page, 
        // IF the user not authenticated
        $scope.authorized = AuthService.check();

        // Control Sidebar by current User Roles (authenticated)
        $scope.user_roles = AuthService.userRoles();

        // loading overlay for Logout
        $scope.overlay_loading = false;

        // Spin (Loader) Config
        $scope.spin_opts = {
            lines: 14, // The number of lines to draw
            length: 13, // The length of each line
            width: 6, // The line thickness
            radius: 19, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 77, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#fff', // #rgb or #rrggbb or array of colors
            speed: 2, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'loadspin', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: '0', // Top position relative to parent
            left: '0' // Left position relative to parent  
        };


        // Var to set the menu options and your permissions
        $scope.menu_items = [{
            name: 'Usuários',
            icon: 'users',
            title: 'Lista e Cadastro de Locações',
            url: $routeSegment.getSegmentUrl('ui.usuarios'),
            role: ['operacional']
        }, 
        {
            name: 'Cacambas',
            icon: 'inbox',
            title: 'Lista e Cadastro de Locações',
            url: $routeSegment.getSegmentUrl('ui.cacambas'),
            role: ['financeiro']
        }, 
        {
            name: 'Ajuda',
            icon: 'info-circle',
            css:  'bottom help',
            title: 'Página de Suporte e Ajuda',
            url: '/ajuda',
            role: ['geral', 'publico']
        }];


        // Function for startup the JS of the UI
        $scope.startUI = function() {
            // Make the JS elements of UI
            UIBaseService.start(); 
            // Spin Make, by Spin.js
            $scope.spin = new Spinner($scope.spin_opts).spin();
            // Insert the spin in div (hide initially)
            angular.element('.overlay_loading').html($scope.spin.el);
        };


        /**
         * Open a dropdown for prevent link # problem
         */
        $scope.dropdown = function(elem){
            jquery(elem).dropdown();
        };


        /**
         * Create a New instance of the Sidebar
         */
        $scope.sidebar = function(id) {
            UIBaseService.sidebar(id);

        }


        /**
         * Create a tooltip for sidemenu
         */
        $scope.tooltip = function(cl){
            // Check if already exists
            if(!$scope.hasTip){
                // Set the Bootstrap Tooltip
                jquery('.'+cl).tooltip({
                    container: '#ui-base', 
                    template: '<div class="tooltip sidebar-tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
                });
                // Change the hasTip for True
                $scope.hasTip = true;
            }
        
        }


        /** 
         * Roles function, check if allowed array has intersection
         * with the Roles Array of the Current User (Logged User)
         * @param  {Array} allowed : roles allowed
         * @return {Boolean} show : true (if allowed), false (otherwise)
         */
        $scope.roles = function(allowed) {
            // Init the variable to false (block default)
            var show = false;
            // For each $scope.user_roles (from Authenticated user)
            for (var i = 0, l = $scope.user_roles.length; i < l && !show; i++)
            // Check IF some $scope.user_role is in the allowed array
                if (allowed.indexOf($scope.user_roles[i].nome) !== -1 ||  allowed.indexOf('geral') !== -1 || allowed.indexOf('publico') !== -1)
                // If yes, set the show for true
                    show = true;

            return show;
        };


        


        /**
         * Controller for Logout button / link.
         */
        $scope.logout = function() {
            // Show the overlay
            $scope.overlay_loading = true;

            // Call the API for Logout
            AuthService.logout()
            // Then show the success/error response
            .then(function(response) {
                // Set false the $scope authorized
                $scope.authorized = false;
                // Set false to overlay loading
                $scope.overlay_loading = false;
                // Redirect to login
                $location.path('/login');
            });
        }
        

    }
]);
