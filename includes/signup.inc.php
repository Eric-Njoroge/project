<?php

if (isset($_POST["submit"])) {
    # code...
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    require_once "../connection.php";
    require_once "../functions.php";

    if (emptyInputSignup($firstname, $lastname, $email, $role, $password, $confirm_password) !== false) {
        # code...
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if (invalidFirstname($firstname) !== false) {
        # code...
        header("location: ../register.php?error=invalidfirstname");
        exit();
    }
    if (invalidLastname($lastname) !== false) {
        # code...
        header("location: ../register.php?error=invalidlastname");
        exit();
    }
    if (invalidEmail($email) !== false) {
        # code...
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password, $confirm_password) !== false) {
        # code...
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($con, $email) !== false) {
        # code...
        header("location: ../register.php?error=emailtaken");
        exit();
    }


    createUser($con, $firstname, $lastname, $email, $role, $password);


    if ($password == $confirm_password) {
        # code...
        // $sql = "INSERT INTO users (firstname, lastname, email, role, password)
        //  VALUES (' $firstname', '$lastname', ' $email ', ' $role', '$password ')";
        // $result = mysqli_query($con, $sql);
        if (!$result) {
            # code...
            echo "<script>alert('Something went wrong')</script>";
        }
    } else {
        # code...
    }
} else {
    # code...
    header("location: ../register.php");
    exit();
}
