app.config(function($routeProvider, $locationProvider, $authProvider, $ocLazyLoadProvider) {
    $authProvider.loginUrl = location.origin+'/authenticate';
    $authProvider.signupUrl = location.origin+'/signup';
    $authProvider.loginOnSignup = false;
    $authProvider.baseUrl = '/platform/';


    $ocLazyLoadProvider.config({
            loadedModules: ['elycee'], modules: [
                {
                    name: 'test',
                    files: ['../public/js/controllers/testController.js']
                }
            ]
    });

    $routeProvider
        .when('/', {
            templateUrl: '../public/js/views/test.html',
            controller: 'testController',
            controllerAs: 'test',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('test');
                }]
            }
        })
        .otherwise({
            redirectTo: '/'
        });

    console.log("ROUTE INI");

    $locationProvider.html5Mode(true);
});
