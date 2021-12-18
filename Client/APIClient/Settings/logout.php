<?php
    session_start();
    if(!isset($_SESSION['clientName'])){
        header('location: ../index.php');
    }
    session_unset();
    header('location: ../index.php');
?>