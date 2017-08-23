app.directive('myNav', function() {
    return {
        templateUrl: "/js/views/nav.html",
        restrict: 'E'
    }
});

app.directive("inputFiles", function($parse) {
  return function linkFn (scope, elem, attrs) {
    var inputFilesGetter = $parse(attrs.inputFiles);
    var inputFilesSetter = inputFilesGetter.assign;
    elem.on("change", function (e) {
      inputFilesSetter(scope, e.target.files);
      scope.$apply();
    });
  };
});
