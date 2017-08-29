'use strict';

navController.$inject = ['$auth', '$scope', '$location'];

angular.module('elycee').controller('navController', navController);

function navController($auth, $scope, $location) {

    this.getClass = function(url) {
        let pathFromUrl = $location.path().substr(0, url.length);
        return pathFromUrl === url ? 'activate' : '';
    }

    // Initialize collapse button
    $(".button-collapse").sideNav();
    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    //$('.collapsible').collapsible();


    this.logout = function() {
        $auth.logout()
            .then(function(){
                sessionStorage.removeItem('satellizer_token');
                sessionStorage.removeItem('user_logged');
                $scope.isLogged = false;
                $location.path('/');
            });
        this.logged = false;
    }

    this.logged = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

    if(!this.logged) {
        $location.path('/');
    }

    this.isTeacher = this.logged.role === 'teacher';
}
