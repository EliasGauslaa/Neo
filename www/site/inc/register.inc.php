<?php
include_once "config.php";

$first = $_POST["fnavn"];
$last = $_POST["enavn"];
$address = $_POST["addresse"];
$zip = $_POST["pnummer"];
$zipCity = $_POST["postadresse"];
$phone = $_POST["tlf"];
$email = $_POST["epost"];
$birthDate = $_POST["fdato"];
$gender = $_POST["kjønn"];
$status = $_POST["betalt"];

$sql = "INSERT INTO member (firstName, lastName, address, 
zipCode, postAddress, phone, email, born,
gender, memberSince, contingentStatus) 
VALUES ('$first', '$last', '$address', '$zip',
'$zipCity', '$phone', '$email', '$birthDate',
'$gender', 'CURDATE()', '$status');";

mysqli_query($conn, $sql);
?>