<?php
include("inc/header.php");

$member_ID = $_GET['memberID']; // Fetching memberID from chosen row

$member_select = mysqli_query($conn,"select * from member where memberID = $member_ID"); // Selecting all from member

$rowMember = mysqli_fetch_array($member_select);

$role_select = $conn->query("SELECT * FROM role");

if(isset($_POST['edit'])){

    $firstName_post = ucfirst($_POST['firstName']);
    $lastName_post = ucfirst($_POST['lastName']);
    $address_post = ucfirst($_POST['address']);
    $zipCode_post = $_POST['zipCode'];
    $postAddress_post = ucfirst($_POST['postAddress']);
    $phone_post = $_POST['phone'];
    $email_post = $_POST['email'];
    $contingentStatus_post = $_POST['contingent'];

    $editMember = mysqli_query($conn, "UPDATE member SET firstName='$firstName_post', lastName='$lastName_post', address='$address_post', zipCode=$zipCode_post, 
    postAddress='$postAddress_post', phone=$phone_post, email='$email_post', contingentStatus='$contingentStatus_post' WHERE memberID=$member_ID");

    $query_run_editMember = mysqli_query($conn, $editMember);

    $ID = $_POST['role'];

    $addRole = "INSERT INTO memberroles (`memberID`, `roleID`) VALUES ($member_ID, $ID)";

    $query_run_addRole = mysqli_query($conn, $addRole);
    
    if($query_run_editMember or $query_run_addRole){   
        mysqli_close($conn); // Close connection
        header("location:index.php"); // redirects to members page
        exit;
    }
    else {
        echo "noe gikk galt";
    } 
}

?>

<div>
    <form method="post">
        <div class="box">
            
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