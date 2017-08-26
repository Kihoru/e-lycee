'use strict';

postAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postAllController', postAllController);

function postAllController($auth, $http, $scope, $location, $route, $routeParams) {

    let all = this;

    all.logged = localStorage.getItem("user_logged") ? JSON.parse(localStorage.getItem("user_logged")) : false;

    if(all.logged.role !== 'teacher') $location.path('/');

    $http.get('/post').then(function(res) {
    	all.posts = res.data.posts;
    });

    all.changeStatus = function(index) {
        let post = all.posts[index];

        $http.put('/post/'+post.id, {datas : post, changePublished: true})
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
