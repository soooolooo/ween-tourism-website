<?php
    function invalidName($name){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]/", $name)){
            $result = true;
        }

        else{
            $result = false;
        }

        return $result;
    }

    function invalidPasswrd($passwrd, $passwrd2){
        $result;
        if ($passwrd !== $passwrd2){
            $result = true;
        }

        else{
            $result = false;
        }

        return $result;
    }

    function userExists($conn, $name){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if ($row = $resultData->fetch_assoc()){
            return $row;
        }

        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $passwrd){
        $sql = "INSERT INTO users (username, passwrd)
                VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/signup.php?error=stmtfailed");
            exit();
        }

        $hashedpasswrd = password_hash($passwrd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $name, $hashedpasswrd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../project/success.php");
        exit();
    }


    function loginUser($conn, $username, $passwrd){
        $idExists = userExists($conn, $username);

        if ($idExists === false){
            header("location: ../project/login.php?error=wronglogin");
            exit();
        }

        $passwordHashed = $idExists["passwrd"];
        $checkpasswrd = password_verify($passwrd, $passwordHashed);

        if ($checkpasswrd === false){
            header("location: ../project/login.php?error=wronglogin");
            exit();
        }

        else if ($checkpasswrd === true){
            session_start();
            // $_SESSION["name"] = $idExists["username"];
            $_SESSION["name"] = $idExists["username"];
            $_SESSION["is_admin"] = $idExists["is_admin"];
            header("location: ../project/index.php");
            exit();
        }
    }

    function addPlace($conn, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3, $placerecommended){
        $sql = "INSERT INTO places (category, name, description, location, img1, img2, img3, recommended)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/admin.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssssssss", $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3, $placerecommended);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../project/admin.php?add=success");
        exit();
    }

    function editPlace($conn, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3){
        $sql = "INSERT INTO places (category, name, description, location, img1, img2, img3)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/admin.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssss", $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../project/admin.php?add=success");
        exit();
    }

    function deletePlace($conn, $placeid){
       
        $sql = "DELETE FROM places WHERE places.id = $placeid";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/admin.php?delete=stmtfailed");
            exit();
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../project/admin.php?delete=success");
        exit();
    }

    function addComment($conn, $commenter, $comment, $rate, $commentPlaceId, $category){
        $sql = "SELECT * FROM reviews";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $oldCommenter = null;       
            while($row = $result->fetch_assoc()){
                if ($row['commenter'] == $commenter && $row['placeid'] == $commentPlaceId){
                    $oldCommenter = $row['commenter'];
                }
            }
            if ($oldCommenter == null){
                $sql = "INSERT INTO reviews (commenter, message, rate, placeid)
                VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("locaton: ../project/places/$category.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "ssss", $commenter, $comment, $rate, $commentPlaceId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header("location: ../project/places/$category.php?id=$commentPlaceId");
                exit();
            }

            else{
                header("location: ../project/places/$category.php?id=$commentPlaceId");
                exit();
            }
    }

    function deleteComment($conn, $commentid, $category, $commentPlaceId){
        $sql = "DELETE FROM reviews WHERE reviews.id = $commentid";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/places/".$category.".php?delete=stmtfailed");
            exit();
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../project/places/".$category.".php?id=".$commentPlaceId."");
        exit();
    }

    // function editPlaces($conn, $placeid, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3){
    //     if ($placeimg1 !== null && $placeimg2 !== null && $placeimg3 !== null){
    //         $sql = "UPDATE places SET places.category = $placecategory, places.name = $placename, places.description = $placedesc, places.location = $placelocation, places.img1 = $placeimg1, places.img2 = $placeimg2, places.img3 = $placeimg3 WHERE places.id = $placeid";
    //         $stmt = mysqli_stmt_init($conn);
    //         if (!mysqli_stmt_prepare($stmt, $sql)){
    //             header("locaton: ../project/places/admin.php?delete=stmtfailed");
    //             exit();
    //         }
    //         mysqli_stmt_execute($stmt);
    //         mysqli_stmt_close($stmt);
    //         header("location: ../project/places/admin.php");
    //         exit();
    //     }

    //     else {
    //         $sql = "UPDATE places SET places.category = $placecategory, places.name = $placename, places.description = $placedesc, places.location = $placelocation WHERE places.id = $placeid";
    //         $stmt = mysqli_stmt_init($conn);
    //         if (!mysqli_stmt_prepare($stmt, $sql)){
    //             header("locaton: ../project/places/admin.php?delete=stmtfailed");
    //             exit();
    //         }
    //         // mysqli_stmt_bind_param($stmt, "sssssss", $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3);
    //         mysqli_stmt_execute($stmt);
    //         mysqli_stmt_close($stmt);
    //         header("location: ../project/places/admin.php");
    //         exit();
    //     }
        
    //     header("location: ../project/places/admin.php");
    //     exit();
    // }

    function editPlaces($conn, $placeid, $placecategory, $placename, $placedesc, $placelocation, $placeimg1, $placeimg2, $placeimg3){
    // if (strlen($placeimg1) != 0 && strlen($placeimg2) != 0 && strlen($placeimg3) != 0) {
        if (strlen($placeimg1) != 0){
            $query = $conn->prepare("UPDATE places SET places.img1 = ? WHERE places.id = ?");
            if (!$query->bind_param("si", $placeimg1, $placeid)){ 
                header("locaton: ../project/admin.php?delete=stmtfailed");
                exit();
            }
            $query->execute();
        }
        if (strlen($placeimg2) != 0){
            $query = $conn->prepare("UPDATE places SET places.img2 = ? WHERE places.id = ?");
            if (!$query->bind_param("si", $placeimg2, $placeid)){ 
                header("locaton: ../project/admin.php?delete=stmtfailed");
                exit();
            }
            $query->execute();
        }
        if (strlen($placeimg3) != 0){
            $query = $conn->prepare("UPDATE places SET places.img3 = ? WHERE places.id = ?");
            if (!$query->bind_param("si", $placeimg3, $placeid)){ 
                header("locaton: ../project/admin.php?delete=stmtfailed");
                exit();
            }
            $query->execute();
        }
        $query = $conn->prepare("UPDATE places SET places.category = ?, places.name = ?, places.description = ?, places.location = ? WHERE places.id = ?");
        if (!$query->bind_param("ssssi", $placecategory, $placename, $placedesc, $placelocation, $placeid)) 
        {
            header("locaton: ../project/admin.php?delete=stmtfailed");
            exit();
        }
        $query->execute();
        $query->close();
        header("location: ../project/admin.php");
        exit();
    // } else {
    //     $query = $conn->prepare("UPDATE places SET places.category = ?, places.name = ?, places.description = ?, places.location = ? WHERE places.id = ?");
    //     print("conn prepared");
    //     if (!$query->bind_param("ssssi", $placecategory, $placename, $placedesc, $placelocation, $placeid)) 
    //     {
    //         header("locaton: ../project/admin.php?delete=stmtfailed");
    //         exit();
    //     }
    //     print("bind param");
    //     $query->execute();
    //     print("execute");
    //     printf("Error message: %s\n", $conn->error);
    //     $query->close();
    //     print("close");
    //     header("location: ../project/admin.php");
    //     exit();
    //     }
    }

    function admins($conn, $id, $adminvalue){
        $query = $conn->prepare("UPDATE users SET users.is_admin = ? WHERE users.id = ?");
        if (!$query->bind_param("si", $adminvalue, $id)){ 
            header("locaton: ../project/admin.php?delete=stmtfailed");
        }
        $query->execute();
        $query->close();
        header("location: ../project/admin.php");
        exit();
    }
?>