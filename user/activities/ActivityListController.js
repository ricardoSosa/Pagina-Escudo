angular.module('appUser')
  .controller('ActivityListController', function($scope) {
    $scope.activities = [
      {id:1776170372407518, actionId:2, userId:1, postId:1, description:'learn AngularJS', date:'20171120'},
      {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', date:'20171122'}];
 
    $scope.addActivity = function(newActivity) {
      $scope.activities.push(newActivity);
    };
 
    $scope.remaining = function() {
      var count = 0;
      angular.forEach($scope.activities, function(activity) {
        count += 1;
      });
      return count;
    };
 
    $scope.archive = function() {
      var oldActivities = $scope.activities;
      $scope.activities = [];
      angular.forEach(oldActivities, function(activity) {
        $scope.activities.push(activity);
      });
    };

    $scope.delete = function (activityToDelete) {
        angular.forEach($scope.activities, function(activity, key) {
        if (activityToDelete == activity) $scope.activities.splice(key, 1);
      });
    };

  });
