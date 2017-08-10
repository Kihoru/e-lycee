app.config(function($routeProvider, $locationProvider, $authProvider, $ocLazyLoadProvider) {
    $authProvider.loginUrl = location.origin+'/platform/login';
    $authProvider.loginOnSignup = false;
    $authProvider.baseUrl = '/platform/';


    $ocLazyLoadProvider.config({
            loadedModules: ['elycee'], modules: [
                {
                    name: 'auth',
                    files: ['../public/js/controllers/authController.js']
                },
                {
                    name: 'home',
                    files: ['../public/js/controllers/homeController.js']
                },
                {
                    name: 'addQcm',
                    files: ['../public/js/controllers/addQcmController.js']
                },
                {
                    name: 'qcmall',
                    files: ['../public/js/controllers/qcmAllController.js']
                }
            ]
    });

    $routeProvider
        .when('/', {
            templateUrl: '../public/js/views/auth.html',
            controller: 'authController',
            controllerAs: 'auth',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('auth');
                }]
            }
        })
        .when('/home', {
            templateUrl: '../public/js/views/home.html',
            controller: 'homeController',
            controllerAs: 'home',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('home');
                }]
            }
        })
        .when('/qcm/all', {
            templateUrl: '../public/js/views/fiches/all.html',
            controller: 'qcmAllController',
            controllerAs: 'qcmAll',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('qcmall');
                }]
            }
        })
        .when('/addQcm', {
            templateUrl: '../public/js/views/addQcm.html',
            controller: 'addQcmController',
            controllerAs: 'addQcm',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('addQcm');
                }]
            }
        })
        .otherwise({
            redirectTo: '/'
        });

    $locationProvider.html5Mode(true);
});
