'use strict';

qcmCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmCreateController', qcmCreateController);

function qcmCreateController($auth, $http, $scope, $location, $route, $routeParams) {

    function runMaterials() {
        $('select').material_select();
        $('.collapsible').collapsible();
        $('.tooltipped').tooltip({delay: 50});
    }

    this.currentUser = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    if(this.currentUser.role !== 'teacher') $location.path('/');

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

    this.validate = function(){

        for(let i = 0; i < this.qcm.questions.length; i++) {

            if(this.qcm.questions[i].question_title == '') {
                this.addQcmError = "Veuillez choisir un intitulé pour la question #"+(i+1);
                toastr.options.progressBar = true;
                toastr.error('', this.addQcmError);
                return false;
            }

            let oneIsValid = 0;

            for(let y = 0; y < this.qcm.questions[i].choices.length; y++) {

                if(this.qcm.questions[i].choices[y].content == '') {
                    this.addQcmError = "Veuillez choisir un intitulé de réponse pour la question #"+(i+1)+" (choix #"+(y+1)+").";
                    toastr.options.progressBar = true;
                    toastr.error('', this.addQcmError);
                    return true;
                }

                if(this.qcm.questions[i].choices[y].valid) oneIsValid += 1;
            }

            if(!oneIsValid) {
                this.addQcmError = "Veuillez choisir une bonne réponse pour chaque question.";
                toastr.options.progressBar = true;
                toastr.error('', this.addQcmError);
                return false;
            }

        }

        if(!this.addQcmError) return true;
    }

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

        this.addQcmError = '';

        let valid = this.validate();

        if(valid) {
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
    }

    this.deleteItem = function(index, choiceIndex = false) {
        if(choiceIndex !== false) {
            this.qcm.questions[index].choices.splice(choiceIndex, 1);
        }else{
            this.qcm.questions.splice(index, 1);
        }
        setTimeout(function() {
            runMaterials();
        }, 0);
    }

}
