<?php 
session_start();
if(!isset($_SESSION['clientName'])){
    header('location: ../index.php');
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Save Resume</title>
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
</br>
<h1>Save Resume to S3 CDN</h1></br>
<form action="#" method="POST" enctype="multipart/form-data">
  <label for="filename">Choose a resume PDF file:</label></br>
  <input type="file" id="filename" name="filename" accept="application/pdf"></br>
  <input type="submit" name="Submit">
</form>

</body>
</html>

<?php
    if(isset($_POST['Submit'])){
      $data = array(
          'File' => $_FILES['filename']['tmp_name']
      );

      $data_string = json_encode($data);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/jwttoken/" . $_SESSION["licenseKey"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
          array(
              'Content-Type:application/json',
              'Content-Length: ' . strlen($data_string),
              'Accept:application/json'
          )
      );

      $result = curl_exec($ch);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/" . $_SESSION["licenseKey"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      //curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
          array(
              'Content-Type:application/json',
              'Content-Length: ' . strlen($data_string),
              'Accept:application/json',
              'Authorization: Bearer' . $result 
          )
      );
      
      $result = curl_exec($ch);
      curl_close($ch);
      echo $result;
  }
?>