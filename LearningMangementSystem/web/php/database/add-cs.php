<?php
include('../connection.php');

$msg =array('falid' => 'couldnot enter record');

if(isset($_POST['class_no'])){
    $class_no = mysqli_real_escape_string($user_conn , $_POST['class_no']);
    $class_name = mysqli_real_escape_string($user_conn , $_POST['class_name']);
 

    $query = "INSERT INTO class (class_no , class_name) VALUES('$class_no' , '$class_name')";
    $result = mysqli_query($user_conn , $query);
    if($result){
        $msg = array('success' => 'class Added');
    }else{
        $ms =array( 'failed' => 'Faild to add class');
    }
}


if(isset($_POST['sub_id'])){
    $sub_id = mysqli_real_escape_string($user_conn , $_POST['sub_id']);
    $sub_name = mysqli_real_escape_string($user_conn , $_POST['sub_name']);

    $query = "INSERT INTO subject (sub_id, sub_name) VALUES('$sub_id' , '$sub_name')";
    $result = mysqli_query($user_conn , $query);
    if($result){
        $msg = array('success' => 'subject Added');
    }else{
        $msg = array('failed' => 'faild to Add subject');
    }
}

echo json_encode($msg);
?>