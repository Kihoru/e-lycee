'use strict';

postCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postCreateController', postCreateController);

function postCreateController($auth, $http, $scope, $location, $route, $routeParams) {

	let create = this;

	create.datas = {};

    create.create = function() {

		var fd = new FormData()
		for (var i in create.datas.thumbnail) {
		    fd.append("fileToUpload", create.datas.thumbnail[i]);
		}

		fd.append('title', create.datas.title);
		fd.append('content', create.datas.content);

		var config = {headers: {'Content-Type': undefined}};

		$http.post('/post', fd, config)
			.then(function(res) {
				console.log(res);
			});

	}
}
