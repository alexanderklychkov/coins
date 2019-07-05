<?php
    session_start();
    require_once "../db.php";
    $login = $_SESSION['user'];
    $number = $_GET['score'];
    
    $query3 = addScore($number, $login);
        if ($query3) {
            header('Location:../end.php');
        }