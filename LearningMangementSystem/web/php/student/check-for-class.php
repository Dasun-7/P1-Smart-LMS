<?php
session_start();
include("../connection.php");
include("../function.php");

$outPut = "";
$user = get_user_data($user_conn);
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $class = getStudentClass($user_conn ,$id);

    $query = "SELECT * FROM room_class WHERE class_no = '$class'";
    $result = mysqli_query($system_conn , $query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            $room_id = $data['room_id'];

            $queryRoom = "SELECT * FROM room WHERE room_id = '$room_id' LIMIT 1";
            $resultRoom = $system_conn -> query($queryRoom);

            if($resultRoom){
            $room_data = mysqli_fetch_assoc($resultRoom);
            $start_time = $room_data['start_time'];
            $end_time = $room_data['end_time'];
            $sub_name = getSubName($user_conn , $room_data["sub_id"]);
            $teacher_name = getTeacherName($user_conn , $room_data["teacher_id"]);
            $teacher_pic = get_profile_pic($user_conn , $room_data["teacher_id"]);

            $outPut = array(
                "status"=> "has_class",
                "teacher" => $teacher_name ,
                "subject" => $sub_name,
                "class" => [],
                "time" => $start_time." To ".$end_time,
                "link" => $room_data["link"],
                "pic_url" => $teacher_pic
            );

            $queryClass = "SELECT * FROM room_class WHERE room_id = '$room_id'";
            $resultClass = mysqli_query($system_conn , $queryClass);
            if($resultClass){
                while($dataClass= mysqli_fetch_assoc($resultClass)){
                    $class_id = $dataClass["class_no"];
                    $class_name = getClassName($user_conn, $class_id);
                    array_push($outPut["class"] , $class_name);
                }
            }
        }
        }else{
            $outPut = array(
                "status"=> "no_class"
            );
        }
        echo json_encode($outPut);

    }
}

?>