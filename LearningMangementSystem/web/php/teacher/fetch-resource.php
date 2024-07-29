<?php
session_start();
include('../connection.php');
include("../function.php");
$user = get_user_data($user_conn);

if(isset($_GET['class']) && isset($_GET['subject'])){
    $text = "";
    $id = $user['system_tid'];
    $class = $_GET['class'];
    $subject = $_GET['subject'];

    if($class == 'all'){
        if($subject == 'all'){
            $query = "SELECT * FROM resource WHERE teacher_sid = '$id'";
        }else{
            $query = "SELECT * FROM resource WHERE teacher_sid = '$id' AND sub_id = '$subject'";
        }
    }else{
        if($subject == 'all'){
            $query = "SELECT * FROM resource INNER JOIN resource_class ON resource.res_id = resource_class.res_id 
            WHERE resource.teacher_sid = '$id' AND resource_class.class_no='$class'";
        }else{
            $query = "SELECT * FROM resource INNER JOIN resource_class ON resource.res_id = resource_class.res_id 
            WHERE resource.teacher_sid = '$id' AND resource.sub_id = '$subject' AND resource_class.class_no='$class' ";
        }
    }

    $result = mysqli_query($system_conn , $query);
    if($result){
        while($data = mysqli_fetch_assoc($result)){
            $sub = getSubName($user_conn, $data['sub_id']) ;
            $text .=  "<li id='$data[res_id]'>
            <div class='title lbl'>
                <h5>Title</h5>$data[title]
            </div>
            <div class='subject lbl'>
                <h5>subject</h5>$sub
            </div>
            <div class='date lbl'>
                <h5>date</h5>$data[date]
            </div>
            <div class='delete-btn'>
                <img src='../svg/delete-2-svgrepo-com.svg'>
            </div>
        </li>";
        }
        echo $text;
    }
}


?>