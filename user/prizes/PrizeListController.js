angular.module('appUser')
        .controller('PrizeListController', function ($scope){
  $scope.prizes = [
    {id:12345, actionId:2, userId:1, postId:1, description:'learn AngularJS', cost:'20171120', stock:23},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32},
    {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32}];

  $scope.addPrize = function(newPrize) {
    prizeList.prizes.push(newPrize);
  };

  $scope.remaining = function() {
    var count = 0;
    angular.forEach(prizeList.prizes, function(prize) {
      count += 1;
    });
    return count;
  };

  $scope.archive = function() {
    var oldPrizes = prizeList.prizes;
    prizeList.prizes = [];
    angular.forEach(oldPrizes, function(prize) {
      prizeListt.prizes.push(prize);
    });
  };

  $scope.delete = function (prizeToDelete) {
      angular.forEach(prizeList.prizes, function(prize, key) {
      if (prizeToDelete == prize) prizeList.prizes.splice(key, 1);
    });
  };
});