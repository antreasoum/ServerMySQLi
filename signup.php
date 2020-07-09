<main>
    <div>
        <section>
            <h1>Signup</h1>

            <?php
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyfields") {
                    echo "<p>Fill in all fields!</p>";
                }

                else if($_GET["error"] == "invalidunamemail") {
                    echo "<p>Invalid username and e-mail!</p>";

                }

                else if($_GET["error"] == "invaliduname") {
                    echo "<p>Invalid username!</p>";

                }

                else if($_GET["error"] == "invalidmail") {
                    echo "<p>Invalid e-mail!</p>";

                }

                else if($_GET["error"] == "passwordcheck") {
                    echo "<p>Your passwords do not match!</p>";

                }

                else if($_GET["error"] == "usertaken") {
                    echo "<p>Username is already taken!</p>";

                }
            }

            else if(isset($_GET["signup"])) {
                echo "<p>Signup successful!</p>";
            }
        
            
            ?>

            <form action="includes/signup-inc.php" method="POST">
                <input type="text" name="uname" placeholder="Username">
                <input type="text" name="mail" placeholder="Email">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-verify" placeholder="Verify password">

                <button type="submit" name="signup-submit">Signup</button>
                <li><a href="/login/">Home</a></li>
            </form>
        </section>
    </div>
</main>