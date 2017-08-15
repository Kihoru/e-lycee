'use strict';

authController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('authController', authController);

function authController($auth, $http, $scope, $location, $route, $routeParams) {

    $scope.logged = localStorage.getItem("user_logged") && localStorage.getItem("satellizer_token");

    if($scope.logged) {
        $location.path('/home');
    }
    //verif déjà loggé


    /*********************************************
    *    Fonction login, authentification par JWT
    *    Input : username + password
    *    Output : Json response
    *********************************************/
    this.login = function() {

        $auth.logout();

        localStorage.removeItem('satellizer_token');
        localStorage.removeItem('user_logged');

        $scope.isLogged = false;
        $scope.isAlertLogin = false;

        let credentials = {
            username: this.username,
            password : this.password
        };

        $auth.login(credentials)
            .then(function(response) {
                if(response.data.error) {
                    $scope.isAlertLogin = true;
                    $scope.alertLogin = response.data.error;
                }else{

                    localStorage.setItem('satellizer_token', response.data.token);
                    localStorage.setItem('user_logged', JSON.stringify(response.data.logInUser));

                    $location.path('/home');
                }
            });
    }
}
