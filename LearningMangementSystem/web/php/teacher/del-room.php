<?php
session_start();
include("../connection.php");
include("../function.php");

$user= get_user_data($user_conn);
$id = $user["system_tid"];

$query = "SELECT * FROM room WHERE teacher_id = '$id'";
$result =  mysqli_query($system_conn , $query);

if($result && mysqli_num_rows($result) > 0){
    while($data = mysqli_fetch_assoc($result)){
        $room_id = $data['room_id'];
        $query2 = "DELETE FROM room_class WHERE room_id = '$room_id'";
        mysqli_query($system_conn , $query2);
    }

    $query3 = "DELETE FROM room WHERE teacher_id = '$id'";
    if(mysqli_query($system_conn ,$query3)){
        echo "class ended.";
    }
}
?>