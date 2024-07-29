<?php
session_start();
include("../connection.php");
include("../function.php");

$user = get_user_data($user_conn);
$output = "";

$id = $user['system_tid'];
$query = "SELECT * FROM room WHERE teacher_id='$id'";
$result = mysqli_query($system_conn , $query);
if($result){
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $room_id = $data["room_id"];
        $sub_id = $data["sub_id"];
        $link = $data["link"];
        $s_time = $data["start_time"];
        $_time = $data["end_time"];
        $sub_name = getSubName($user_conn , $sub_id);

        $output = array("status" => "in_room",
                        "subject" => $sub_name,
                        "class" => []            
    );

    $querycl = "SELECT * FROM room_class WHERE room_id='$room_id'";
    if($resultCl = mysqli_query($system_conn , $querycl)){
        while($dataCl = mysqli_fetch_assoc($resultCl)){
            $class_name =getClassName($user_conn, $dataCl["class_no"]);
           array_push($output["class"], $class_name);
        }
    }

    
    }else{
        $output = array("status" => "no_room");
    }

    echo json_encode($output);
}

?>