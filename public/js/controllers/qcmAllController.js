'use strict';

qcmAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmAllController', qcmAllController);

function qcmAllController($auth, $http, $scope, $location, $route, $routeParams) {

    $('.modal').modal();

    let all = this;

    this.logged = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    this.isTeacher = this.logged.role === 'teacher';

    $http.get('/platform/qcm/getAll').then(function(res) {
        all.datas = res.data;
        console.log(all.datas);
    }).catch(function(err) {
        console.log(err);
    });

}
