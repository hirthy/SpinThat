<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SpinThat</title>
  <script type="text/javascript" src="scripts/jquery-1.6.4.min.js"></script>
</head>
<body>
  <form action="index.php" method="post">
  <input type="text" name="title" />
  <input type="submit" value="Search" />
  </form>
  <h2>Spotify</h2>
  <?php
    $query = $_POST["title"];
    $spotifyJsonurl = 'http://ws.spotify.com/search/1/track.json?q=' . urlencode($query);
    $spotifyJson = file_get_contents($spotifyJsonurl,0,null,null);
    $spotifyJson_output = json_decode($spotifyJson);
  ?>
  <ul>
  <?php
    foreach ($spotifyJson_output->tracks as $spotifySong) {
      //assume only 1 artist (get first artist)
      echo '<li><a href="' . $spotifySong->href . '" target="_blank">' . $spotifySong->name . '</a> - <a href="' . $spotifySong->artists[0]->href . '" target="_blank">' . $spotifySong->artists[0]->name . '</a></li>';
    }  
  ?>
  </ul>
  <h2>Grooveshark</h2>
  <?php
    $gsJsonurl = 'http://tinysong.com/s/' . urlencode($query) . '?format=json&key=e20c4661c9ceede2aaa89dcb2cf33cc7';
    $gsJson = file_get_contents($gsJsonurl,0,null,null);
    $gsJson_output = json_decode($gsJson);
  ?>
  <ul>
  <?php
    foreach ($gsJson_output as $gsSong) {
      echo '<li><a href="' . $gsSong->Url . '" target="_blank">' . $gsSong->SongName . ' - ' . $gsSong->ArtistName . '</a></li>';
    }  
  ?>
  </ul>
  <h2>Rdio</h2>
  <?php
    session_start(); 
    require_once("rdio.php");

    // basic API set up
    define('CONSUMER_KEY', 'xsamxrk32tmn9b7agebs43m9');
    define('CONSUMER_SECRET', 'SDZwQV7rVm');

    $rdio = new Rdio(CONSUMER_KEY, CONSUMER_SECRET);
    
    $results = $rdio->search(
          array(
            "query" => $query,
            "types" => "Track",
            "never_or" => "true"))->result->results;
  ?>
  <ul>
  <?php
    $rdio_base_url = 'http://www.rdio.com';
    foreach ($results as $rdioSong) {
      echo '<li><a href="' . $rdio_base_url . $rdioSong->url . '" target="_blank">' . $rdioSong->name . '</a> - <a href="' . $rdio_base_url . $rdioSong->artistUrl . '" target="_blank">' . $rdioSong->albumArtist . '</a></li>';
    }  
  ?>  
  </ul>
</body>
</html>