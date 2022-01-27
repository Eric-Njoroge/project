<?php
$con  = mysqli_connect('127.0.0.1','root','','datatable_example');
if(!$con)
{
    die ('Database Connection Error' . mysqli_connect_error());
}
