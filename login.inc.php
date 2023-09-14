<?php
    if (isset($_POST["submit"])){
        $name = $_POST["name"];
        $passwrd = $_POST["passwrd"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        loginUser($conn, $name, $passwrd);
    }

    else {
        header("location: ../project/login.php");
        exit();
    }
?>