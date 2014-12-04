'use strict';


/**
 * @ngdoc overview
 * @name cacambas_app
 * @description
 * Main module of the AngularJS Application
 * for Caçambas SaaS
 */
var app = angular.module('cacambas_app', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ngRoute',
    'ngAnimate',
    'route-segment',
    'view-segment', 
    "trNgGrid"
]);


/**
 * Paths for content
 */
app.constant('paths', (function() {

    // Change Path for productuion
    var path = '/public/front/dev/';

    return {

        views: path + 'views',
        modules: path + 'views/modules',
        ui: path + 'views/ui',
        partials: path + 'views/partials',
        images: path + 'images',
        videos: path + 'images/videos'

    }

})());


/**
 * Paths for templates (partials) for include.
 */
app.constant('ui', (function() {

    // Change Path for productuion
    var partials = 'front/dev/views/partials/';

    return {

        header: partials + 'header.tpl.html',
        section: partials + 'section.tpl.html',
        footer: partials + 'footer.tpl.html',
        sidebar: partials + 'sidebar.tpl.html',
        subnav: partials + 'subnav.tpl.html',
        profile: partials + 'profile.tpl.html'
    }

})());


/**
 * UI Messagens Constant
 * @type {JSON}
 */
app.constant('ui_messages', {
    credentials             : "Informe seu usuário e senha!", 
    auth_error              : "Seu usuário ou senha estão incorretos!", 
    token                   : "Token Inválido. Tente novamente.",
    auth_exception          : "Erro no Login. Tente novamente", 
    validation_error_login  : "Preencha o usuário e a senha!", 
    auth_login_error        : "Seu usuário está bloqueado. ", 
    email                   : "Informe um email válido!", 
    remind_invalid_user     : "O email informado não está cadastrado!", 
    reset_password          : "As senhas devem ser iguais!", 
    reset_token             : "Token inválido! Entre em contato por email"
});


/**
 * Angular constant for Jquery global name
 */
app.constant('jquery', angular.element);


/**
 * Angular constant for types of profiles (roles) 
 * for access control in pages
 */
app.constant('roles', {
    publico        : 'publico',
    geral          : 'geral',
    administrador  : 'administrador',
    operacional    : 'operacional',
    financeiro     : 'financeiro',
    motorista      : 'motorista',
    cliente        : 'cliente'
});


/**
 * Common wrap for sessionStorage 
 * @return {functions} get | set | unset 
 */
app.factory("StorageService", function() {
    return {
        get: function(key) {
            return angular.fromJson(localStorage.getItem(key));
        },
        set: function(key, val) {
            return localStorage.setItem(key, angular.toJson(val));
        },
        unset: function(key) {
            return localStorage.removeItem(key);
        }, 
        destroy : function(){
            this.unset('authenticated');
            this.unset('user_profile');
            this.unset('user_roles');
            this.unset('user_session'); 
        }
    }
});


/**
 * Configuration of the front-end routes.
 * @param  {angular}  $routeProvider: provider for front routes.
 * @param  {constant} paths : constant for sources paths.
 */
