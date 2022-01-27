<?php 
include('connection.php');
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$supplier = $_POST['supplier'];
$type = $_POST['type'];
$date = $_POST['date'];
$createdby = $_POST['createdby'];
$id = $_POST['id'];

$sql = "UPDATE `orders` SET  `name`='$name' , `quantity`= '$quantity', `type`='$type',`supplier`='$supplier',`date`='$date',  `createdby`='$createdby' WHERE id='$id' ";
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