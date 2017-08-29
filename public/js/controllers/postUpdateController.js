'use strict';

postUpdateController.$inject = ['$http', '$location', '$routeParams'];

angular.module('elycee').controller('postUpdateController', postUpdateController);

function postUpdateController($http, $location, $routeParams) {

    let update = this;

    update.currentUser = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

    if(update.currentUser.role !== 'teacher') $location.path('/');

    update.datas = {
        id: $routeParams.id
    }

    $http.get("/post/"+update.datas.id+"/edit")
        .then(function(res) {
            update.post = res.data.post;
            setTimeout(function(){
                $('#post_text').trigger('autoresize');
            }, 0);
        });

    update.update = function() {
        $http.put('/post/'+update.post.id, {datas : update.post})
            .then(function(res) {
                if(res.data.hasOwnProperty('Success')) {
                    toastr.options.progressBar = true;
                    toastr.success('', res.data.Success);
                    $location.path('/post/all');
                }else if(res.data.hasOwnProperty('Error')) {
                    toastr.options.progressBar = true;
                    toastr.error('', res.data.Error);
                }
            });
    }

}
