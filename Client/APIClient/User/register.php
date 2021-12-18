<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>

  <h1>Client Register</h1>

  <form action="" method="POST">
    <label for="clientName">Client Full Name:</label><br>
    <input type="text" id="clientName" name="clientName" required><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" required><br><br>
    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone" required><br><br>
    <input type="submit" name="Submit">
  </form>
  </br>
    <a href="../index.php">Login</a>
    </br>
</body>
</html>

<?php
    if(isset($_POST['Submit'])){
        $data = array(
            "client" => array("clientName" => $_POST["clientName"], 
                "email" => $_POST["email"], 
                "phone" => $_POST["phone"])
        );
        
        $data_string = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type:application/json',
                'Content-Length: ' . strlen($data_string),
                'Accept:application/json',
            )
        );
        
        $result = curl_exec($ch);
        curl_close($ch);
    }
?>


