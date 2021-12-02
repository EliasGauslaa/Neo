
    <html>
    <head>
      <title>Registrering av medlem</title>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
      <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    </head>
  <body>
    <?php
  include("inc/config.php");
  include("inc/navbar.php");
  include("inc/register.inc.php");

        if(isset($_POST["registrer"])) {
            echo "Bruker registrert";
        }
 
    ?>
  <form action="registration.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                <p>Fyll inn for å registrere et medlem</p>

                <label for="fnavn"><b>Fornavn</b></label>
                <input class="form-control" type="text" name="fnavn" placeholder="Fornavn" required><br>

                <label for="enavn"><b>Etternavn</b></label>
                <input class="form-control" type="text" name="enavn" placeholder="Etternavn" required><br>

                <label for="addresse"><b>Adresse</b></label>
                <input class="form-control" type="text" name="adresse" placeholder="Gateadresse" required><br>
    
                <label for="pnummer"><b>Postnummer</b></label>
                <input class="form-control" type="int" name="pnummer" placeholder="Postnummer" required><br>

                <label for="postAdresse"><b>Postadresse</b></label>
                <input class="form-control" type="text" name="postadresse" placeholder="Postadresse" required><br>

                <label for="tlf"><b>Telefon</b></label>
                <input class="form-control" type="tel" name="tlf" placeholder="Mobilnummer" required><br>
                
                <label for="email"><b>E-post</b></label>
                <input class="form-control" type="email" name="epost" placeholder="E-post" required><br>

                <label for="fdato"><b>Fødselsdato</b></label>
                <input type="date" name="fdato" value="" required><br>
                                
                <label for="kjønn"><b>Kjønn</b></label>
                <input type="radio" name="kjønn" value="1"> Male
                <input type="radio" name="kjønn" value="2"> Female<br>

                <label for="betalt"><b>Kontigentstatus</b></label>
                <input type="radio" name="betalt" value="betalt"> Paid
                <input type="radio" name="betalt" value="ikkeBetalt"> Not Paid<br>
                
                <input type="submit" name="registrer" value="Registrér">
                </div>
            </div>
        </div>
  </form>
  </body>
  </html>
