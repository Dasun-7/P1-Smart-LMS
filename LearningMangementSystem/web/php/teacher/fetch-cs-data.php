<?php
session_start();
include("../connection.php");
include("../function.php");

$user = get_user_data($user_conn);
$output = "";

$id = $user['system_tid'];

$querySb = "SELECT * FROM subject INNER JOIN teacher_subject ON subject.sub_id = teacher_subject.sub_id WHERE teacher_subject.teacher_sid='$id'";
$resultSb = $user_conn -> query($querySb);
if($resultSb){
    $output = array(
        "subject" => array(),
        "class" => array()
    );
    while($dataSb = mysqli_fetch_assoc($resultSb)){
        $sub_id = $dataSb["sub_id"];
        $output["subject"][$sub_id] = $dataSb["sub_name"];
    }

    
$queryCl = "SELECT * FROM class INNER JOIN teacher_class ON class.class_no = teacher_class.class_no WHERE teacher_class.teacher_sid='$id'";
$resultCl = $user_conn -> query($queryCl);
if($resultCl){
    while($dataCl = mysqli_fetch_assoc($resultCl)){
        $class_no = $dataCl["class_no"];
        $output["class"][$class_no] = $dataCl["class_name"];
    }
}

    echo json_encode($output);
}
?>
