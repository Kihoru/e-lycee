'use strict';

qcmOneController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmOneController', qcmOneController);

function qcmOneController($auth, $http, $scope, $location, $route, $routeParams) {

    let one = this;

    $http.get('/qcm/'+$routeParams.id).then(function(res) {
        one.datas = res.datas;
        console.log(one.datas);
    });

}
