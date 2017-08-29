'use strict';

homeController.$inject = ['$http'];

angular.module('elycee').controller('homeController', homeController);

function homeController($http) {

    let home = this;

    home.currentUser = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

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
