<?php

session_start();
include("../connection.php");
include("../function.php");

$outPut = "";
$user = get_user_data($user_conn);
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $class = getStudentClass($user_conn ,$id);

    $query = "SELECT * FROM homework INNER JOIN homework_class ON homework.homework_id = homework_class.homework_id WHERE homework_class.class_no = '$class' ";
    $result = $system_conn -> query($query);
    if($result){
        while($data = mysqli_fetch_assoc($result)){
            $sub_name = getSubName($user_conn , $data["sub_id"]);
            $outPut .= " <li id = '$data[homework_id]'>
            <div class='homework-subject'>$sub_name</div>
            <div class='homework-title'>$data[title]</div>
            <div class='homework-date'>$data[date]</div>
            <div class='Do-btn'>Do</div>
        </li>";
        }
    }
    echo $outPut;
}

   

?>