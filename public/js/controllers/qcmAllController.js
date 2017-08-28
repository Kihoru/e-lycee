'use strict';

qcmAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmAllController', qcmAllController);

function qcmAllController($auth, $http, $scope, $location, $route, $routeParams) {

    $('.modal').modal();

    $scope.searchQcm = '';

    let all = this;

    all.logged = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    all.isTeacher = this.logged.role === 'teacher';

    all.toDeleteId = 0;

    if ( all.isTeacher ) {
        $http.get('/qcm')
            .then(function(res) {
                if(res.data.qcms) {
                    all.datas = res.data.qcms;
                    all.parseDatas();
                }else if(res.data.error) {
                    all.loadError = res.data.error;
                }
            });
    } else {
        $http.post('/qcm/student', {user_id: all.logged.id})
            .then(function( res ) {
                console.log(res);
                if ( res.data ) {
                    all.datas = res.data;
                    all.parseDatas();
                } else if ( res.data.error ) {
                    all.loadError = res.data.error;
                }
            });
    }

    all.parseDatas = function() {
        for(let i = 0; i < all.datas.length; i++) {
            if(all.datas[i].hasOwnProperty("questions")) {
                all.datas[i].nbQuestion = all.datas[i].questions.constructor == Array ? all.datas[i].questions.length : 1;
            }
            all.datas[i].isOkforStudent = all.datas[i].class_level === all.logged.role && all.datas[i].published === 1;

            if(all.datas[i].hasOwnProperty("note")) {
                all.datas[i].disabled = true;
            }
        }
    }


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

    all.deleteQcm = function(index) {
        all.toDeleteId = all.datas[index].id;
        all.toDeleteIndex = index;
        $('#modal1').modal('open');
    }

    all.delete = function() {
        $http.delete('/qcm/' + all.toDeleteId)
            .then(function(res) {
                if(res.data.hasOwnProperty('Success')) {
                    all.datas.splice(all.toDeleteIndex, 1);
                    if(!all.datas.length) all.loadError = 'No datas available';
                    toastr.options.progressBar = true;
                    toastr.success('', res.data.Success);
                }else if(res.data.hasOwnProperty('Error')) {
                    toastr.options.progressBar = true;
                    toastr.error('', res.data.Error);
                }
            });
    }

}
