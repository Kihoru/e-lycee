<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>plateform</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{url('css/utils/materialize.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('css/utils/toastr.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('css/app.css')}}">
        <base href="/platform/">
    </head>
    <body ng-app="elycee">

        <div ng-view></div>

        <script src="{{url('js/utils/jquery.min.js')}}"></script>
        <script src="{{url('js/utils/angular.min.js')}}"></script>
        <script src="{{url('js/utils/angular-resource.min.js')}}"></script>
        <script src="{{url('js/utils/toastr.min.js')}}"></script>
        <script src="{{url('js/utils/materialize.min.js')}}"></script>
        <script src="{{url('js/utils/angular-route.min.js')}}"></script>
        <script src="{{url('js/utils/ocLazyLoad.min.js')}}"></script>
        <script src="{{url('js/utils/satellizer.min.js')}}"></script>
        <!-- MAIN APP ------------>
        <script src="{{url('js/app.js')}}"></script>
        <!-- ROUTES & DIRECTIVES APP & NAVCONTROLLER ------------>
        <script src="{{url('js/routing.js')}}"></script>
        <script src="{{url('js/directives.js')}}"></script>
        <script src="{{url('js/controllers/navController.js')}}"></script>
    </body>
</html>
