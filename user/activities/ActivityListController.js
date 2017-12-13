angular.module('appUser')
  .controller('ActivityListController', function($scope) {
    $scope.activities = [
      {id:12345, actionId:2, userId:1, postId:1, description:'learn AngularJS', date:'20171120'},
      {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', date:'20171122'}];
 
    $scope.addActivity = function(newActivity) {
      activityList.activities.push(newActivity);
    };
 
    $scope.remaining = function() {
      var count = 0;
      angular.forEach(activityList.activities, function(activity) {
        count += 1;
      });
      return count;
    };
 
    $scope.archive = function() {
      var oldActivities = activityList.activities;
      activityList.activities = [];
      angular.forEach(oldActivities, function(activity) {
        activityListt.activities.push(activity);
      });
    };

    $scope.delete = function (activityToDelete) {
        angular.forEach(activityList.activities, function(activity, key) {
        if (activityToDelete == activity) activityList.activities.splice(key, 1);
      });
    };

  });
