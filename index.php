<?php
    include 'head.php';
    include 'header.php';
    include_once 'dbh.inc.php';
?>


<main>
    <div class="welcome-div">
        <h1>Home</h1>
    </div>

    <div class="places-container">
            <h3>Recommended places</h3>
            <?php
                $sql = "SELECT * FROM places WHERE recommended = '1'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                

                if ($resultCheck > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<a href="places/'.$row['category'].'.php?id='.$row['id'].'">';
                        echo '<div class="place" style="background-image: url(places/gfx/'.$row['img1'].');">';
                        echo '<p style="padding-bottom: 150px;">'.$row['name'].'</p>';
                        echo '<div class="star">';
                        echo '<p>&#9733&#9733&#9733&#9733&#9734</p>';
                        echo '</div>';
                        echo '<p>'.$row['location'].'</p>';
                        echo '</div>';
                        echo '</a>';
                    }
                }
            ?>
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
    </div>

    <div class="places-container">
        <h3>Choose the place you want to discover!</h3>

        <a href="places/cafes.php">
            <div class="places" style="background-image: url(gfx/cafes.jpg);">
                <h4>Cafe's</h4>
            </div>
        </a>

        <a href="places/restaurants.php">
            <div class="places" style="background-image: url(gfx/restaurants.jpg);">
                <h4>Restaurants</h4>
            </div>
        </a>

        <a href="places/malls.php">
            <div class="places" style="background-image: url(gfx/malls.jpg);">
                <h4>Malls</h4>
            </div>
        </a>

        <a href="places/parks.php">
            <div class="places" style="background-image: url(gfx/parks.jpg);">
                <h4>Parks</h4>
            </div>
        </a>
    </div>
</main>

<footer>

</footer>