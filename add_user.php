<?php 
include('connection.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];
$role = $_POST['role'];
$password = $_POST['password'];
$hashedPwd = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO `users` (`firstname`, `lastname`, `email`,`mobile`,`city`, `firstname`,`role`,`password`) values ('$firstname', '$lastname', '$email', '$mobile', '$city','$role' '$hashedPwd')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>