
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
  include("inc/interest.inc.php");

        if(isset($_POST["registrer"])) {
            echo "Bruker registrert";
        }
   
        $sql = "SELECT interest FROM interests";
        $result = mysqli_query($conn, $sql);

   ?>
  <form action="registration.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="card">
                <div class="card-header">
                <p>Fyll inn for å registrere et medlem</p>
                </div>

                <div class="card-body">
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
                <input type="date" class="form-control" name="fdato" value="" required><br>
                                
                <label for="kjønn"><b>Kjønn</b></label>
                <input type="radio" name="kjønn" value="1"> Gutt
                <input type="radio" name="kjønn" value="2"> Jente<br>

                <label for="betalt"><b>Kontigentstatus</b></label>
                <input type="radio" name="betalt" value="Betalt"> Betalt
                <input type="radio" name="betalt" value="Ikke Betalt"> Ikke betalt<br>

                <label for="interest"><b>Interesse</b></label>
                <select>
                  <option></option>
                  <?php                
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value=" . $row['interest'] ."'>" . $row['interest'] ."</option>";
                    }
                  ?>
                </select>
                
                <br><br>
                <input type="submit" class="btn btn-primary" name="registrer" value="Registrer">
                  </div>
                </div>
            </div>
        </div>
  </form>
  </body>
  </html>
