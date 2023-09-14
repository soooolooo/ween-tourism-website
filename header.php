<?php
    session_start();
?>
<header>
    <div class="logo-container">
        <h1>ويــن؟</h1>
    </div>
    <div class="navbar">
        <a href="../project/index.php">
            <div class="nav">
            <p>Home</p>
            </div>
        </a>
        <a href="../project/places.php">
            <div class="nav">
            <p>Places</p>
            </div>
        </a>
        <a href="../project/about_us.php">
            <div class="nav">
            <p>About us</p>
            </div>
        </a>
        <a href="../project/contact_us.php">
            <div class="nav">
            <p>Contact us</p>
            </div>
        </a>
        
        <?php
            if(isset($_SESSION["name"])){
                echo '<a href="../project/logout.php">';
                echo '<div class="nav">';
                echo '<p>Logout</p>';
                echo '</div>';
                echo '</a>';

                if ($_SESSION["is_admin"] == 1){
                    echo '<a href="../project/admin.php">';
                    echo '<div class="nav">';
                    echo '<p>Admin</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
            

            else{
                echo '<a href="../project/login.php">';
                echo '<div class="nav">';
                echo '<p>Login</p>';
                echo '</div>';
                echo '</a>';
            }
        ?>
        
    </div>
</header>