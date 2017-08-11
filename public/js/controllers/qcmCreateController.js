'use strict';

qcmCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmCreateController', qcmCreateController);

function qcmCreateController($auth, $http, $scope, $location, $route, $routeParams) {


    $('select').material_select();
    $('.collapsible').collapsible();
    
    // this.data = {
    //     "title" : "",
    //     "questions": []
    // };
    // this.newQuestion = {
    //     "title" : "",
    //     "choices" : [],
    //     "goodAnswer" : ""
    // };
    //
    // this.qcmTitle = "";
    //
    // this.create = function() {
    //
    //     if(!this.qcmTitle.length || !this.data.questions.length) {
    //         console.log("Error");
    //     }else{
    //
    //         this.data.title = this.qcmTitle;
    //
    //         $http.post('/platform/qcm/create', this.data)
    //             .then(function(response) {
    //                 console.log(response);
    //             });
    //     }
    // }
    //
    // this.addQuestion = function() {
    //     if(!this.newQuestion.goodAnswer.length) {
    //         console.log("Error");
    //     }else{
    //         this.newQuestion.title = this.questionTitle;
    //         this.data.questions.push(this.newQuestion);
    //
    //         this.newQuestion = {
    //             "title" : "",
    //             "choices" : [],
    //             "goodAnswer" : ""
    //         };
    //
    //         this.questionTitle = '';
    //     }
    // }
    //
    // this.addChoice = function() {
    //     if(this.gAnswer && this.newQuestion.goodAnswer.length == 0) {
    //         this.newQuestion.goodAnswer = this.newChoice;
    //     }
    //     this.newQuestion.choices.push(this.newChoice);
    //
    //     this.newChoice = "";
    //     this.gAnswer = false;
    // }
    //
    // this.deleteChoice = function(choice) {
    //     let i = this.newQuestion.choices.indexOf(choice);
    //     if(i > -1) this.newQuestion.choices.splice(i, 1);
    // }
}
