<!DOCTYPE html>
<html>
<head>
	<title>API Lyrics Client</title>
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./../css/style.css">
</head>
<body style="background-color:rgb(13, 13, 13)">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href=''>API Lyrics Client</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href='http://localhost/LyricsLabAPIClient/index.php'>Songs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='http://localhost/LyricsLabAPIClient/clientAddSong.php'>Add Song<span class="sr-only">(current)</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="http://localhost/LyricsLabAPIClient/clientSearchSongs.php">
      <input class="form-control mr-sm-2" type="text" name="search_term" placeholder="Search for Title...">
      <input class="btn btn-outline-success my-2 my-sm-0" name="action" type="submit"></input>
    </form>
  </div>
</nav>
<div class="jumbotron text-center">
  <h3>Song Lyrics</h3>      
</div>
<div class="col d-flex justify-content-center">
<div class="card text-white bg-dark mb-3" style="max-width: 35rem;">
<?php
    
    if(isset($_GET["id"]))
    {
        $song_id = $_GET["id"];
    }
    $post = array('song_id' => $song_id);
    $ch = curl_init();
    $payload = json_encode($post, true);
    curl_setopt($ch, CURLOPT_URL, "http://localhost/WebServiceProject/LyricsLab/lyricsservice/api/song/searchOneSong");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
        'Content-Type:application/json',
        'Accept:application/json'
        )
        );
    
    $data = curl_exec($ch);
    curl_close($ch);
    $song = json_decode($data, true);
    foreach ($song["song"] as $song) {
      $song_id = $song["song_id"];
      $song_name = $song["song_name"];
      $artist_name = $song["artist_name"];
      $genre_name = $song["genre_name"];
      $lyrics = $song["lyrics"];
    }

    echo "<h2 class='card-title'>$song_name</h2>";
    echo "<h5 class='card-title'>By: $artist_name</h5>";
    echo "<p class='card-text'>$lyrics</p>";
?>  
</div>
</div>
</body>
</html>
