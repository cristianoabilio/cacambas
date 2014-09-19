'use strict';

/**
 * @ngdoc function
 * @name cacambas_app.controller:UsuariosCtrl
 * @description
 * # UsuariosCtrl
 * Controller of the cacambas_app
 */
app.controller('UsuariosCtrl', ['$scope', '$rootScope', '$routeSegment', 'paths', 'ui', 'UIBaseService',
    
    function($scope, $rootScope, $routeSegment, paths, ui, UIBaseService) {

        // Scope local for route segment
        $scope.$routeSegment = $routeSegment;

        // Module Permissions
        $scope.permissions = $routeSegment.chain[0].params.permissions;

        // Configuration of templates path
        $scope.templates = ui;

        // User Interface Title / Heads and SubMenus
        $rootScope.title = 'Usuários';

        // UI configs and make (draw)
        // ID of Sidebar
        $scope.geba = function() {

            //angular.element('#menu').remove();
            //angular.element( "#menu" ).remove();

        };

        $scope.buceta = function() {
            UIBaseService.start();

        }



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
