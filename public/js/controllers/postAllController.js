'use strict';

postAllController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postAllController', postAllController);

function postAllController($auth, $http, $scope, $location, $route, $routeParams) {

    $('.modal').modal();

    let all = this;

    $scope.searchPost   = '';

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


    all.deletePost = function(index) {
        all.toDeleteId = all.posts[index].id;
        all.toDeleteIndex = index;
        $('#modal1').modal('open');
    }

    all.delete = function() {
        $http.delete('/post/' + all.toDeleteId)
            .then(function(res) {
                if(res.data.hasOwnProperty('Success')) {
                    all.posts.splice(all.toDeleteIndex, 1);
                    if(!all.posts.length) all.loadError = 'No datas available';
                    toastr.options.progressBar = true;
                    toastr.success('', res.data.Success);
                }else if(res.data.hasOwnProperty('Error')) {
                    toastr.options.progressBar = true;
                    toastr.error('', res.data.Error);
                }
            });
    }
}
