<?php

include_once "inc/header.php"
?>

<section>
    <h2>Registrer</h2>
    <div>
    <form action="inc/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Fullt navn"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="uid" placeholder="Brukernavn"><br>
        <input type="password" name="pwd" placeholder="Passord"><br>
        <input type="password" name="pwd2" placeholder="Passord igjen"><br>
        <button type="submit" name="submit">Registrèr</button>
    </form>
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fyll inn alle feltene</p>";
        }

        else if ($_GET["error"] == "invalidemail") {
            echo "<p>Mail er feil</p>";
        }

        else if ($_GET["error"] == "invalidmatch") {
            echo "<p>Passord var ikke gjentatt riktig</p>";
        }

        else if ($_GET["error"] == "uidtaken") {
            echo "<p>Brukernavnet er tatt</p>";
        }

        else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Prøv igjen</p>";
        }

        else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Prøv igjen</p>";
        }
        
        else if ($_GET["error"] == "none") {
            echo "<p>Du er registrert</p>";
        }

        
    }
?>
</section>


<?php
include_once "inc/footer.php"
?>