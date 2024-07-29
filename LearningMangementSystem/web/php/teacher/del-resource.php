<?php
include("../connection.php");
include("../function.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM resource WHERE res_id = '$id'";
    if(mysqli_query($system_conn , $query)){
        echo "resourse Deleted !";
    }else{
        echo "Failed to delete result!";
    }
}
?>