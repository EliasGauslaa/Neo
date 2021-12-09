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
    header("location: ../signup.php?error=emptyinput");
    exit();    
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=invalidmatch");
        exit();
    }

    if (uidExists($conn, $uid, $email) !== false) {
        header("location: ../signup.php?error=uidtaken");
        exit();
    }

    createUser($conn, $name, $email, $uid, $pwd);
}

else {
    header("location: ../signup.php");
    exit();
    }