<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h2>Client Login</h2>

  <form action="" method="GET">
    <label for="fullName">Full Name:</label><br>
    <input type="text" id="fullName" name="fullName" required><br>
    <label for="licenseKey">License Key:</label><br>
    <input type="text" id="licenseKey" name="licenseKey" required><br><br>
    <input type="submit" name="Submit">
  </form>
</br>
<a href="./User/register.php">Register</a>
</br>
</body>
</html>

<?php
    if(isset($_GET['Submit'])){
      $data = $_GET["fullName"];

      $data_string = json_encode($data);
  
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/" . $_GET["licenseKey"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
          array(
              'Content-Type:application/json',
              'Content-Length: ' . strlen($data_string),
              'Accept:application/json',
          )
      );
      
      $result = curl_exec($ch);
      curl_close($ch);
      if ($result == "License Key or Client Name Invalid") {
        echo $result;
      } elseif ($result == "Client Has been Validated") {
        session_start();
        $_SESSION['clientName'] = $_GET["fullName"];
        $_SESSION["licenseKey"] = $_GET["licenseKey"];
        header("Location: ./Home/create.php");
      }
    }
?>

