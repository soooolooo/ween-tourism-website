<?php
        if (isset($_POST["submit"])){
            $name = $_POST["username"];
            $passwrd = $_POST["passwrd"];
            $passwrd2 = $_POST["passwrd2"];

            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';

            if (invalidName($name) !== false){
                header("location: ../project/signup.php?error=invalidname");
                exit();
            }

            else if (invalidPasswrd($passwrd, $passwrd2) !== false){
                header("location: ../project/signup.php?error=passwordnotsame");
                exit();
            }

            else if (userExists($conn, $name) !== false){
                header("location: ../project/signup.php?error=nametaken");
                exit();
            }

            createUser($conn, $name, $passwrd);

        }
        header("location: ../project/signup.php?error=none");
        exit();
?>