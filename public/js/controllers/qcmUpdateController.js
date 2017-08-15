'use strict';

qcmUpdateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('qcmUpdateController', qcmUpdateController);

function qcmUpdateController($auth, $http, $scope, $location, $route, $routeParams) {


    $('select').material_select();

    let update = this;

    update.datas = {
        id: $routeParams.id
    }

    $http.get('/qcm/' + update.datas.id + '/edit')
        .then(function(res) {
            console.log(res);
        });
}
