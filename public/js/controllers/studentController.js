'use strict';

studentController.$inject = ['$http', '$scope', '$location'];

angular.module('elycee').controller('studentController', studentController);

function studentController($http, $scope, $location) {

    let student = this;

    $scope.searchStud   = '';

    student.currentUser = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

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
