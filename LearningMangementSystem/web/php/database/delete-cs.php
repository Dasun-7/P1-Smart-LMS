<?php
include('../connection.php');

if(isset($_POST['cs'])){
    $id=mysqli_real_escape_string($user_conn , $_POST['id']);
    if($_POST['cs'] == 'class'){
        $query = "DELETE FROM class WHERE class_no = '$id'";
    }
    if($_POST['cs'] == 'subject'){
        $query = "DELETE FROM subject WHERE sub_id = '$id'";
    }
    $result = mysqli_query($user_conn , $query);
    if($result){
        echo $_POST['cs'].' deleted from database';
    }
}
?>