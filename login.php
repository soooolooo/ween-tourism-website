<?php
    include 'head.php';
    include 'header.php';
    include_once 'dbh.inc.php';
?>

    <main>

    <div class="welcome-div">
        <h1>Login page</h1>
    </div>

        <div class="login-container">
            <form action="login.inc.php" method="post">    
                <div class="login">
                    <p>Username:</p>
                    <input id="username" name="name" type="text" required>
                    <p>Password:</p>
                    <input id="password" name="passwrd" type="password" required><br><br>
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
        <a href="signup.php"><button>Sign up</button></a>
        <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "wronglogin"){
                echo '<p>Username or password is not correct.</p>';
            }
        }
        ?>
    </main>

    
    <footer>
    </footer>