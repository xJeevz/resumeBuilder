<?php
    $data = array(
        "client" => array("clientName" => "Test Testing", "address" => "123 Test St. Qc, 123123, CA", "email" => "test@test.com", "phone" => "15149999999"),
        "education"=> array(array("schoolName" => "Test School", "major" => "HS", "startYear" => "2010", "endYear" => "2019"), 
        array("schoolName" => "Vanier", "major" => "Comp Sci", "startYear" => "2020", "endYear" => "Present")),
        "experience" => array(array("companyName" => "Test Work", "description" => "Hello. This is a test. Working as a Worker.")),
        "skill" => array("MS Office", "JAVA", "Python")
    );

    $data_string = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/jwttoken/5289-7839");
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
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/resume/5289-7839");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    //curl_setopt($ch, CURLOPT_HEADER, true);
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
?>