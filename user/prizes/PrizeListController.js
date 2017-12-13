angular.module('appUser')
        .controller('PrizeListController', function ($scope){
  $scope.prizes = [
    {id:12345, actionId:2, userId:1, postId:1, description:'learn AngularJS', cost:'20171120', stock:23},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32}];

  $scope.addPrize = function(newPrize) {
    $scope.prizes.push(newPrize);
  };

  $scope.remaining = function() {
    var count = 0;
    angular.forEach($scope.prizes, function(prize) {
      count += 1;
    });
    return count;
  };

  $scope.archive = function() {
    var oldPrizes = $scope.prizes;
    $scope.prizes = [];
    angular.forEach(oldPrizes, function(prize) {
      $scopet.prizes.push(prize);
    });
  };

  $scope.delete = function (prizeToDelete) {
      angular.forEach($scope.prizes, function(prize, key) {
      if (prizeToDelete == prize) $scope.prizes.splice(key, 1);
    });
  };
});