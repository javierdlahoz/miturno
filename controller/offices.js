function OfficesController($scope, $http, $location){
	$http.get('data/offices.json').success(function(data) {
      $scope.offices = data;
  });

	$scope.orderProp = 'organization';
	$scope.goNewOffice = function () {
			$location.path("new");
	};
}

function OfficeDataController($scope, $http, $routeParams){
	$http.get('data/offices/'+$routeParams.id+'.json').success(function(data) {
      $scope.office = data;
  	});
}

function ProductsController($scope, $http){
	$scope.products = [];

	$scope.getProductSearch = function()
		{	$http.post(getDir()+"catalog?method=getProductSearch", {
				query: $scope.search_term
			}).success(function(data) {
			     //console.log(getResponseTag(data));
			      $scope.products = getResponseTag(data);
			      console.log($scope.products)
			  	}).error(function(data) {
			  		console.log("web service error");
			  	}
			  	);
		}
}

function NewOfficeController($scope, $http){
	$http.get("data/cities.json").success(function(data) {
    $scope.cities = data;
	}).error(function(data) {
		console.log("web service error");
	});

	$scope.submit = function(){
		var formData = {
				name: $scope.name,
				phone: $scope.phone,
				address: $scope.address,
				email: $scope.email,
				city: $scope.city
		};

		$http.post(getDir()+"Offices/add.json", formData).success(function(data) {
	    console.log(data);
		}).error(function(data) {
			console.log("web service error");
		});
	};

}