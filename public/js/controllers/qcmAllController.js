'use strict';

qcmAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmAllController', qcmAllController);

function qcmAllController($auth, $http, $scope, $location, $route, $routeParams) {

    $('.modal').modal();

    let all = this;

    all.logged = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    all.isTeacher = this.logged.role === 'teacher';

    $http.get('/qcm').then(function(res) {

        if(res.data.qcms) {
            all.datas = res.data.qcms;

            for(let i = 0; i < all.datas.length; i++) {
                all.datas[i].nbQuestion = all.datas[i].question.length;
                all.datas[i].isOkforStudent = all.datas[i].class_level === all.logged.role && all.datas[i].published === 1;

                if(all.logged.role != 'teacher') {

                    $http.get('/getScoreFromQcm', {user_id: all.logged.id, qcm_id: all.datas[i].id}).then(function(res) {
                        if(res.data.todo) {
                            all.datas[i].disabled = false;
                        }else if(res.data.already) {
                            all.datas[i].disabled = true;
                            all.datas[i].score = res.data.score;
                        }
                    });
                }
            }

        }else if(res.data.error) {
            all.loadError = res.data.error;
        }
    }).catch(function(err) {
        console.log(err);
    });

    all.changeStatus = function(index) {

        let qcm = all.datas[index];

        $http.put('/qcm/'+qcm.id, {datas : qcm, changePublished: true})
            .then(function(res) {
                if(res.data.hasOwnProperty('Success')) {
                    toastr.options.progressBar = true;
                    toastr.success('', res.data.Success);
                }else if(res.data.hasOwnProperty('Error')) {
                    toastr.options.progressBar = true;
                    toastr.error('', res.data.Error);
                }
            });

    }

}
