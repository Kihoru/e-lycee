'use strict';

postCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postCreateController', postCreateController);

function postCreateController($auth, $http, $scope, $location, $route, $routeParams) {

	let create = this;

	create.datas = {};

    create.create = function() {

		let abstract = create.makeAbstract(create.datas.content);
		let thumbnail = $scope.fileNameChanged();

		let datas = {
			title: create.datas.title,
			abstract: abstract,
			content: create.datas.content,
			thumbnail: thumbnail
		}
	}

    create.makeAbstract = function(str)
    {

    	let split = str.split(" ", 60);
    	return split;
    }
	$scope.fileNameChanged = function()
	{
		console.log('Select file');
	}
}
