<?php
    // include_once "inc/header.php"
    include_once "inc/config.php"
?>
    <html>
        <head>
            <title>Logg inn</title>
            <link rel="stylesheet" type="text/css" href="css/Bootstrap/bootstrap.css">
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Vennligst logg inn
                    </div>
                <div class="card-body">
                    
    <section>
        <h2>Logg inn</h2>
        <form action="inc/login.inc.php" method="post">

            <label for="uid">Brukernavn eller Mail-adresse</label>
            <input type="text" class="form-control" id="uid" name="uid" placeholder="Brukernavn/epost"><br>

            <label for="pwd">Passord</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Passord"><br>

            <button type="submit" class="btn btn-primary" name="submit">Logg inn</button>
        </form>
    </section>
                </div>
            <div class="card-footer">
                <small>&copy; Andreas Martinsen/EliasGauslaa</small>
            </div>
        </div>
    </div>
</div>
    
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