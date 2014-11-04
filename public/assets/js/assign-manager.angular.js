var assignManagerApp = angular.module('assignManagerApp', []);

assignManagerApp.controller('ManagerZoneListCtrl', function ($scope, $http) {
    $scope.formData = {};
   
    $http.get('/api/user/ManagerZone')
    .success(function(data) {
        $scope.managers = data;
    })
    .error(function(data) {
        console.log('Error: ' + data);
    });

    $scope.assign = function(id, manager) {
        $http.post('/customer/assign', {'id' : id, 'manager' : manager})
        .success(function(data) {
            $("#modal").modal('hide');
            $("#assign").text('Asignado').removeClass('btn-primary').addClass('btn-success').prop('id', 'assigned');
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
    };

});
