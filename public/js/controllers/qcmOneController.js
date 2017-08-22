'use strict';

qcmOneController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmOneController', qcmOneController);

function qcmOneController($auth, $http, $scope, $location, $route, $routeParams) {

    let one = this;

    one.currentUser = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    one.isTeacher = one.currentUser.role === "teacher";

    $http.get('/qcm/'+$routeParams.id).then(function(res) {
        one.datas = res.data.qcm[0];

        for(let i = 0; i < one.datas.questions.length; i++) {
            one.datas.questions[i].myanswer = false;
        }
    });


    one.send = function() {

        let nbQuestion = one.datas.questions.length;
        let nbGoodAnswer = 0;

        for(let i = 0; i < one.datas.questions.length; i++) {
            let myAnswerIndex = Number(one.datas.questions[i].myanswer);
            if(one.datas.questions[i].choices[myAnswerIndex].valid) {
                nbGoodAnswer++;
            }
        }

        let note = (nbGoodAnswer * 100) / nbQuestion;

        let datas = {
            user_id: one.currentUser.id,
            qcm_id: one.datas.id,
            note: note,
            status: 'done'
        }

        $http.post('/qcm/addScore', datas).then(function(res) {
            if(res.data.hasOwnProperty('Success')) {
                toastr.options.progressBar = true;
                toastr.success('', res.data.Success);
                $location.path('/qcm/all');
            }else if(res.data.hasOwnProperty('Error')) {
                toastr.options.progressBar = true;
                toastr.error('', res.data.Error);
            }
        });

    }

}
