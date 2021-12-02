
<?php
include("inc/config.php");
include("inc/header.php");
include("inc/activities.inc.php");
?>

<?php
        if(isset($_POST["registrer"])) {
            echo "Aktivitet registrert";
        }
        
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Aktiviteter</title>
        <h1>Legg til aktivitet</h1>
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    </head>
<body>
    <form action="activities.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                <p>Fyll inn for å registrere et medlem</p>

                <label for="activity"><b>Aktivitet</b></label>
                <input class="form-control" type="text" name="activity" placeholder="Navn på aktivitet" required><br>

                <label for="responsible"><b>Kursansvarlig</b></label>
                <input class="form-control" type="text" name="responsible" placeholder="Fullt navn" required><br>

                <label for="date"><b>Dato</b></label>
                <input class="form-control" type="date" name="date" required><br>

                <label for="start"><b>Klokkeslett start</b></label>
                <input class="form-control" type="time" name="start" required><br>

                <label for="end"><b>Klokkeslett slutt</b></label>
                <input class="form-control" type="time" name="end" required><br>

                <input type="submit" name="submit" value="Registrér">

                </div>
            </div>
        </form>
</body>
