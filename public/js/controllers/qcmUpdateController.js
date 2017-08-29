'use strict';

qcmUpdateController.$inject = ['$http', '$location', '$routeParams'];

angular.module('elycee').controller('qcmUpdateController', qcmUpdateController);

function qcmUpdateController($http, $location, $routeParams) {

    function runMaterials() {
        $('select').material_select();
        $('.collapsible').collapsible();
        $('.tooltipped').tooltip({delay: 50});
    }

    setTimeout(function() {
        runMaterials();
    }, 0);

    let update = this;

    update.currentUser = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

    if(update.currentUser.role !== 'teacher') $location.path('/');

    update.datas = {
        id: $routeParams.id
    }

    $http.get('/qcm/' + update.datas.id + '/edit')
        .then(function(res) {
            update.datas.qcm = res.data.qcm;
            setTimeout(function() {
                runMaterials();
            }, 0);
        });

    this.update = function() {
        $http.put('/qcm/'+update.datas.id, {datas: update.datas.qcm})
            .then(function(res) {
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

    this.addQuestion = function() {
        update.datas.qcm.questions.push({
            question_title: '',
            choices: [
                {
                    content: '',
                    valid: 0
                }
            ]
        });

        setTimeout(function() {
            runMaterials();
        }, 0);
    }

    this.addChoice = function(index) {
        update.datas.qcm.questions[index].choices.push({
            content: '',
            valid: 0
        });

        setTimeout(function() {
            runMaterials();
        }, 0);
    }

    this.deleteItem = function(index, choiceIndex = false) {
        if(choiceIndex !== false) {
            update.datas.qcm.questions[index].choices.splice(choiceIndex, 1);
        }else{
            update.datas.qcm.questions.splice(index, 1);
        }
    }
}
