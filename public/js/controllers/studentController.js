'use strict';

studentController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('studentController', studentController);

function studentController($auth, $http, $scope, $location, $route, $routeParams) {

    let student = this;

    student.currentUser = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    if(student.currentUser.role !== 'teacher') $location.path('/');

    $http.get("/students").then(function(res) {
        let datas = res.data.students;

        for(let i = 0; i < datas.length; i++) {
            if(datas[i].nb && datas[i].score) {
                datas[i].total = datas[i].score / datas[i].nb;
            }
        }

        student.datas = datas;
    });

}
