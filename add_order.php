<?php 
include('connection.php');
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$supplier = $_POST['supplier'];
$type = $_POST['type'];
$date = $_POST['date'];
$createdby = $_POST['createdby'];

$sql = "INSERT INTO `orders` (`name`,`quantity`,`type`,`supplier`,`date`,`createdby`) values ('$name', '$quantity', '$type', '$supplier', '$date',  '$createdby' )";
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