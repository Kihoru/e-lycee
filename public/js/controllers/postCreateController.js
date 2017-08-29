'use strict';

postCreateController.$inject = ['$http', '$location'];

angular.module('elycee').controller('postCreateController', postCreateController);

function postCreateController($http, $location) {

	let create = this;

	create.currentUser = sessionStorage.getItem("user_logged") ? JSON.parse(sessionStorage.getItem("user_logged")) : false;

    if(create.currentUser.role !== 'teacher') $location.path('/');

	create.datas = {};

    create.create = function() {

		create.datas.addError = "";

		if(create.datas.thumbnail[0].size > 2000000) {
			toastr.options.progressBar = true;
			toastr.error('', "Veuillez choisir un fichier de 2Mo ou moins.");
			create.datas.addError = "Veuillez choisir un fichier de 2Mo ou moins.";
			return false;
		}else if( !create.datas.title || !create.datas.content) {;
			create.datas.addError = "Veuillez remplir tous les champs.";
			return false;
		}

		var fd = new FormData();

		for (var i in create.datas.thumbnail) {
		    fd.append("fileToUpload", create.datas.thumbnail[i]);
		}

		fd.append('title', create.datas.title);
		fd.append('content', create.datas.content);
		fd.append('user_id', create.currentUser.id);

		$http.post('/post', fd, {headers: {'Content-Type': undefined}})
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
