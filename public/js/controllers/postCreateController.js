'use strict';

postCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postCreateController', postCreateController);

function postCreateController($auth, $http, $scope, $location, $route, $routeParams) {

	let create = this;

	create.datas = {};

    create.create = function() {

    	console.log('bonjour');
		let abstract = create.makeAbstract(create.datas.content);
		let thumbnail = ;

		let datas = {
			title: create.datas.title,
			abstract: abstract,
			content: create.datas.content,
			thumbnail: thumbnail
		}
		console.log(thumbnail);
		/*$http.post('/post', datas).then(function(res){
			console.log(res);
		});*/
	}

    create.makeAbstract = function(str)
    {
    	let split = str.split(" ", 60);
    	return split;
    }
}