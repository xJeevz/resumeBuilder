<?php
	error_reporting(~E_WARNING);
	$skills = [];
	$institutes = [];
	$froms = [];
	$tos = [];
	$titles = [];
	$descriptions = [];

	$fullName = explode(" ", $data["client"]["clientName"]);
	$first_name = $fullName[0];
	$last_name = $fullName[1];
	$email = $data["client"]["email"];
	$phone = $data["client"]["phone"];

	foreach($data["skill"] as $skill) {
	array_push($skills, $skill);
	}

	foreach($data["education"] as $educations) {
	array_push($institutes, $educations["schoolName"]);
	}

	foreach($data["education"] as $educations) {
	array_push($froms, $educations["startYear"]);
	}

	foreach($data["education"] as $educations) {
	array_push($tos, $educations["endYear"]);
	}

	foreach($data["experience"] as $experience) {;
	array_push($titles, $experience["companyName"]);
	}

	foreach($data["experience"] as $experience) {;
	array_push($descriptions, $experience["description"]);
	}
?>


<!DOCTYPE html>
<html>
<head>
	 
	<title> Resume Builder </title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="This ">


	<!--[CSS/JS Files - Start]-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
  
 	
	<style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap");
      @media print {
        @page {
          margin: 0;
          size: A4r;
        }
        * {
          -webkit-print-color-adjust: exact;
        }
      }
      * {
        font-family: "Montserrat", sans-serif;
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
      }
      .form-container
      {
          max-width: 768px;
          margin: 10px auto;
          padding: 30px;
          border: 1px solid black;
      }
      body {
        background: #5f6368;
      }

      .toCenter {
        width: 100%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .grid-container {
        margin: auto;
        display: grid;
        grid-template-columns: 0.33fr 1fr;
        width: 210mm;
        height: 297mm;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
      }
      .grid-container .zone-1 {
        padding: 40px 20px;
        padding-left: 35px;
        background: #d1d1d1;
        width: 100%;
        color: #313131;
      }
      .grid-container .zone-1 .profile {
        display: inline-flex;
        margin-bottom: 5px;
        margin-left: -15px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        /* background-image: url("https://image.freepik.com/free-photo/waist-up-portrait-handsome-serious-unshaven-male-keeps-hands-together-dressed-dark-blue-shirt-has-talk-with-interlocutor-stands-against-white-wall-self-confident-man-freelancer_273609-16320.jpg"); */
        background-position: center top;
        background-size: 200%;
        border: 4px solid #2c2b29;
      }
      .grid-container .zone-1 .contact-box {
        margin-top: 10px;
      }
      .grid-container .zone-1 .contact-box > * {
        width: 100%;
        display: grid;
        grid-template-columns: 0.3fr 1fr;
        margin-top: 25px;
        align-items: center;
      }
      .grid-container .zone-1 .contact-box > * i {
        font-size: 1.3em;
      }
      .grid-container .zone-1 .contact-box > * .text {
        display: inline-flex;
        word-break: break-all;
      }
      .grid-container .zone-1 .personal-box {
        margin-top: 35px;
      }
      .grid-container .zone-1 .personal-box > *:not(.title) {
        margin: 25px 0px;
        grid-template-columns: 0.55fr 1fr;
        display: grid;
      }
      .grid-container .zone-1 .personal-box .progress .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        background-color: #313131;
        border-radius: 50%;
        margin-left: 4px;
      }
      .margin-20
      {
        margin-left: 20px;
        margin-bottom: 10px;
        /* vertical-align: baseline; */
      }
      li::marker
      {
        /* margin-left: 20px; */
      font-size: 2rem;
        color: #9db858;
      }
      .d-flex
      {
        display: flex;
      }
      .align-items-center
      {
        align-items: center;
        padding-top: 1rem;
      }
      .circle
      {
        display: block;
        width: 10px;
        height: 10px;
        background-color: #9db858;
        border-radius: 50%;
        margin-right: 10px;
      }
      .grid-container .zone-1 .personal-box .progress .fa-star.active {
        color: #9db858;
        margin-right: 5px;
      }
      .grid-container .zone-1 .hobbies-box {
        margin-top: 35px;
      }
      .grid-container .zone-1 .hobbies-box .logo {
        margin: 10px 0px;
        display: grid;
        grid-template: 1fr 1fr/1fr 1fr;
        font-size: 2.8em;
        grid-row-gap: 15px;
      }
      .grid-container .zone-2 {
        background: #2c2b29;
        padding: 40px 20px;
        padding-right: 75px;
        color: #b5b5b4;
      }
      .grid-container .zone-2 .headTitle {
        font-size: 2.1em;
        color: #9db858;
      }
      .grid-container .zone-2 .headTitle h1 {
        font-weight: 400 !important;
      }
      .grid-container .zone-2 .subTitle h1 {
        font-weight: 400 !important;
      }
      .grid-container .zone-2 .box {
        display: inline-block;
        padding: 2px 70px 2px 20px;
        margin-left: -20px;
        margin-top: 35px;
        background: #9db858;
        color: #2c2b29;
      }
      .grid-container .zone-2 .group-1 .desc {
        margin-top: 15px;
        line-height: 1.5;
      }
      .grid-container .zone-2 .group-2 .desc {
        margin-top: 15px;
        margin-left: 20px;
      }
      .grid-container .zone-2 .group-2 .desc ul {
        position: relative;
        margin-top: 20px;
        margin-left: 5px;
      }
      .grid-container .zone-2 .group-2 .desc ul:before {
        content: "";
        position: absolute;
        top: 12px;
        left: -22px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #9db858;
      }
      .grid-container .zone-2 .group-2 .desc ul li {
        list-style-type: none;
        position: relative;
      }
      .grid-container .zone-2 .group-2 .desc ul li:before {
        content: "";
        position: absolute;
        top: 12px;
        left: -18px;
        height: 60px;
        border-left: 2px solid #9db858;
      }
      .grid-container .zone-2 .group-2 .desc ul:last-of-type li:before {
        content: none;
      }
      .grid-container .zone-2 .group-2 .desc ul li div:last-of-type {
        color: #9db858;
        font-weight: bold;
      }
      .grid-container .zone-2 .group-3 .desc {
        margin-top: 15px;
        margin-left: 20px;
      }
      .grid-container .zone-2 .group-3 .desc ul {
        position: relative;
        margin-top: 20px;
        margin-left: 5px;
      }
      .grid-container .zone-2 .group-3 .desc ul:before {
        content: "";
        position: absolute;
        top: 30px;
        left: -22px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #9db858;
      }
      .grid-container .zone-2 .group-3 .desc ul li {
        list-style-type: none;
        position: relative;
      }
      .grid-container .zone-2 .group-3 .desc ul li:before {
        content: "";
        position: absolute;
        top: 30px;
        left: -18px;
        height: 100px;
        border-left: 2px solid #9db858;
      }
      .grid-container .zone-2 .group-3 .desc ul:last-of-type li:before {
        content: none;
      }
      .grid-container .zone-2 .group-3 .desc ul li div:nth-child(2) {
        color: #9db858;
        font-weight: bold;
      }
    </style>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();
			
			var element = document.getElementById('container_content'); 



			//more custom settings
			var opt = 
			{
			  filename:     "<?php echo $first_name . " " . $last_name?>'s resume.pdf",
			  jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
			};

			// New Promise-based usage:
			var file = html2pdf().set(opt).from(element).save();
			 
		});
	});
	</script>

	 

