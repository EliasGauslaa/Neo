<?php
include("inc/header.php");

$member_ID = $_GET['memberID']; // henter memberID fra valgt rad

$member_select = mysqli_query($conn,"select * from member where memberID = $member_ID"); // velger alt fra member med valgt memberID

// henter verdiene fra raden
$rowMember = mysqli_fetch_array($member_select);

// henter verdier fra role som bruker i dropdown 
$role_select = $conn->query("SELECT * FROM role");

if(isset($_POST['edit'])){

    // input fra feltene plasseres i variabler
    $firstName_post = ucfirst($_POST['firstName']);
    $lastName_post = ucfirst($_POST['lastName']);
    $address_post = ucfirst($_POST['address']);
    $zipCode_post = $_POST['zipCode'];
    $postAddress_post = ucfirst($_POST['postAddress']);
    $phone_post = $_POST['phone'];
    $email_post = $_POST['email'];
    $contingentStatus_post = $_POST['contingent'];

    // oppdaterer member med de nye verdiene
    $editMember = mysqli_query($conn, "UPDATE member SET firstName='$firstName_post', lastName='$lastName_post', address='$address_post', zipCode=$zipCode_post, 
    postAddress='$postAddress_post', phone=$phone_post, email='$email_post', contingentStatus='$contingentStatus_post' WHERE memberID=$member_ID");

    //Kjører querien
    $query_run_editMember = mysqli_query($conn, $editMember);

    // plasserer valgt rolle og dens verdi i variabel 
    $ID = $_POST['role'];

    // Legger memberID og roleID i memberroles 
    $addRole = "INSERT INTO memberroles (`memberID`, `roleID`) VALUES ($member_ID, $ID)";

    // Kjører querien
    $query_run_addRole = mysqli_query($conn, $addRole);
    
    // Hvis en eller begge queriene går gjennom blir man sendt tilbake til hovedsiden
    if($query_run_editMember or $query_run_addRole){   
        mysqli_close($conn); // Close connection
        header("location:index.php"); // redirects to members page
        exit;
    }
    //feilmelding dersom noe går galt
    else {
        echo "noe gikk galt";
    } 
}

?>

<div>
    <form method="post">
        <div class="box">
            
        <!-- Feltene innehar databasens nåværende verdier -->
            <label for="firstName">Fornavn*</label>
            <input type="text" name="firstName" value="<?php echo $rowMember['firstName']?>" required>

            <label for="lastName">Etternavn*</label>
            <input type="text" name="lastName" value="<?php echo $rowMember['lastName']?>" required><br>

            <label for="address">Gateadresse*</label>
            <input type="text" name="address" value="<?php echo $rowMember['address']?>" required>

            <label for="zipCode">Postnummer*</label>
            <input type="text" name="zipCode" value="<?php echo $rowMember['zipCode']?>" required><br>

            <label for="postAddress">Poststed*</label>
            <input type="text" name="postAddress" value="<?php echo $rowMember['postAddress']?>" required><br>

            <label for="phone">Mobilnummer*</label>
            <input type="text" name="phone" value="<?php echo $rowMember['phone']?>" required>

            <label for="email">E-post*</label>
            <input type="text" name="email" value="<?php echo $rowMember['email']?>" required><br>

            <label for="role">Rolle</label>
            <select name="role">
            <option></option>
                <?php
                while ($rows = $role_select->fetch_assoc()){
                    $role = $rows['role'];
                    $ID = $rows['roleID'];
                    echo "<option value='$ID'>$role</option>";
            }
            ?>  
        </select>
        <br>

            <label for="contingent">Kontingentstatus*</label>
            <select name="contingent" required>
                <option></option>
                <option value="Betalt" <?php if($rowMember['contingentStatus']=="Betalt") echo 'selected="selected"'; ?>>Betalt</option>
                <option value="Ikke betalt" <?php if($rowMember['contingentStatus']=="Ikke betalt") echo 'selected="selected"'; ?>>Ikke betalt</option>
            </select><br>

            <input type="submit" name="edit" value="Rediger">
        </div>

        </form>
    </div>
<?php
    include("inc/footer.php");
?>