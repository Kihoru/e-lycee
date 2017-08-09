'use strict';

var app = angular
        .module('elycee', ['ngRoute', 'satellizer', 'oc.lazyLoad'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('[{');
            $interpolateProvider.endSymbol('}]');
        });
