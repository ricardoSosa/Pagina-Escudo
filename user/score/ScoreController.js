angular.module('appUser')
    .controller('ScoreController', function ($scope){
	    $scope.verify = function () {
	      var result = VerifyLikedFactory();
	      result.then(function (data) {
            console.log(data);
        }).catch(function(err) {
            console.log("error");
        });
	    }
    });
