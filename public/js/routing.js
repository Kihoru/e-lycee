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
                    name: 'qcmall',
                    files: ['/js/controllers/qcmAllController.js']
                },
                {
                    name: 'qcmcreate',
                    files: ['/js/controllers/qcmCreateController.js']
                },
                {
                    name: 'qcmupdate',
                    files: ['/js/controllers/qcmUpdateController.js']
                },
                {
                    name: 'postall',
                    files: ['/js/controllers/postAllController.js']
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
                return $ocLazyLoad.load('qcmall');
            }]
        }
    })
    .when('/qcm/create', {
        templateUrl: '/js/views/fiches/create.html',
        controller: 'qcmCreateController',
        controllerAs: 'qcmCreate',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('qcmcreate');
            }]
        }
    })
    .when('/qcm/update/:id', {
        templateUrl: '/js/views/fiches/update.html',
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
    /// CRUD POSTS
    $routeProvider
    .when('/post/all', {
        templateUrl: '/js/views/posts/all.html',
        controller: 'postAllController',
        controllerAs: 'postAll',
        resolve: {
            loadModule: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load('postall');
            }]
        }
    })
    .when('/post/create',{
        templateUrl: '/js/views/posts/create.html',
        controller: 'postCreateController',
        controllerAs: 'postCreate',
        resolve: {
            loadModule: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load('postcreate')
            }]
        }
    })
    .when('/post/update',{
        templateUrl: '/js/views/posts/update.html',
        controller: 'postUpdateController',
        controllerAs: 'postUpdate',
        resolve: {
            loadModule: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load('postupdate')
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
