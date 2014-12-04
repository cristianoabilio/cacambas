'use strict';

/**
 * @ngdoc function
 * @name cacambas_app.controller:UsuariosCtrl
 * @description
 * # UsuariosCtrl
 * Controller of the cacambas_app
 */
app.controller('UsuariosCtrl', ['$scope', '$rootScope', '$location', '$routeSegment', 'paths', 'ui', 'UIBaseService', 'AuthService', '$timeout',
    
    function($scope, $rootScope, $location, $routeSegment, paths, ui, UIBaseService, AuthService, $timeout) {

        // Scope local for route segment
        $scope.$routeSegment = $routeSegment;

        // Module Permissions
        $scope.permissions = $routeSegment.chain[0].params.permissions;

        // Configuration of templates path
        $scope.templates = ui;

        // User Interface Title / Heads and SubMenus
        UIBaseService.title('Usuários');

        // SubNavigation Array for Usuarios
        $scope.subnav_items = [{
            name: 'Lista',
            icon: 'icon ion-person-stalker',
            title: 'Usuários',
            subtitle: 'Lista',
            url: $routeSegment.getSegmentUrl('ui.usuarios'),
            role: ['administrador'], 
            css : ''
        },
        {
            name: 'Adicionar',
            icon: 'icon ion-person-add',
            title: 'Adicionar Usuário',
            subtitle: 'Adicionar',
            url: $routeSegment.getSegmentUrl('ui.usuarios.adicionar'),
            role: ['administrador'], 
            css : ''
        }];

        // Set SubNav Items on UIBaseService
        UIBaseService.subnav_items = $scope.subnav_items;

        // Set Default SubTitle, based on subnav_items active
        UIBaseService.setSubTitle(); 

        // Set Data from AuthService
        $scope.usersi = angular.fromJson(AuthService.userRoles());
        

        $scope.teste = function(){
             $timeout(function(){ $scope.usersi =  angular.fromJson(AuthService.userRoles());} , 5000); 
        }

    }
]);





