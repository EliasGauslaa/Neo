<?php
include_once "config.php";

if(isset($_POST['registrer'])){
    $first = $_POST["fnavn"];
    $last = $_POST["enavn"];
    $address = $_POST["adresse"];
    $zip = $_POST["pnummer"];
    $zipCity = $_POST["postadresse"];
    $email = $_POST["epost"];
    $phone = $_POST["tlf"];
    $birthDate = $_POST["fdato"];
    $gender = $_POST["kjønn"];
    $status = $_POST["betalt"];

    $sql = "INSERT INTO member (firstName, lastName, address, 
    zipCode, postAddress, phone, email, born,
    genderID, memberSince, contingentStatus) 
    VALUES ('$first', '$last', '$address', '$zip',
    '$zipCity', '$phone', '$email', '$birthDate',
    '$gender', 'CURDATE()', '$status');";

    mysqli_query($conn, $sql);
}
?>