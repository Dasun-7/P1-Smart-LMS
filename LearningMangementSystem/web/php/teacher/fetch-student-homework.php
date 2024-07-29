<?php
session_start();
include("../connection.php");
include("../function.php");

$user = get_user_data($user_conn);
$output = "";

$user_id = $user['system_tid'];

$class = $_GET["class"];
$subject = $_GET["subject"];

if($subject != 'all'){
    if($class != 'all'){
        $query1 = "SELECT * FROM homework INNER JOIN homework_class ON homework.homework_id = homework_class.homework_id 
        WHERE homework.sub_id = '$subject' AND homework.teacher_sid ='$user_id' AND homework_class.class_no = '$class'"; 
    }else{
        $query1 = "SELECT * FROM homework WHERE sub_id = '$subject' AND teacher_sid ='$user_id'"; 
    }   
}else{
    if($class != 'all'){
        $query1 = "SELECT * FROM homework INNER JOIN homework_class ON homework.homework_id = homework_class.homework_id 
        WHERE homework.teacher_sid ='$user_id' AND homework_class.class_no = '$class'"; 
    }else{
    $query1 = "SELECT * FROM homework WHERE teacher_sid ='$user_id'";
    } 
}

$result = mysqli_query($system_conn , $query1);
while($data1 = mysqli_fetch_assoc($result)){
    $homework_id = $data1['homework_id'];
    $query2 = "SELECT * FROM student_homework WHERE homework_id = '$homework_id'";

    $result2 = mysqli_query($system_conn , $query2);
    while($data2 = mysqli_fetch_assoc($result2)){
        $st_id = $data2['student_sid'];

        $query3 = "SELECT * FROM student INNER JOIN student_class ON student.system_sid = student_class.student_sid WHERE student.system_sid = '$st_id'";
        $result3 = mysqli_query($user_conn , $query3);
        if($data3 = mysqli_fetch_assoc($result3)){
            $class_name = getClassName($user_conn , $data3["class_no"]);
            $output .= "<li>
            <div class='homework-no'>$homework_id</div>
            <div class='st-name'>$data3[name]</div>
            <div class='st-class'>$class_name</div>
            <div class='see-btn'>see</div>
        </li>"; 

        }
    }
}
echo $output;

?>

