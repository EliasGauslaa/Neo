<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwd2"];

    require_once "config.php";
    require_once "functions.inc.php";

    if (emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) !== false) {    
    header("location: ../signup.php?error=emptyinput");     //checks for empty inputs
    exit();    
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit(); //checks for invalid email
    }
    
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=invalidmatch");
        exit(); //checks for matching password-inputs
    }

    if (uidExists($conn, $uid, $email) !== false) {
        header("location: ../signup.php?error=uidtaken");
        exit(); //checks if username or email exists in the db
    }

    createUser($conn, $name, $email, $uid, $pwd); //creates user with the inputs
}

else {
    header("location: ../signup.php");
    exit();
    }