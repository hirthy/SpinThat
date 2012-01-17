$(document).ready(function() {
  //spotify
  //grooveshark
  var query = "foo";
  var json_src = "http://tinysong.com/s/"+query+"?format=json&key=e20c4661c9ceede2aaa89dcb2cf33cc7";
  $.getJSON(json_src, function(data) {
    $("body").append(
      '<li><a>'+data.SongName+' by '+data.ArtistName+'</a></li>'
    );
  });
  //rdio

});