'use strict';

qcmAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmAllController', qcmAllController);

function qcmAllController($auth, $http, $scope, $location, $route, $routeParams) {

    $('.modal').modal();


}
