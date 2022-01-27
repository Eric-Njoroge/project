<?php

session_start ();



function emptyInputSignup($firstname, $lastname, $email, $role, $password, $confirm_password){
	$result;
	if (empty($firstname)|| empty($lastname) || empty($email) || empty($role) || empty($password) || empty($confirm_password)) {
		# code...
		$result = true;
	}else {
		# code...
		$result = false;
	}
	return $result;
}

function invalidFirstname($firstname){
	$result;
	if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
		# code...
		$result = true;
	}else {
		# code...
		$result = false;
	}
	return $result;
}

function invalidLastname($lastname){
	$result;
	if (!preg_match("/^[a-zA-Z]*$/", $lastname)){
		# code...
		$result = true;
	}else {
		# code...
		$result = false;
	}
	return $result;
}

function invalidEmail($email){
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	# code...
	$result = true;
}else {
	# code...
	$result = false;
}
return $result;
}

function pwdMatch($password, $confirm_password){
	$result;
	if ($password !== $confirm_password ) {
		# code...
		$result = true;
}else {
	# code...
	$result = false;
}
return $result;
}

function uidExists($con, $email){
	$sql = "SELECT * FROM users WHERE email = ?;";
	$stmt = mysqli_stmt_init($con);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../register.php?error=stmt-failed");
        exit();	
	}
	mysqli_stmt_bind_param($stmt, "s", $email);

	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		# code...
		return $row;
	}
	else {
	$result = false;
	return $result;
	}

	mysqli_stmt_close($stmt);
}

function   createUser($con, $firstname, $lastname, $email, $role, $password
){
	$sql = "INSERT INTO users (firstname, lastname, email, role, password) VALUES (?,?,?,?,?);";
	$stmt = mysqli_stmt_init($con);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../register.php?error=stmt-failed");
        exit();	
	
	}
$hashedPwd = password_hash($password, PASSWORD_DEFAULT);


	mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $role, $hashedPwd);

	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../orders.php?error=none");	
}

function emptyInputLogin( $email, $password){
	$result;
	if (empty($email) || empty($password) ) {
		# code...
		$result = true;
	}else {
		# code...
		$result = false;
	}
	return $result;
}
function loginUser($con, $email, $password){
	$uidExists = uidExists($con, $email);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");

		exit();
	}

	$pwdHashed = $uidExists["password"];
	$checkPassword = password_verify($password,$pwdHashed);

	if ($checkPassword === false) {
		# code...
		header("location: ../login.php?error=wronglogin");

		exit();
	}elseif ($checkPassword === true) {
		# code...

	

		$_SESSION["id"] = $uidExists["id"];
		$_SESSION["firstname"] = $uidExists["firstname"];
		$_SESSION["lastname"] = $uidExists["lastname"];
		$_SESSION["email"] = $uidExists["email"];
		$_SESSION["role"] = $uidExists["role"];

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    # code...
  
  if ($_SESSION['role']=='Admin') {
      # code...
      header("location: ../user.php");
  }elseif ($_SESSION['role']=='Pharmacist') {
    header("location: ../orders.php");
  }
 else {
  header("location: ../home.php");
  }
		

		//  header("location: ../home.php");
		exit();

	}else {
		# code...
		// header("location: ../home.php?error=Incorrect User name or password");
	}
}
 }





