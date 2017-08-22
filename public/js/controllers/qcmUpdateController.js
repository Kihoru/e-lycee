'use strict';

qcmUpdateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmUpdateController', qcmUpdateController);

function qcmUpdateController($auth, $http, $scope, $location, $route, $routeParams) {

    function runMaterials() {
        $('select').material_select();
        $('.collapsible').collapsible();
        $('.tooltipped').tooltip({delay: 50});
    }

    setTimeout(function() {
        runMaterials();
    }, 0);

    let update = this;

    update.datas = {
        id: $routeParams.id
    }

    $http.get('/qcm/' + update.datas.id + '/edit')
        .then(function(res) {
            update.datas.qcm = res.data.qcm;
            $scope.$apply();
            setTimeout(function() {
                runMaterials();
            }, 0);
        });

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
