'use strict';

homeController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('homeController', homeController);

function homeController($auth, $http, $scope, $location, $route, $routeParams) {

    let home = this;

    $http.get('/platform/getHomeDatas').then(function(res) {
        home.datas = res.data;
    }).catch(function(err) {
        console.log(err);
    });

}
