<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>E-Lycée d'Ardèche</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" href="{{url('css/app.css')}}">
		<link rel="stylesheet" href="{{url('css/style.css')}}">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div id="main-nav">
			@include('views.partial.header');
		</div>

		<div id="main-content">
			@yield('content');
		</div>

		<div id="main-footer">
			@include('views.partial.footer');
		</div>
	</body>
</html>