'use strict';

qcmCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmCreateController', qcmCreateController);

function qcmCreateController($auth, $http, $scope, $location, $route, $routeParams) {

    function runMaterials() {
        $('select').material_select();
        $('.collapsible').collapsible();
        $('.tooltipped').tooltip({delay: 50});
    }

    setTimeout(function() {
        runMaterials();
    }, 0);

    this.qcm = {
        title: '',
        class_level: '',
        questions: [
            {
                question_title: '',
                choices: [
                    {
                        content: '',
                        valid: 0
                    }
                ]
            }
        ]
    };

    this.addQuestion = function() {
        this.qcm.questions.push({
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
        this.qcm.questions[index].choices.push({
            content: '',
            valid: 0
        });

        setTimeout(function() {
            runMaterials();
        }, 0);
    }

    this.create = function() {

        $http.post('/qcm', {'datas' : this.qcm})
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

    this.deleteItem = function(index, choiceIndex = false) {
        if(choiceIndex !== false) {
            this.qcm.questions[index].choices.splice(choiceIndex, 1);
        }else{
            this.qcm.questions.splice(index, 1);
        }
    }

}
