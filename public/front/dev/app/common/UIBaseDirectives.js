app.directive('subnavItems', ['$rootScope', '$location', function ($rootScope, $location) {
    return {
        restrict: 'E',
        scope: {
            items: '=' //Two-way data binding for items of the menu
        },
        template: '<ul id="main-tabs" class="nav nav-tabs mm-fixed-top text-center">'+
                        '<li ng-repeat="v in items" class="{{v.css}}">'+
                            '<a href="#{{v.url}}" class="text-muted"><i ng-if="v.icon" class="{{v.icon}}"></i> {{v.name }}</a>' +
                        '</li>'+
                    '</ul>',
      
        transclude: true,
        replace: true,
      
        link: function(scope, element, attrs) {
            
            // For set the active tab css 
            var setActive = function(){
                scope.$evalAsync(function() {
                    for (var i = 0, l = scope.items.length; i < l; i++)
                        scope.items[i].css = scope.items[i].url == $location.path() ? 'active' : '';
                });
            };
         
            // Call setActive on route Change
            $rootScope.$on("$routeChangeSuccess", function(event, next, v) {
                setActive();
            });

            // First execution 
            setActive();

        }
    };
}]);