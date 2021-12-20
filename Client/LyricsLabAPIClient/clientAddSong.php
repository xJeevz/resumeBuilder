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
    <h3>Upload Your Song</h3>      
</div>
<div class="col d-flex justify-content-center">
	 <div class="card text-white bg-dark mb-3" style="max-width: 27rem;">
		<div class="card-header">Upload song</div>
			<div class="card-body">
				<form action="http://localhost/LyricsLabAPIClient/addSong.php" method="post" enctype="multipart/form-data">
					<label>Upload Song: <input type= "file" name="uploadedSong" required/></label><br>
					<label>Title: <input type="text" name="song_name" required/></label><br />
					<label>Genre: <input type="text" name="genre_name" required/></label><br />
					<label>Artist: <input type="text" name="artist_name" required/></label><br />
					<label>lyrics:</label><br />
					<textarea id="lyrics" name="lyrics" rows="10" cols="50" style="resize: none;" required></textarea><br>
				<br>
				<input type="submit" name="action" />
				</form>
        </div>
    </div>
</div>
</body>
</html>
