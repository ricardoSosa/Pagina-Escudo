angular.module('EscudoApp', [])
  .controller('prizeListController', function() {
    var prizeList = this;
    prizeList.prizes = [
      {id:12345, description:'learn AngularJS', cost:'20171120', stock:23},
      {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32}, {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32}, {id:23456, actionId:2, userId:1, postId:1, description:'build an AngularJS', cost:'20171120', stock:32}];
 
    prizeList.addPrize = function(newPrize) {
      prizeList.prizes.push(newPrize);
    };
 
    prizeList.remaining = function() {
      var count = 0;
      angular.forEach(prizeList.prizes, function(prize) {
        count += 1;
      });
      return count;
    };
 
    prizeList.archive = function() {
      var oldprizes = prizeList.prizes;
      prizeList.prizes = [];
      angular.forEach(oldPrizes, function(prize) {
        prizeListt.prizes.push(prize);
      });
    };

    prizeList.delete = function (prizeToDelete) {
        angular.forEach(prizeList.prizes, function(prize, key) {
        if (prizeToDelete == prize) prizeList.prizes.splice(key, 1);
      });
    };

    });