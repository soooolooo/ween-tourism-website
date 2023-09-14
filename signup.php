<?php
    include 'head.php';
    include 'header.php';
    include_once 'dbh.inc.php';
?>

    <main>

    <div class="welcome-div">
        <h1>Sign up page</h1>
    </div>

        <div class="login-container">
            <form action="signup.inc.php" method="post">    
                <div class="login">
                    <p>Enter your Username:</p>
                    <input id="username" name="username" type="text" required>
                    <p>Enter your Password:</p>
                    <input id="password" name="passwrd" type="password" required>
                    <p>Enter your Password again:</p>
                    <input id="password2" name="passwrd2" type="password" required><br><br>
                    <button type="submit" name="submit">Sign up</button>
                </div>
            </form>
        </div>
        
        
    </main>

    <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "emptyinput"){
                echo '<p>Fill in all fields</p>';
            }

            else if ($_GET["error"] == "invalidname"){
                echo '<p>Please use a proper name</p>';
            }

            else if ($_GET["error"] == "passwordnotsame"){
                echo '<p>Passwords dont match!</p>';
            }

            else if ($_GET["error"] == "nametaken"){
                echo '<p>Username already exists!</p>';
            }

            else if ($_GET["error"] == "stmtfailed"){
                echo '<p>STMT failed.</p>';
            }
        }
        ?>

    
    <footer>
    </footer>