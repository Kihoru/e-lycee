'use strict';

postCreateController.$inject = ['$auth', '$http', '$scope', '$location', '$route', '$routeParams'];

angular.module('elycee').controller('postCreateController', postCreateController);

function postCreateController($auth, $http, $scope, $location, $route, $routeParams) {
    
    create.create = function() {

    	let abstract = create.makeAbstract(create.datas.content);

    	let datas = {
    		title: create.datas.title,
    		abstract: abstract,
    		content: create.datas.content,
    		
    	}
    }

    create.makeAbstract = function()
    {
    	
    	/*On split à 75 caractères */
    	return t.split()
    }
}