</head>
<body>

<div class="text-center" style="padding:20px;">
	<input type="button" id="rep" value="Print" class="btn btn-info btn_print">
</div>


<div class="container_content" id="container_content" >
	<div class="grid-container">
		<div class="zone-1">

			<div class="contact-box">
			<div class="title">
				<h2>Contact</h2>
			</div>
			<div class="call"><i class="fas fa-phone-alt"></i>
				<div class="text"><?php echo $phone?></div>
			</div>
			<div class="email"><i class="fas fa-envelope"></i>
				<div class="text"><?php echo $email;?></div>
			</div>
			</div>
			<div class="personal-box">
			<div class="title">
				<h2>Skills</h2>
			</div>
			<?php 
			for($j=0; $j<count($skills); $j++){
				echo "<div class='skill-1'>
						<p><strong>" . strtoupper($skills[$j]) . "</strong></p>";
					echo '</div>';

			}
			?>
		</div>
	</div>

	<div class="zone-2">
		<div class="headTitle">
		<h1><?php echo ucwords($first_name);?><br><b><?php echo ucwords($last_name);?></b></h1>
		</div>
    </br>
		<div class="group-2">
		<div class="title">
			  <h2>Education</h2>
		</div>
		<div class="desc">
			<?php 
			for($i=0; $i<count($institutes);$i++)
			{
				echo "<ul>
				<li>
				<div class='msg-1'>" . $froms[$i] . "-" . $tos[$i]. " | " . ucwords($degrees[$i]) . ", " . $grades[$i]. "</div>
				<div class='msg-2'>" . ucwords($institutes[$i]) . "</div>
				</li>
			</ul>";
			}
			?>
		</div>
		</div>
		<div class="group-3">
		<div class="title">
			<h2>Experience</h2>	
		</div>
		<div class="desc">
		<?php 
			for($i=0; $i<count($titles);$i++)
			{
				echo "<ul>
				<li>
				<div class='msg-1'><br></div>
				<div class='msg-2'>" . ucwords($titles[$i]) ."</div>
				<div class='msg-3'>" . ucfirst($descriptions[$i]) . "</div>
				</li>
			</ul>";
			}
			?>
		</div>
		</div>
	</div>
</div>



</body>
</html>