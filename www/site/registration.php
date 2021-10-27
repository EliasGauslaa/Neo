
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

        if(isset($_POST["registrer"])) {
            echo "Bruker registrert";
        }
 
    ?>
  <form action="registration.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                <h1>Registration</h1>
                <p>Fill in the form to register</p>

                <label for="fnavn"><b>First name</b></label>
                <input class="form-control" type="text" name="fnavn" placeholder="Fornavn" required><br>

                <label for="enavn"><b>Last name</b></label>
                <input class="form-control" type="text" name="enavn" placeholder="Etternavn" required><br>

                <label for="adresse"><b>Adress</b></label>
                <input class="form-control" type="text" name="adresse" placeholder="Gateadresse" required><br>
    
                <label for="pnummer"><b>Postal code</b></label>
                <input class="form-control" type="int" name="pnummer" placeholder="Postnummer" required><br>
                
                <label for="kjønn"><b>Gender</b></label>
                <input type="radio" name="kjønn" value="Mann"> Male
                <input type="radio" name="kjønn" value="Kvinne"> Female<br>

                <label for="email"><b>E-mail</b></label>
                <input class="form-control" type="email" name="epost" placeholder="E-post" required><br>

                <label for="tlf"><b>Phone number</b></label>
                <input class="form-control" type="tel" name="tlf" placeholder="Mobilnummer" required><br>

                <label for="fdato"><b>Date of birth</b></label>
                <input type="date" name="fdato" value="1998-05-05" required><br>
                
                <label for="mdato"><b>Member since</b></label>
                <input type="date" name="mdato" value="2020-04-10" required><br>

                <label for="interesser"><b>Interests</b></label>
                <input class="form-control" type="text" name="interesser" placeholder="Interesser"><br>

                <label for="kaktiviteter"><b>Course activities</b></label>
                <input class="form-control" type="text" name="kaktiviteter" placeholder="Kursaktiviteter"><br>

                <label for="betalt"><b>Contingent Status</b></label>
                <input type="radio" name="betalt" value="betalt"> Paid
                <input type="radio" name="betalt" value="ikkeBetalt"> Not Paid<br>
                
                <input type="submit" name="registrer" value="Registrér">
                </div>
            </div>
        </div>
  </form>
  </body>
  </html>
