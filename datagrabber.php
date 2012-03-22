<?php
  // get search query
  $query = $_POST["title"];

  // spotify results
  $spotifyJsonurl = 'http://ws.spotify.com/search/1/track.json?q=' . urlencode($query);
  $spotifyJson = file_get_contents($spotifyJsonurl,0,null,null);
  $spotifyJson_output = json_decode($spotifyJson);

  // grooveshark results
  $gsJsonurl = 'http://tinysong.com/s/' . urlencode($query) . '?format=json&limit=32&key=YOUR_KEY';
  $gsJson = file_get_contents($gsJsonurl,0,null,null);
  $gsJson_output = json_decode($gsJson);

  // rdio results 
  session_start(); 
  require_once("rdio.php");

  // requires signed request
  define('CONSUMER_KEY', 'YOUR_CONSUMER_KEY');
  define('CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET');

  $rdio = new Rdio(CONSUMER_KEY, CONSUMER_SECRET);

  $rdioResults = $rdio->search(
    array(
      "query" => $query,
      "types" => "Track",
      "count" => 100,
      "never_or" => "true"))->result->results;
?>