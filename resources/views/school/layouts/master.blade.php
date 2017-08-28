<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Site de lycée d'ardèche</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="{{url('css/front.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
</head>
<body>
    @include('school.partial.nav')

    @yield('content')

    @include('school.partial.footer')
    
    <script src="{{url('js/utils/jquery.min.js')}}"></script>
</body>
</html>
