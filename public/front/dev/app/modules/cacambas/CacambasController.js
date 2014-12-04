'use strict';

/**
 * @ngdoc function
 * @name cacambas_app.controller:UsuariosCtrl
 * @description
 * # UsuariosCtrl
 * Controller of the cacambas_app
 */
app.controller('CacambasCtrl', ['$scope', '$rootScope', '$routeSegment', 'paths', 'ui', 'UIBaseService', 'AuthService',

    function($scope, $rootScope, $routeSegment, paths, ui, UIBaseService, AuthService) {
        // Scope local for route segment
        $scope.$routeSegment = $routeSegment;

        // Configuration of templates path
        $scope.templates = ui;

        // User Interface Title / Heads 
        $rootScope.title   = 'Caçambas';
        //Submenu Itens
        $rootScope.submenu = [{
            item : 'Lista'
        }];

        // Pesquisa: true | false
        // sub_menu
        // voltar
        // adicionar
        // SubNavigation Array for Usuarios
        $scope.subnav_items = [{
            name: 'Lista',
            icon: '',
            title: 'Lista dos Cacambas',
            url: $routeSegment.getSegmentUrl('ui.cacambas'),
            role: ['administrador'], 
            css : ''
        },
        {
            name: 'Novo',
            icon: 'plus',
            title: 'Cadastrar uma Cacambas',
            url: $routeSegment.getSegmentUrl('ui.cacambas.add'),
            role: ['administrador'], 
            css : ''
        }];



        $scope.vampetas = AuthService.userRoles();
        $scope.frota = AuthService.userProfile();
        $scope.zica = AuthService.check();



        /*

    $rootScope.title = "Usuários";
    $scope.name = $rootScope.name;
    //$scope.token = $rootScope.token || " ";
    $scope.zica = $rootScope.zica.value;
    //$scope.porra = teste.porra;
    $scope.jabu = "";


    $scope.$watch('zica', function(old, val){
       if(val != old)
            $scope.jabu = jabulani.nome('Alberto');
   });

*/









    }
]);


/*

app.directive('myMenu', ['$window',
  function ($window) {
    return {
      restrict: 'AE',
      template: '',
      link: function(scope, element, attrs) {
          var menu = angular.fromJson(attrs.myMenu);
          var build = function () {
              var list = '';
              angular.forEach(menu, function (v, k) {
                  list = list + '<li><a href="#/' + v.route + '">' + v.title + '</a></li>';
              });
              element.html('<ul>' + list + '<ul>');
              angular.element(element).mmenu({ 
                  slidingSubmenus : true,
                    dragOpen  : false,
                    onClick: {
                        preventDefault  : false,
                        setSelected     : false
                    }
              });
          };
          scope.$watch(attrs.myMenu, function(newValue, oldValue) {
              menu = angular.fromJson(newValue);
              build();
          });
      }
    };
  }
])
;*/
