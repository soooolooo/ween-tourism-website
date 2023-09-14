<?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        if (isset($_POST["placeSubmit"])){
            $placecategory = $_POST["placecategory"];
            $placename = $_POST["placename"];
            $placedesc = $_POST["placedesc"];
            $placelocation = $_POST["placelocation"];
            $placeimg1 = $_FILES["placeimg1"]["name"];
            $placeimg2 = $_FILES["placeimg2"]["name"];
            $placeimg3 = $_FILES["placeimg3"]["name"];
            $placeimg1Temp = $_FILES["placeimg1"]["tmp_name"];
            $placeimg2Temp = $_FILES["placeimg2"]["tmp_name"];
            $placeimg3Temp = $_FILES["placeimg3"]["tmp_name"];
            $placerecommended = $_POST["recommended"];
            $uploadLocation = '../project/places/gfx/';

            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';

            move_uploaded_file($_FILES["placeimg1"]["tmp_name"], $uploadLocation.$placeimg1);
            move_uploaded_file($_FILES["placeimg2"]["tmp_name"], $uploadLocation.$placeimg2);
            move_uploaded_file($_FILES["placeimg3"]["tmp_name"], $uploadLocation.$placeimg3);
            addPlace($conn, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3, $placerecommended);
            header("location: ../project/admin.php");
            exit();
        }

        else if(isset($_GET['delete'])){
            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            
            $placeid = $_GET['delete'];
            deletePlace($conn, $placeid);
        }

        else if(isset($_POST["commentSubmit"])){
            $commenter = $_POST["commenter"];
            $comment = $_POST["comment"];
            $rate = $_POST["rate"];
            $commentPlaceId = $_POST["commentPlaceId"];
            $category = $_POST["placeCategory"];

            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            addComment($conn, $commenter, $comment, $rate, $commentPlaceId, $category);
            header("location: ../project/places/$category.php?id=$commentPlaceID");
            exit();
        }

        else if(isset($_POST["commentDelete"])){
            // $commenter = $_POST["commenter"];
            // $commentPlaceId = $_POST["commentPlaceId"];
            // $category = $_POST["placeCategory"];
            
            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            $commentid = $_POST["commentId"];
            $category = $_POST["placeCategory"];
            $commentPlaceId = $_POST["commentPlaceId"];
            deleteComment($conn, $commentid, $category, $commentPlaceId);
            header("location: ../project/places/$category.php?id=$commentPlaceID");
            exit();
        }

        else if (isset($_POST["editPlace"])){
            $placeid = $_POST["placeid"];
            $placecategory = $_POST["placecategory"];
            $placename = $_POST["placename"];
            $placedesc = $_POST["placedesc"];
            $placelocation = $_POST["placelocation"];
            $placeimg1 = $_FILES["placeimg1"]["name"];
            $placeimg2 = $_FILES["placeimg2"]["name"];
            $placeimg3 = $_FILES["placeimg3"]["name"];
            $placeimg1Temp = $_FILES["placeimg1"]["tmp_name"];
            $placeimg2Temp = $_FILES["placeimg2"]["tmp_name"];
            $placeimg3Temp = $_FILES["placeimg3"]["tmp_name"];
            $uploadLocation = '../project/places/gfx/';

            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';

            if (strlen($placeimg1) != 0){
                move_uploaded_file($_FILES["placeimg1"]["tmp_name"], $uploadLocation.$placeimg1);
            }
            if (strlen($placeimg2) != 0){
                move_uploaded_file($_FILES["placeimg2"]["tmp_name"], $uploadLocation.$placeimg2);
            }
            if (strlen($placeimg1) != 0){
                move_uploaded_file($_FILES["placeimg3"]["tmp_name"], $uploadLocation.$placeimg3);  
            } 
            editPlaces($conn, $placeid, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3);
            header("location: ../project/admin.php");
            exit();
        }

        else if (isset($_POST["admin"])){
            $id = $_POST["id"];
            $adminvalue = $_POST["isadmin"];
            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            admins($conn, $id, $adminvalue);
            header("location: ../project/admin.php");
            exit();
        }
        
?>