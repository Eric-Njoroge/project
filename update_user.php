<?php 
include('connection.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];
$role= $_POST['role'];
// $password= $_POST['password'];
$id = $_POST['id'];

$sql = "UPDATE `users` SET  `firstname`='$firstname' ,`firstname`='$lastname', `email`= '$email', `mobile`='$mobile',  `city`='$city' ,`role`='$role' WHERE id='$id' ";
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