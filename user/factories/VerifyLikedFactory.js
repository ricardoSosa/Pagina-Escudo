angular.module('appUser')
  .factory('VerifyLikedFactory', function ($q) {
    return function () {

        var deferredObject = $q.defer();

        FB.api('/1315018121856081_1776170372407518?fields=likes.summary(true).fields(name).limit(1)', function(response){
            if(response && !response.error){
                deferred.resolve(response);    
            }else{
                deferred.reject('Error occured');
            }
        });

        return deferredObject.promise;
    }
}

VerifyLikedFactory.$inject = ['$q'];