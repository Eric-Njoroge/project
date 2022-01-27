<?php

if (isset($_POST["submit"])) {
    # code...

    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "../connection.php";
    require_once "../functions.php";

    if (emptyInputLogin( $email, $password) !== false) {
        # code...
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($con, $email, $password);
}
else {
    # code...
    header("location: ../login.php");
    exit();
    
}