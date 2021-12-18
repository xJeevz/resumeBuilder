<?php 
session_start();
if(!isset($_SESSION['clientName'])){
    header('location: ../index.php');
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Settings</title>
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
<a href="../Settings/delete.php">Delete Client</a>
</br>
<a href="../Settings/logout.php">Log Out</a>

<script>
</script>

<?php

?>

</body>
</html>