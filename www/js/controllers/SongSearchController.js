/*
 * View controller for the searchable song list.
 *
 */
Songbook.controller("SongSearchController", function($scope, $ionicPlatform, $ionicModal, SongService) {
  $scope.songs = [];

  /*
   * Section: Modal Settings view when tapping the button
   */
  $ionicModal.fromTemplateUrl("templates/settings.html")
      .then(function(modal){
        $scope.settingsDialog = modal;
      });
  $scope.$on('$destroy', function() {
    $scope.settingsDialog.remove();
  });

  /*
   * Section: Modal About view when tapping the button
   */
  $ionicModal.fromTemplateUrl("templates/about.html")
      .then(function(modal){
        $scope.aboutDialog = modal;
      });
  $scope.$on('$destroy', function() {
    $scope.aboutDialog.remove();
  });

  // Wait for ionic to be ready before searching for songs
  $ionicPlatform.ready(function(){
      SongService.getSongIndex()
          .then(function(songIndex) {
              $scope.songs = songIndex;
          }
      );
  });
});
