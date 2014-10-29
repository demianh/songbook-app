/*
 * View controller for the song detail page.
 *
 */
Songbook.controller("SongDetailController", function ($scope, $stateParams, $http) {
  $scope.songId = $stateParams.songId;
  $scope.title = $stateParams.songId;
  $scope.data = {};

  $http({
    method: 'GET',
    url: 'resources/songs/json/' + $scope.songId
  }).
      success(function (data, status, headers, config) {
        $scope.data = data;
        if (angular.isDefined(data.meta.title)){
          $scope.title = data.meta.title;
        }
      }).
      error(function (data, status, headers, config) {
        $scope.title = 'Ouch!';
        $scope.errormsg = 'Song konnte nicht geladen werden...';
        $scope.data = {}
      });
});
