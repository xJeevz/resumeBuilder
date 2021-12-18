<?php 
session_start();
if(!isset($_SESSION['clientName'])){
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Get Resume</title>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  display: inline;
}
</style>
</head>
<body>

<ul>
  <li><a href="./create.php">Create Resume</a></li>
  <li><a href="./save.php">Save Resume to CDN</a></li>
  <li><a href="./get.php">Get Resume</a></li>
  <li><a href="./settings.php">Settings</a></li>
</ul>

</body>
</html>

<?php
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/jwttoken/" . $_SESSION["licenseKey"]);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER,
      array(
          'Content-Type:application/json',
          'Accept:application/json'
      )
  );

  $result = curl_exec($ch);


  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/resume/" . $_SESSION["licenseKey"]);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER,
      array(
          'Content-Type:application/json',
          'Accept:application/json',
          'Authorization: Bearer' . $result
      )
  );
      
  $result = curl_exec($ch);
  curl_close($ch);
  if($result == "Token is expired") {
    echo $result . ", ";
    echo '<a href="./create.php">Click Here</a> and Complete the form to Renew it.';
  } else {
    echo $result;
  }
?>