// Pulled from angular-tweet-filter

angular.module('twitterFilters', ['ngSanitize'])
	.filter('linkUsername', function() {
		return function(text) {
			return '<a href="http://twitter.com/' + text.slice(1) + '">' + text + '</a>';
		};
	})
	.filter('linkHashtag', function() {
		return function(text) {
			return '<a href="http://twitter.com/search/%23' + text.slice(1) + '">' + text + '</a>';
		};
	})
	.filter('tweet', function() {
		return function(text) {
			var urlRegex = /((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/g;
			var twitterUserRegex = /@([a-zA-Z0-9_]{1,20})/g;
			var twitterHashTagRegex = /\B#(\w+)/g;

			text = text.replace(urlRegex," <a href='$&' target='_blank'>$&</a>").trim();
			text = text.replace(twitterUserRegex,"<a href='http://www.twitter.com/$1' target='_blank'>@$1</a>");
			text = text.replace(twitterHashTagRegex,"<a href='http://twitter.com/search/%23$1' target='_blank'>#$1</a>");

			return text;
		};
	});

// Begin actual code

// Move to top of sidebar

angular.module('awsum',['ngSanitize','twitterFilters'])
  .controller('TwitterController',['$scope', '$filter', function($scope, $filter){
    $scope.statuses = teamMemberJSON;

    $scope.fixDate = function(date){
      date = Date.parse(date);
      date = $filter('date')(date, 'MMM d, h:mma');
      return date;
    };
  }]);