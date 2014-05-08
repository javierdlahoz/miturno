function IndexController($scope,$rootScope, $http, MenuStatus){
	$scope.loggedIn = false;
	
	$http.get(getDir()+"Users/isLoggedIn.json").success(function(data) {
			      $scope.loggedIn = data.response.status;
			 }).error(function(data) {
			  		console.log("error en el servicio web");
	});
			 
	$scope.$on('event:menu-success', function (event, args) {
        $scope.loggedIn = args;
    });
}