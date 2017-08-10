<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>plateform</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{url('css/utils/materialize.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('css/app.css')}}">
        <base href="/platform/">
    </head>
    <body ng-app="elycee">

        <div ng-view></div>

        <script src="{{url('js/utils/angular.min.js')}}"></script>
        <script src="{{url('js/utils/angular-resource.min.js')}}"></script>
        <script src="{{url('js/utils/jquery.min.js')}}"></script>
        <script src="{{url('js/utils/materialize.min.js')}}"></script>
        <script src="{{url('js/utils/angular-route.min.js')}}"></script>
        <script src="{{url('js/utils/ocLazyLoad.min.js')}}"></script>
        <script src="{{url('js/utils/satellizer.min.js')}}"></script>
        <script src="{{url('js/init.materialize.js')}}"></script>
        <!-- MAIN APP ------------>
        <script src="{{url('js/app.js')}}"></script>
        <!-- ROUTES & DIRECTIVES APP & NAVCONTROLLER ------------>
        <script src="{{url('js/routing.js')}}"></script>
        <script src="{{url('js/directives.js')}}"></script>
        <script src="{{url('js/controllers/navController.js')}}"></script>
    </body>
</html>
