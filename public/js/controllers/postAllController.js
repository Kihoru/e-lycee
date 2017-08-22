'use strict';

postAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postAllController', postAllController);

function postAllController($auth, $http, $scope, $location, $route, $routeParams) {
    
    $http.get('/post').then(function(res) {
    	console.log(res.data);
    });
}
