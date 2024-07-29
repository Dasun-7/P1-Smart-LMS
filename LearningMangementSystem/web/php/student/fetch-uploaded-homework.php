<?php
session_start();
include("../connection.php");
include("../function.php");

$outPut = "";
$user = get_user_data($user_conn);
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $query = "SELECT * FROM homework INNER JOIN student_homework ON homework.homework_id = student_homework.homework_id WHERE student_homework.student_sid = '$id'";
    $result = $system_conn -> query($query);
    while($data = mysqli_fetch_assoc($result)){
        $sub_name =  getSubName($user_conn , $data["sub_id"]);

        $outPut .= "
        <li>
        <div class='homework-subject'>$sub_name</div>
        <div class='homework-title'>$data[title]</div>
        <div class='status'>$data[status]</div>
    </li>
        ";
    }
    echo $outPut;

}
?>