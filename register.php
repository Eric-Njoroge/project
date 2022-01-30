<?php


include("connection.php");
include("functions.php");

error_reporting(0);



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Order Management - Register</title>

    <!-- Custom fonts for this template-->

    <link href="theme/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="theme/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="">
                <!-- Nested Row within Card Body -->
                <div class="">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="includes/signup.inc.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="firstname" id="exampleFirstName" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="lastname" id="exampleLastName" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="role">
                                            <option disabled>Choose a role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Pharmacist">Pharmacist</option>

                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                    <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                        <?php
        if (isset($_GET["error"])) {
            # code...
            if ($_GET["error"] == "emptyinput") {
                # code...

                echo "<p> Fill in all the fields</p>";
            } elseif ($_GET["error"] == "invalidemail") {
                # code...

                echo "<p>Choose a proper email!</p>";
            } elseif ($_GET["error"] == "invalidfirstname") {
                # code...

                echo "<p>Choose a proper first name!</p>";
            } elseif ($_GET["error"] == "invalidlastname") {
                # code...

                echo "<p>Choose a proper last name!</p>";
            } elseif ($_GET["error"] == "passwordsdontmatch") {
                # code...

                echo "<p>Passwords dont match!</p>";
            } elseif ($_GET["error"] == "stmtfailed") {
                # code...

                echo "<p>Something went wrong. Try Again!</p>";
            } elseif ($_GET["error"] == "emailtaken") {
                # code...

                echo "<p>Email already Exists ! Choose another</p>";
            } elseif ($_GET["error"] == "none") {
                # code...

                echo "<p>You Have Successfully Signed Up!</p>";
            }
        }

        ?>
                    </div>
                </div>
            </div>
        </div>
      
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="theme/vendor/jquery/jquery.min.js"></script>
    <script src="theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="theme/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="theme/js/sb-admin-2.min.js"></script>

</body>

</html>