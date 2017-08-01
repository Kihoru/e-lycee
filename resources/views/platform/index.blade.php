<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>plateform</title>
        <base href="/platform/">
    </head>
    <body ng-app="elycee">
        <h1>My platform</h1>
        <div ng-view></div>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-resource/1.5.8/angular-resource.min.js"></script>
        <script src="{{url('js/utils/angular-route.min.js')}}"></script>
        <script src="{{url('js/utils/oclazyload/oclazyload.min.js')}}"></script>
        <script src="{{url('js/utils/satellizer.js')}}"></script>
        <!---------------------------------------- MAIN APP ------------>
        <script src="{{url('js/app.js')}}"></script>
        <!---------------------------------------- ROUTES APP ------------>
        <script src="{{url('js/routing.js')}}"></script>
    </body>
</html>
