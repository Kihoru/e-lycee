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

    this.level = '';

    this.selectOptions = [
        {'value': 'first_class', 'name': 'Première'},
        {'value': 'final_class', 'name': 'Terminale'}
    ];

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
        console.log(this.qcm);
        $http.post('/qcm', {'datas' : this.qcm})
            .then(function(res) {
                console.log(res);
            });
    }

}
