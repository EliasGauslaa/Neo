<?php

if (isset($_POST["submit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once "config.php";
    require_once "functions.inc.php";

    if (emptyInputLogin($uid, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();    
        }

    loginUser($conn, $uid, $pwd);
} else {
    header("location: ../index.php");
    exit();
}