'use strict';

var appUser = angular.module('appUser', ['ngRoute']);
	
var configFunction = function($routeProvider, $locationProvider) {

    $routeProvider
    	.when("/score", {
            templateUrl: "score/score.html"
        })
    	.when("/activities", {
            templateUrl: "activities/activities.html",
            controller: 'ActivityListController'
        })
        .when("/prizes", {
            templateUrl: "prizes/prizes.html",
            controller: 'PrizeListController'
        });
};

configFunction.$inject = ['$routeProvider', '$locationProvider'];

appUser.config(configFunction);