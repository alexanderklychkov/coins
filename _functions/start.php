<?php 
    session_start();
    require_once "../db.php";

    if($_GET['do_enter']) {
        if(!$_GET['login'] == "") {

            $login = $_GET['login'];
            $login = htmlspecialchars($login);
            $login = trim($login);
            $login = stripcslashes($login);
            
            $query = checkPlayer($login);

            if (mysqli_num_rows($query) > 0) {
                $x = 'Такое имя уже существует';
                header("Location:../index.php?get=$x");
            }
            else {
                $query2 = addPlayer($login);

                if ($query2) {
                    $_SESSION['user'] = $login;
                    header('Location:../game.php');
                }
            }
        }
    }

    