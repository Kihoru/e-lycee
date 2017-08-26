app.config(function($routeProvider, $locationProvider, $authProvider, $ocLazyLoadProvider) {
    $authProvider.loginUrl = location.origin+'/platform/login';
    $authProvider.loginOnSignup = false;
    $authProvider.baseUrl = '/platform/';


    $ocLazyLoadProvider.config({
        loadedModules: ['elycee'], modules: [
            {
                name: 'auth',
                files: ['/js/controllers/authController.js']
            },
            {
                name: 'home',
                files: ['/js/controllers/homeController.js']
            },
            {
                name: 'qcmAll',
                files: ['/js/controllers/qcmAllController.js']
            },
            {
                name: 'qcmCreate',
                files: ['/js/controllers/qcmCreateController.js']
            },
            {
                name: 'qcmOne',
                files: ['/js/controllers/qcmOneController.js']
            },
            {
                name: 'qcmUpdate',
                files: ['/js/controllers/qcmUpdateController.js']
            },
            {
                name: 'postAll',
                files: ['/js/controllers/postAllController.js']
            },
            {
                name: 'postCreate',
                files: ['/js/controllers/postCreateController.js']
            },
            {
                name: 'postUpdate',
                files: ['/js/controllers/postUpdateController.js']
            }
        ]
    });

    //routes CRUD QCM /////////////////////////////////////////
    $routeProvider
    .when('/qcm/all', {
        templateUrl: '/js/views/fiches/all.html',
        controller: 'qcmAllController',
        controllerAs: 'qcmAll',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmAll');
            }]
        }
    })
    .when('/qcm/create', {
        templateUrl: '/js/views/fiches/create.html',
        controller: 'qcmCreateController',
        controllerAs: 'qcmCreate',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmCreate');
            }]
        }
    })
    .when('/qcm/update/:id', {
        templateUrl: '/js/views/fiches/update.html',
        controller: 'qcmUpdateController',
        controllerAs: 'qcmUpdate',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmUpdate');
            }]
        }
    })
    .when('/qcm/one/:id', {
        templateUrl: '/js/views/fiches/one.html',
        controller: 'qcmOneController',
        controllerAs: 'qcmOne',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmOne');
            }]
        }
    })
    .otherwise({
        redirectTo: '/'
    });
    /////////////////////////////////////////////////////////
    /// CRUD POSTS
    $routeProvider
    .when('/post/all', {
        templateUrl: '/js/views/posts/all.html',
        controller: 'postAllController',
        controllerAs: 'postAll',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('postAll');
            }]
        }
    })
    .when('/post/create',{
        templateUrl: '/js/views/posts/create.html',
        controller: 'postCreateController',
        controllerAs: 'postCreate',
        resolve: {
            loadModule: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load('postCreate')
            }]
        }
    })
    .when('/post/update/:id',{
        templateUrl: '/js/views/posts/update.html',
        controller: 'postUpdateController',
        controllerAs: 'postUpdate',
        resolve: {
            loadModule: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load('postUpdate')
            }]
        }
    })
    .otherwise({
        redirectTo: '/'
    });
    ////////////////////////////////////////////////////////
    $routeProvider
        .when('/', {
            templateUrl: '/js/views/auth.html',
            controller: 'authController',
            controllerAs: 'auth',
            resolve: {
                loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load('auth');
                }]
            }
        })
        .when('/home', {
            templateUrl: '/js/views/home.html',
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
