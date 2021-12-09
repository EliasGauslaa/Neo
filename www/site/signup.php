<?php

include_once "inc/header.php"
?>

<link rel="stylesheet" type="text/css" href="css/Bootstrap/bootstrap.css">

<section>
    <div class="container">
        <div class="row">
            <div class="card-header">
        <h2>Registrer en ny leder</h2>
            </div>
            <div class="card-body">
    <form action="inc/signup.inc.php" method="post">
        <input type="text" class="form-control" name="name" placeholder="Fullt navn"><br>
        <input type="text" class="form-control" name="email" placeholder="Email"><br>
        <input type="text" class="form-control" name="uid" placeholder="Brukernavn"><br>
        <input type="password" class="form-control" name="pwd" placeholder="Passord"><br>
        <input type="password" class="form-control" name="pwd2" placeholder="Passord igjen"><br>
        <button type="submit" class="btn btn-primary" name="submit">Registrèr</button>
    </form>
            </div>
        </div>
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