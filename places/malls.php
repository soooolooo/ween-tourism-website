<?php
    include 'head.php';
    include 'header.php';
    include_once 'dbh.inc.php';
?>
<main>
    <div class="welcome-div">
        <h1>Cafe's</h1>
    </div>
    
    <?php

        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = "SELECT * FROM places WHERE places.id = $id";
            $category;
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
                while($row = $result->fetch_assoc()){
                    $category = $row['category'];
                    echo '<div class="location-container">';
                        echo '<div class="location">';
                        
                            echo '<div class="photos">';
                                echo '<img src="gfx/'.$row['img1'].'">';
                                echo '<img src="gfx/'.$row['img2'].'">';
                                echo '<img src="gfx/'.$row['img3'].'">';
                            echo '</div>';
                        
                            echo '<div class="text">';
                                echo '<h1>'.$row['name'].'</h1>';
                                echo '<h2>'.$row['description'].'</h2>';
                                echo '<h3>'.$row['location'].'</h3>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }

            $sql = "SELECT * FROM reviews WHERE reviews.placeid = $id;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            echo '<h2>Reviews</h2>';
            echo '<div class="reviews">';
            if (isset($_SESSION["name"])){
                echo '<form action="../addPlace.php" method="POST">';
                echo '<br><input id="commenter" name="commenter" type="hidden" value="'.$_SESSION["name"].'">';
                echo '<input id="comment" name="comment" type="text" required><br><br>';
                echo '<input type="radio" name="rate" value="1" />
                <label>Like</label>
                <input type="radio" name="rate" value="0" />
                <label>Dislike</label><br>';
                echo '<input id="placeCategory" name="placeCategory" type="hidden" value="'.$category.'">';
                echo '<input id="placeid" name="commentPlaceId" type="hidden" value="'.$id.'">';
                echo '<button type="submit" name="commentSubmit">Comment</button>';
                echo '</form>';
            }
            
                while($row = $result->fetch_assoc()){
                        
                        echo '<div class="review">';
                        if (isset($_SESSION["name"]) && ($_SESSION["name"] == $row['commenter'] || $_SESSION["is_admin"] == 1)){
                            if (isset($_SESSION["name"]) && $_SESSION["name"] == $row['commenter']){
                                echo '<h3 style="text-align:center;">Your Comment</h3>';
                                echo '<form action="../addPlace.php" method="POST">';
                                echo '<br><input id="commenter" name="commenter" type="hidden" value="'.$_SESSION["name"].'">';
                                echo '<br><input id="placeid" name="commentPlaceId" type="hidden" value="'.$id.'">';
                                echo '<input id="placeCategory" name="placeCategory" type="hidden" value="'.$category.'">';
                                echo '<br><input id="commentid" name="commentId" type="hidden" value="'.$row['id'].'">';
                                echo '<button type="submit" name="commentDelete">Delete</button>';
                                echo '</form>';
                            }
                            else if (isset($_SESSION["is_admin"]) && $_SESSION['is_admin'] == 1){
                                echo '<form action="../addPlace.php" method="POST">';
                                echo '<br><input id="commenter" name="commenter" type="hidden" value="'.$row['commenter'].'">';
                                echo '<br><input id="placeid" name="commentPlaceId" type="hidden" value="'.$id.'">';
                                echo '<br><input id="commentid" name="commentId" type="hidden" value="'.$row['id'].'">';
                                echo '<input id="placeCategory" name="placeCategory" type="hidden" value="'.$category.'">';
                                echo '<button type="submit" name="commentDelete">Delete</button>';
                                echo '</form>';
                            }
                            
                        }
                        echo '<h3>'.$row['commenter'].'</h3>';
                        echo '<h4>'.$row['message'].'</h4>';
                        if ($row['rate'] == 1){
                            echo '<h6>Liked</h6>';
                        }
                        else{
                            echo '<h6>Not liked</h6>';
                        }
                        echo '</div>';
                }
                echo '</div>'; 
        }

        else{
            echo '<div class="places-container">
                    <div>
                        <h3>Recommended places</h3>';
            $sql = "SELECT * FROM places WHERE places.category = 'malls' AND places.recommended = '1'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);         
            if ($resultCheck > 0){
                while($row = $result->fetch_assoc()){
                    echo '<a href="cafes.php?id='.$row['id'].'">';
                    echo '<div class="place" style="background-image: url(gfx/'.$row['img1'].');">';
                    echo '<p style="padding-bottom: 150px;">'.$row['name'].'</p>';
                    echo '<div class="star">';
                    echo '<p>'.$row['likes'].'/'.$row['dislikes'].'</p>';
                    echo '</div>';
                    echo '<p>'.$row['location'].'</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
            echo '<div class="places-container">
                    <div>
                        <h3>All places</h3>';
            $sql = "SELECT * FROM places WHERE places.category = 'malls'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
                        
        
            if ($resultCheck > 0){
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$row['category'].'.php?id='.$row['id'].'">';
                    echo '<div class="place" style="background-image: url(gfx/'.$row['img1'].');">';
                    echo '<p style="padding-bottom: 150px;">'.$row['name'].'</p>';
                    echo '<div class="star">';
                    echo '<p>'.$row['likes'].'/'.$row['dislikes'].'</p>';
                    echo '</div>';
                    echo '<p>'.$row['location'].'</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
        }
    ?>

            
    
    
    







</main>

<footer>

</footer>

            <!--<a href="cafes/starbucks.php">
                <div class="place">
                    <p style="padding-bottom: 150px;">Name</p>
                    <div class="star">
                        <p>&#9733&#9733&#9733&#9733&#9734</p>
                    </div>
                    <p>test</p>
                </div>
            </a>
            <a href="cafes/starbucks.php">
                <div class="place">
                    <p style="padding-bottom: 150px;">Name</p>
                    <div class="star">
                        <p>&#9733&#9733&#9733&#9733&#9734</p>
                    </div>
                    <p>Street name</p>
                </div>
            </a>-->

                        <!--<div class="place">
                <p style="padding-bottom: 150px;">Name</p>
                <div class="star">
                    <p>&#9733&#9733&#9733&#9733&#9734</p>
                </div>
                <p>Street name</p>
            </div>
            <div class="place">
                <p style="padding-bottom: 150px;">Name</p>
                <div class="star">
                    <p>&#9733&#9733&#9733&#9733&#9734</p>
                </div>
                <p>Street name</p>
            </div>
            <div class="place">
                <p style="padding-bottom: 150px;">Name</p>
                <div class="star">
                    <p>&#9733&#9733&#9733&#9733&#9734</p>
                </div>
                <p>Street name</p>
            </div>
            <div class="place">
                <p style="padding-bottom: 150px;">Name</p>
                <div class="star">
                    <p>&#9733&#9733&#9733&#9733&#9734</p>
                </div>
                <p>Street name</p>
            </div>
            <div class="place">
                <p style="padding-bottom: 150px;">Name</p>
                <div class="star">
                    <p>&#9733&#9733&#9733&#9733&#9734</p>
                </div>
                <p>Street name</p>
            </div>
        </div>-->