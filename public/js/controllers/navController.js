'use strict';

navController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('navController', navController);

function navController($auth, $http, $scope, $location, $route, $routeParams) {

    this.getClass = function(url) {
        let pathFromUrl = $location.path().substr(0, url.length);
        return pathFromUrl === url ? 'activate' : '';
    }

    this.logout = function() {
        $auth.logout()
            .then(function(){
                localStorage.removeItem('satellizer_token');
                localStorage.removeItem('user_logged');
                $scope.isLogged = false;
                $location.path('/');
            });
        this.logged = false;
    }

    this.logged = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    if(!this.logged) {
        $location.path('/');
    }

    this.isTeacher = this.logged.role === 'teacher';
}
