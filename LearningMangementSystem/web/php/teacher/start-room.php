<?php
session_start();
include("../connection.php");
include("../function.php");

$user= get_user_data($user_conn);
$output = "";


    $id = $user["system_tid"];
    $subject = $_POST["room-subject"];
    $room_id = create_id('r', 5);
    $link = $_POST['room-link'];
    $s_time = $_POST["start-time"];
    $e_time = $_POST["end-time"];
    $class = $_POST["class"];
    $class= explode("," ,$class);

    $query = "INSERT INTO room(room_id , sub_id , link , start_time , end_time , teacher_id) VALUES('$room_id' , '$subject' , '$link' , '$s_time' , '$e_time' ,'$id')";
    $result = mysqli_query($system_conn,$query);

    if($result){
        for($i = 0 ; sizeof($class) > $i ; $i++){
            $query2 = "INSERT INTO room_class(room_id , class_no) VALUES('$room_id' ,'$class[$i]')";
            $result2 = mysqli_query($system_conn , $query2);
        }

        $output = array('success' => "class_started");
    }else{
        $output = array('error' => "room creating failed");
    }

    echo json_encode($output);
    


?>