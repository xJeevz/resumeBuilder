<?php
    $data = "Test Testing";

    $data_string = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/5289-7839");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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
?>
