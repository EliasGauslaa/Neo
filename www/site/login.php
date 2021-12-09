<?php
    // include_once "inc/header.php"
    include_once "inc/config.php"
?>
    
    <section>
        <h2>Logg inn</h2>
        <form action="inc/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Brukernavn/epost"><br>
            <input type="password" name="pwd" placeholder="Passord"><br>
            <button type="submit" name="submit">Logg inn</button>
        </form>
    
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fyll inn alle feltene</p>";
            }
    
            else if ($_GET["error"] == "wronglogin") {
                echo "<p>Feil logg inn</p>";
            }
    
            
        }
    ?>
    </section>
    
<?php
    include_once "inc/footer.php"
?>