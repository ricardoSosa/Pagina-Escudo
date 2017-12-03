angular.module('EscudoApp', [])
  .controller('activityListController', function() {
    var activityList = this;
    activityList.activitys = [
      {id:12345, actionId:2, userId:1, postId:1, description:'learn AngularJS', date:'20171120'},
      {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', date:'20171122'}];
 
    activityList.addActivity = function(newActivity) {
      activityList.activitys.push(newActivity);
    };
 
    activityList.remaining = function() {
      var count = 0;
      angular.forEach(activityList.activitys, function(activity) {
        count += 1;
      });
      return count;
    };
 
    activityList.archive = function() {
      var oldactivitys = activityList.activitys;
      activityList.activitys = [];
      angular.forEach(oldActivitys, function(activity) {
        activityListt.activitys.push(activity);
      });
    };

    activityList.delete = function (activityToDelete) {
        angular.forEach(activityList.activitys, function(activity, key) {
        if (activityToDelete == activity) activityList.activitys.splice(key, 1);
      });
    };

    });