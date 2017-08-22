'use strict';

homeController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('homeController', homeController);

function homeController($auth, $http, $scope, $location, $route, $routeParams) {

    let home = this;

    home.currentUser = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    home.isTeacher = home.currentUser.role === "teacher";

    if(home.isTeacher) {
        $http.get('/platform/getHomeDatas').then(function(res) {
            home.datas = res.data;
        });
    }else{
        $http.post('/platform/getStudentHomeDatas', {user_id: home.currentUser.id}).then(function(res) {
            home.datas = res.data.totalScore;
        });
    }





}
