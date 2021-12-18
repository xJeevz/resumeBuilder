<?php
    session_start();
    if(!isset($_SESSION['clientName'])){
        header('location: ../index.php');
    }
    $data = $_SESSION["clientName"];

    $data_string = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/" . $_SESSION["licenseKey"]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
    echo $result;
    header("Location: ../Settings/logout.php");
?>