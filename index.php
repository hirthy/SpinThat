<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SpinThat</title>
  <script type="text/javascript" src="scripts/jquery-1.6.4.min.js"></script>
  <script type="text/javascript" src="scripts/showlist.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
  <style>
      html, body {
        height: 100%;
      }
      footer {
        padding: 17px 0 18px 0;
      }
      footer a:hover {
        color: #efefef;
      }
      .wrapper {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -63px;
      }
      .push {
        height: 63px;
      }
      /* not required for sticky footer; just pushes hero down a bit */
      .wrapper > .container {
        padding-top: 60px;
      }
  </style>
</head>
<body>
  <div class="container">
    <div class="hero-unit">
      <h1>Spin That!</h1>
      <p>Tired of searching in all your music services for that rare song? Search Spotify, Grooveshark and Rdio with one click, here.</p>
      <form id="search" action="index.php" method="post">
      <input type="text" name="title" />
      <input class="btn primary" type="submit" value="Search" />
      </form>
      <p class="loading">loading...</p>
    </div>
    <?php include("datagrabber.php"); ?>
    <div class="row-fluid">
      <div class="span4">
        <h2>Spotify</h2>
        <div class="results">
          <ul class="unstyled">
          <?php            
            $empty_msg = '<p>No results.</p>';
            if(count($spotifyJson_output->tracks) < 1) echo $empty_msg;
            else {
              foreach ($spotifyJson_output->tracks as $spotifySong) {
                //assume only 1 artist (get first artist)
                echo '<li style="display: none;"><a href="' . $spotifySong->href . '" target="_blank">' . $spotifySong->name . '</a> - <a href="' . $spotifySong->artists[0]->href . '" target="_blank">' . $spotifySong->artists[0]->name . '</a></li>';
              }
            }              
          ?>
          </ul>
          <a class="btn more" href="#">Load More</a>
        </div>
      </div>
      <div class="span4">
        <h2>Grooveshark</h2>
        <div class="results">
          <ul class="unstyled">
          <?php
            if(count($gsJson_output) < 1) echo $empty_msg;
            else {
              foreach ($gsJson_output as $gsSong) {
                echo '<li style="display: none;"><a href="' . $gsSong->Url . '" target="_blank">' . $gsSong->SongName . '</a> - <a href="' . 'http://grooveshark.com/#!/artist/' . urlencode($gsSong->ArtistName) . '/' . $gsSong->ArtistID . '" target="_blank">' . $gsSong->ArtistName . '</a></li>';
              }
            }  
          ?>
          </ul>
          <a class="btn more" href="#">Load More</a>
        </div>
      </div>
      <div class="span4">
        <h2>Rdio</h2>
          <div class="results">
          <ul class="unstyled">
          <?php
            $rdio_base_url = 'http://www.rdio.com';
            if(count($rdioResults) < 1) echo $empty_msg;
            else {
              foreach ($rdioResults as $rdioSong) {
                echo '<li style="display: none;"><a href="' . $rdio_base_url . $rdioSong->url . '" target="_blank">' . $rdioSong->name . '</a> - <a href="' . $rdio_base_url . $rdioSong->artistUrl . '" target="_blank">' . $rdioSong->albumArtist . '</a></li>';
              }
            }  
          ?>  
          </ul>
          <a class="btn more" href="#">Load More</a>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <p class="text-center">© <a href="http://www.mikehirth.com">Mike Hirth</a> 2012. Uses <a href="http://www.spotify.com">Spotify</a>, <a href="http://www.grooveshark.com">Grooveshark</a> and <a href="http://www.rdio.com">Rdio</a> APIs.
        </p>
      </div>
    </footer>
  </div>
</body>
</html>