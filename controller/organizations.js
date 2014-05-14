function OrganizationsMain($scope, $routeParams, $http){
	switch($routeParams.url)
        {
            case 'main':
                $scope.templateUrl = 'partials/organizations/main.html';
                break;
            case 'myoffices':
                $scope.templateUrl = 'partials/organizations/myoffices.html';
                $http.get(getDir()+"Offices/index.json").success(function (data){
                    $scope.offices = data.offices;
                    console.log($scope.offices);
                });
                break;
            case 'edit_office':
              	$scope.templateUrl = 'partials/organizations/edit_office.html';
              	$scope.controller = "edit_officeController"
                break;
            default:
                $scope.templateUrl = 'partials/organizations/welcome.html';
        }
}

function edit_officeController($scope, $routeParams, $http){
	var result;
  var id =1;
}

function officesListController($http){
  var offices;
  $http.get(getDir()+"Offices/index.json").success(function (data){
    offices = data.offices;
  });
}