app.config(['$routeSegmentProvider', '$routeProvider', 'roles', 'paths', 
    
    function($routeSegmentProvider, $routeProvider, roles, paths) {

        // Configuring provider options  
        $routeSegmentProvider.options.autoLoadTemplates = true;
        $routeSegmentProvider.options.strictMode        = false;
        


        // Setting routes:
        // 1. `when` is similar to $route `when` but takes segment name instead of params hash
        // 2. traversing through segment tree to set it up
        $routeSegmentProvider


        // Map Routes and your segment names 
        .when('/login',              'login')
        .when('/reset/:token',       'reset')

        .when('/usuarios',           'ui.usuarios')
        .when('/usuarios/adicionar', 'ui.usuarios.adicionar')

        .when('/cacambas',           'ui.cacambas')
        .when('/cacambas/add',       'ui.cacambas.add')


        // Login Segment 
        .segment('login', {
            templateUrl: paths.modules + '/login/login.tpl.html',
            controller: 'LoginCtrl',
            permissions: {
                required: false,
                roles: [roles.publico]
            },
            resolve: {
                data: ['$location', 'AuthService', function($location, AuthService) {
                    if(AuthService.check()){
                        // Test if login_menu has first time or not
                        if(AuthService.menu_login > 1){
                            // Remove mmenu from login page
                            angular.element('#menu').remove();
                            angular.element('#mm-menu').remove();
                            angular.element('#mm-01').remove();    
                        }
                        // Change the value for not appear anymore if logged
                        AuthService.menu_login += 1;
                        // Change location if user has authenticated
                        $location.path('/usuarios');
                    } 
                }]
            }
        })


        // UI Segment Tree (thus, not necessary reload the UI)
        .segment('reset', {
            templateUrl: paths.modules + '/login/reset.tpl.html',
            controller: 'LoginCtrl',
            permissions: {
                required: false,
                roles: [roles.publico]
            }
        })


        // UI Segment Tree (thus, not necessary reload the UI)
        .segment('ui', {
            templateUrl: paths.ui + '/base.tpl.html',
            controller: 'UIBaseCtrl',
            permissions: {
                required: true,
                roles: [roles.geral]
            }
        })

        .within()

            .segment('usuarios', {
                    templateUrl: paths.partials + '/section.tpl.html',
                    controller: 'UsuariosCtrl',
                    permissions: {
                        required: true,
                        roles: [roles.administrador]
                    }
                })

            .within()

                .segment('adicionar', {
                        templateUrl: paths.modules + '/usuarios/adicionar.tpl.html',
                        controller: 'UsuariosCtrl',
                        permissions: {
                            required: true,
                            roles: [roles.administrador]
                        }
                    })

                .segment('lista', {
                        default: true, 
                        templateUrl: paths.modules + '/usuarios/lista.tpl.html',
                        controller: 'UsuariosCtrl',
                        permissions: {
                            required: true,
                            roles: [roles.administrador]
                        }
                    })
        
            .up()
                
            .segment('cacambas', {
                templateUrl: paths.partials + '/section.tpl.html',
                controller: 'CacambasCtrl',
                permissions: {
                    required: true,
                    roles: [roles.operacional]
                }
            })

             .within()

                .segment('add', {
                    templateUrl: paths.modules + '/cacambas/add.tpl.html',
                    controller: 'CacambasCtrl',
                    permissions: {
                        required: true,
                        roles: [roles.operacional]
                    }   
                })


        .up();


        // Routes Not Found
        $routeProvider.otherwise({
            resolve: {
                data: function(StorageService, $location) {
                    // IF user has logged 
                    if(StorageService.get('authenticated'))
                        $location.path('/usuarios');
                    // Else redirect to login
                    else
                        $location.path('/login');
                }
            }
        });


    }
]);



/**
 * Interceptor for checking if session on server was expired
 * @param  {config} $httpProvider
 */
app.config(['$httpProvider', function($httpProvider) {

    // Set the interceptor
    $httpProvider.interceptors.push(function($location, $q, StorageService) {
        return {
            'responseError': function(rejection) {
                // IF Session Expired
                if(rejection.status === 401) {
                    // IF path != login, then
                    if($location.path != 'login') {
                        // Destroy local session
                        StorageService.destroy();
                        // Redirect to login
                        $location.path('/login');
                    }
                }
                // Reject the promise
                return $q.reject(rejection);
            }
        };
    });

}]);




/** 
 * Run of the App
 */
