angular.module("appAdmin", ["ngRoute"])
    .config(function($routeProvider){
        $routeProvider
            .when("/test", {
                templateUrl: "test.html"
            });
    });