ikApp.controller('IndexController', function($scope) {});

ikApp.controller('ScreensController', function($scope, screenFactory) {
    $scope.screens = screenFactory.getScreens();
});