app.run(['$rootScope', '$http', '$location', 'AuthService', '$route', '$routeSegment', 'UIBaseService', '$timeout',
    
    function($rootScope, $http, $location, AuthService, $route, $routeSegment, UIBaseService, $timeout) {

        // Block Login UI when user is logged
        AuthService.menu_login = AuthService.check() ? 1 : 2;

        // Fix the complete block of the views if not logged
        $rootScope.login_block = true;
        $rootScope.show_login_page = true;
        $rootScope.mm_page = '';

        // Initial Prev route for back
        $rootScope.prev = ($location.path() != 'login') ? $location.path() : '/home';

        // Prev route watcher
        $rootScope.$on("$routeChangeStart", function(event, next, current) {
            try {
                $rootScope.prev = current.segment.split('.').pop();
            }
            catch(err){
                console.log(err);
            }
        });

        // Event watcher for route change success
        $rootScope.$on("$routeChangeSuccess", function(event, next, current) {
            // IF user has logged and path == login
            if($location.path() == '/login' && AuthService.check()){
                // Init the BaseUI if the user already logged >1 time
                if (AuthService.menu_login > 1)
                    UIBaseService.start();

                // Block the login page and redirect to prev route
                $location.path($rootScope.prev);
            }

            // IF prev route was login, 
            else if($rootScope.prev == 'login') {
                // Init the UI Base
                UIBaseService.start();
            }
        });


        // Event for route Segment change (nested views)
        $rootScope.$on("routeSegmentChange", function(event, route) {
            
            // For fix the style of the page: view login or view content
            $rootScope.view_active = $location.path() == '/login' ? 'view_login' : 'view_content';

            // Block the login page IF the user already is logged
            $rootScope.login_block = !AuthService.check() ? true : false;
            $rootScope.show_login_page = AuthService.check() ? false : true;


            // Code for get the current segment object array (can be a Single segment or Tree segment - for nested vies)
            $rootScope.chains = $routeSegment.chain !== undefined && $routeSegment.chain !== null ? $routeSegment.chain : $rootScope.chains;
            // Get the last chain segment (if array)
            $rootScope.chain = $rootScope.chains[$rootScope.chains.length-1] || $rootScope.chain;
            // Get the segment name
            $rootScope.chain_name = $rootScope.chain.name !== undefined ? $rootScope.chain.name : $rootScope.chain_name;
            // Get in the current segment, the permissions for role access - for compare with the user role
            $rootScope.permissions = $rootScope.chain.params.permissions || $rootScope.permissions;
            // Get flag IF the page Require Login
            $rootScope.required_login = $rootScope.permissions.required;
        

            // Block the page if permissions not matched with the current user role
            if (AuthService.check()){
                // Current Page (Segment) roles (profiles)
                var auth_roles = $rootScope.permissions.roles;
                // User Logged Roles
                var user_roles = AuthService.userRoles();
                // Var for block page by role
                $rootScope.allowed = false;
                // Check IF current segment roles are indexOf by least one user_roles
                for (var i = 0, l = user_roles.length; i < l && !($rootScope.allowed); i++)
                    if (auth_roles.indexOf(user_roles[i].nome) !== -1 || auth_roles.indexOf('geral') !== -1 || auth_roles.indexOf('publico') !== -1)
                        $rootScope.allowed = true;

                // IF not Allowed, redirect to usuarios
                if (!$rootScope.allowed)
                    $location.path('/usuarios');
            }


            // IF current segment is Login and user not logged
            if($rootScope.chain_name == 'login' && !AuthService.check()){
                // Remove the UI Base and Menu classes
                angular.element('#menu').remove();
                angular.element('#mm-1').remove();
                angular.element('#app-content').removeClass('mm-page');
                $timeout(function(){$rootScope.mm_page = 'mm-page'}, 200);
            }


            // IF the current route != login 
            if ($rootScope.chain_name != 'login')
                // IF user not logged, but page Require Login, then
                if(!AuthService.check() && $rootScope.required_login)
                    // Block the page and redirect to login
                    $location.path('login');


            // IF the current segment is login, but user already is logged
            if ($rootScope.chain_name == 'login' && AuthService.check()){
                // redirect to prev route
                $rootScope.mm_page = 'mm-page';
                $location.path($rootScope.prev); // change to previous hote
            }
            
        });

    }
]);
