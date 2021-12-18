<?php 
session_start();
if(!isset($_SESSION['clientName']) || $_SESSION['clientName'] == ""){
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Resume</title>
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


  <h1>Create New Resume</h1>
  <div id="formElement">
        <form action="#" method="POST">
            <div>    
                <h2>Skills (Max:5)</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Skillset Name</label>
                    <input type="text" class="form-control" name="skill1" required>
                </div>
                <div id="addSkill"></div>
                <div class="mb-3">
                    <button type="button" id="skill_hide" onclick="addSkill()">+</button>
                </div>
            </div>
            <div>    
                <h2>Education (Max:3)</h2>
                <div>
                    <label for="exampleInputEmail1">School/College/University</label>
                    <input type="text" name="institute1">
                </div>
                <div>
                    <label for="exampleInputEmail1">Degree Name</label>
                    <input type="text" name="degree1">
                </div>
                <div>
                    <div>
                        <label for="exampleInputEmail1">From</label>
                        <input type="text" name="from1">
                    </div>
                    <div>
                        <label for="exampleInputEmail1">To</label>
                        <input type="text" name="to1">
                    </div>
                </div>
                <div id="addEducation"></div>
                <div>
                    <button type="button" id="education_hide" onclick="addEducation()">+</button>
                </div>
            </div>
            <div>    
                <h2>Experience (Max:3)</h2>
                <div>
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title1">
                </div>
                <div>
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description1">
                </div>
                <div id="addExperience"></div>
                <div>
                    <button type="button" id="experience_hide" onclick="addExperience()">+</button>
                </div>
            </div>
            <input type="submit" name="Submit">
        </form>
    </div>
    </div>
    <script src="../js/app.js"></script>
</br>
</br>

</body>
</html>

<?php
  if(isset($_POST['Submit'])){
    $skills = [];
    $institutes = [];
    $degrees = [];
    $froms = [];
    $tos = [];
    $titles = [];
    $descriptions = [];

    if(isset($_POST['skill1']) && !empty($_POST['skill1']))
    {
      array_push($skills,$_POST['skill1']);
    }

    if(isset($_POST['institute1']) && !empty($_POST['institute1'])) {
      array_push($institutes,$_POST['institute1']);
    }
    
    if(isset($_POST['degree1']) && !empty($_POST['degree1'])) {
      array_push($degrees,$_POST['degree1']);
    }
    
    if(isset($_POST['from1']) && !empty($_POST['from1'])) {
      array_push($froms,$_POST['from1']);
    }

    if(isset($_POST['to1']) && !empty($_POST['to1'])) {
      array_push($tos,$_POST['to1']);
    }
    
    if(isset($_POST['title1']) && !empty($_POST['title1'])) {
      array_push($titles,$_POST['title1']);
    }
    
    if(isset($_POST['description1']) && !empty($_POST['description1'])) {
      array_push($descriptions,$_POST['description1']);
    }
    
    

    if(isset($_POST['skill2']) && !empty($_POST['skill2']))
    {
      array_push($skills,$_POST['skill2']);
    }
    if(isset($_POST['skill3']) && !empty($_POST['skill3']))
    {
      array_push($skills,$_POST['skill3']);
    }
    if(isset($_POST['skill4']) && !empty($_POST['skill4']))
    {
      array_push($skills,$_POST['skill4']);
    }
    if(isset($_POST['skill5']) && !empty($_POST['skill5']))
    {
      array_push($skills,$_POST['skill5']);
    }

    if(isset($_POST['institute2']) && !empty($_POST['institute2']))
    {
      array_push($institutes,$_POST['institute2']);
      if(isset($_POST['degree2']) && !empty($_POST['degree2']))
      {
        array_push($degrees,$_POST['degree2']);
        if(isset($_POST['from2']) && !empty($_POST['from2']))
        {
          array_push($froms,$_POST['from2']);
          if(isset($_POST['to2']) && !empty($_POST['to2']))
          {
            array_push($tos,$_POST['to2']);
            if(isset($_POST['grade2']) && !empty($_POST['grade2']))
            {
              array_push($grades,$_POST['grade2']);
            }
          }
        } 
      }
    }
    if(isset($_POST['institute3']) && !empty($_POST['institute3']))
    {
      array_push($institutes,$_POST['institute3']);
      if(isset($_POST['degree3']) && !empty($_POST['degree3']))
      {
        array_push($degrees,$_POST['degree3']);
        if(isset($_POST['from3']) && !empty($_POST['from3']))
        {
          array_push($froms,$_POST['from3']);
          if(isset($_POST['to3']) && !empty($_POST['to3']))
          {
            array_push($tos,$_POST['to3']);
            if(isset($_POST['grade3']) && !empty($_POST['grade3']))
            {
              array_push($grades,$_POST['grade3']);
            }
          }
        } 
      }
    }
    if(isset($_POST['title2']) && !empty($_POST['title2']))
    {
      array_push($titles,$_POST['title2']);
      if(isset($_POST['description2']) && !empty($_POST['description2']))
      { 
        array_push($descriptions,$_POST['description2']);
      }
    }
    if(isset($_POST['title3']) && !empty($_POST['title3']))
    {
      array_push($titles,$_POST['title3']);
      if(isset($_POST['description3']) && !empty($_POST['description3']))
      {
        array_push($descriptions,$_POST['description3']);
      }
    }
      $educations = [];
      $education = [];
      foreach($institutes as $key=>$value) {
        $education = array("schoolName" => $institutes[$key], "major" => $degrees[$key], "startYear" => $froms[$key], "endYear" => $tos[$key]);
        array_push($educations, $education);
      }

      $experiences = [];
      $experience = [];
      foreach($titles as $key=>$value) {
        $experience = array("companyName" => $titles[$key], "description" => $descriptions[$key]);
        array_push($experiences, $experience);
      }

      echo "<script>";
      echo "var el = document.getElementById('formElement');";
      echo "el.remove();";
      echo "</script>";

      $data = array(
          "education"=> $educations,
          "experience" => $experiences,
          "skill" => $skills
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
      curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/resume/" . $_SESSION["licenseKey"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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