<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';


    if (isset($_SESSION["is_admin"])){
        if ($_SESSION["is_admin"] != 1){
            header("location: ../project/index.php");
            exit();
        }
    }

    else {
        header("location: ../project/index.php");
        exit();
    }
?>



<main>
    <div class="welcome-div">
        <h1>Admin page</h1>
    </div>
    <div class="admin-container">
        <h2>Users list<h2>
        <details>
        <table>    
            <tbody>    
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Registered time</th>
                    <th>Is admin?</th>
                </tr>
            <?php
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</td>';
                        echo '<td>'.$row['username'].'</td>';
                        echo '<td>'.$row['register_time'].'</td>';
                        if ($row['is_admin'] == '1'){
                            echo '<td>Admin</td>';
                            // echo '<form action="addplace.php" method="POST">';
                            // echo '<input type="hidden" name="id" value="id">';
                            // echo '<input type="hidden" name="isadmin" value="0">';
                            // echo '<td><button type="submit" name="admin">Remove admin</button></td>';
                            // echo '</form>';
                        }
                        else {
                            echo '<td>Not admin</td>';
                            // echo '<form action=addplace.php method=POST>';
                            // echo '<input type="hidden" name="id" value="id">';
                            // echo '<input type="hidden" name="isadmin" value="1">';
                            // echo '<td><button type="submit" name="admin">Make admin</button></td>';
                            // echo '</form>';
                        }
                        // if ($row['is_banned'] == '1'){
                        //     echo '<td><button>Unban</button></td>';
                        // }
                        // else{
                        //     echo '<td><button>Ban</button></td>';
                        // }
                        echo '</tr>';
                    }
                }
            ?>
            </tbody>
        </table>
        </details>
        
        <h2>Places list<h2>
        <details>
        <table>    
            <tbody>    
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Likes/Dislikes</th>
                    <!-- <th>Image 1 name</th>
                    <th>Image 2 name</th>
                    <th>Image 3 name</th> -->
                    <th>Recommended?</th>
                </tr>
            <?php
                $sql = "SELECT * FROM places";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                

                if (isset($_GET["add"])){
                    if ($_GET["add"] == "success"){
                        echo '<p>Place has been added successfully!</p>';
                    }
                }

                else if (isset($_GET["delete"])){
                    if ($_GET["delete"] == "success"){
                        echo '<p>Place has been deleted successfully!</p>';
                    }
                }

                if ($resultCheck > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</td>';
                        echo '<td>'.$row['category'].'</td>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>'.$row['description'].'</td>';
                        echo '<td>'.$row['location'].'</td>';
                        echo '<td>'.$row['likes'].'/'.$row['dislikes'].'</td>';
                        // echo '<td>'.$row['img1'].'</td>';
                        // echo '<td>'.$row['img2'].'</td>';
                        // echo '<td>'.$row['img3'].'</td>';
                        if ($row['recommended'] == '1'){
                            echo '<td>Yes</td>';
                        }
                        else {
                            echo '<td>No</td>';
                        }
                        echo '<td><a href="admin.php?edit='.$row['id'].'"><button>Edit</button></a></td>';
                        echo '<td><a href="addPlace.php?delete='.$row['id'].'"><button>Delete</button></a></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </tbody>
        </table>
        </details>
        
        <?php
            if (!isset($_GET["edit"])){
                    echo '<h2>Add new place<h2>';
                    echo '<details>';
                    echo '<div style="display: inline-block;">';
                    echo '<form action="addplace.php" method="POST" enctype="multipart/form-data">';
                    echo '<p>Enter Category:</p>';
                    echo '<input type="radio" name="placecategory" value="cafes" />
                            <label>Cafes</label>
                            <input type="radio" name="placecategory" value="restaurants" />
                            <label>Restaurants</label>
                            <input type="radio" name="placecategory" value="parks" />
                            <label>Parks</label>
                            <input type="radio" name="placecategory" value="malls" />
                            <label>Malls</label><br>';
                    echo '<p>Enter Name:</p>';
                    echo '<input id="placename" name="placename" type="text" required>';
                    echo '<p>Enter Description:</p>';
                    echo '<input id="placedesc" name="placedesc" type="text" required>';
                    echo '<p>Enter Location:</p>';
                    echo '<input id="placelocation" name="placelocation" type="text" required>';
                    echo '<p>Enter image 1</p>';
                    echo '<input type="file" id="placeimg1" name="placeimg1" accept="image/*" required>';
                    echo '<p>Enter image 2</p>';
                    echo '<input type="file" id="placeimg2" name="placeimg2" accept="image/*" required>';
                    echo '<p>Enter image 3</p>';
                    echo '<input type="file" id="placeimg3" name="placeimg3" accept="image/*" required>';
                    echo '<p>Recommended?</p>';
                    echo '<input type="radio" name="recommended" value="1" />
                            <label>Yes</label>
                            <input type="radio" name="recommended" value="0" />
                            <label>No</label><br>';
                    echo '<br><br><button type="submit" name="placeSubmit">Add</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</details>';
            }

            else {
                $get = $_GET["edit"];
                $sql = "SELECT * FROM places WHERE places.id = $get ";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                $row = $result->fetch_assoc();
                echo '<h2>Edit a place<h2>
                <h4><strong>Note: </strong>Click "Edit" button on the place wanted to be edited first</h4>
                <details>
                <div style="display: inline-block;">
                <form action="addplace.php" method="POST" enctype="multipart/form-data">
                    <input id="placeid" name="placeid" type="hidden" value="'.$row['id'].'">
                    <p>Enter Category:</p>
                    <input id="category" name="placecategory" type="text" value="'.$row['category'].'" required>
                    <p>Enter Name:</p>
                    <input id="placename" name="placename" type="text" value="'.$row['name'].'" required>
                    <p>Enter Description:</p>
                    <input id="placedesc" name="placedesc" type="text" value="'.$row['description'].'" required>
                    <p>Enter Location:</p>
                    <input id="placelocation" name="placelocation" type="text" value="'.$row['location'].'" required>
                    <p>Enter image 1</p>
                    <input type="file" id="placeimg1" name="placeimg1" accept="image/*">
                    <p>Enter image 2</p>
                    <input type="file" id="placeimg2" name="placeimg2" accept="image/*">
                    <p>Enter image 3</p>
                    <input type="file" id="placeimg3" name="placeimg3" accept="image/*">
                    <br><br><button type="submit" name="editPlace">Edit</button>
                </form>
                </div>
                </details>';
            }
        ?>
        
        
    </div>
</main>