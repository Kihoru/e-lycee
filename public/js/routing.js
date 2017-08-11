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
                    name: 'qcmall',
                    files: ['../public/js/controllers/qcmAllController.js']
                },
                {
                    name: 'qcmcreate',
                    files: ['../public/js/controllers/qcmCreateController.js']
                },
                {
                    name: 'qcmupdate',
                    files: ['../public/js/controllers/qcmUpdateController.js']
                }
            ]
    });

    //routes CRUD QCM /////////////////////////////////////////
    $routeProvider
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
    .when('/qcm/create', {
        templateUrl: '../public/js/views/fiches/create.html',
        controller: 'qcmCreateController',
        controllerAs: 'qcmCreate',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmcreate');
            }]
        }
    })
    .when('/qcm/update/:id', {
        templateUrl: '../public/js/views/fiches/update.html',
        controller: 'qcmUpdateController',
        controllerAs: 'qcmUpdate',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmupdate');
            }]
        }
    })
    .otherwise({
        redirectTo: '/'
    });
    /////////////////////////////////////////////////////////

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
        .otherwise({
            redirectTo: '/'
        });

    $locationProvider.html5Mode(true);
});
