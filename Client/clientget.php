<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/jwttoken/5289-7839");
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
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/resume/5289-7839");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type:application/json',
            'Accept:application/json',
            'Authorization: Bearer' . $result
        )
    );
        
    $result = curl_exec($ch);
    curl_close($ch);
?>
