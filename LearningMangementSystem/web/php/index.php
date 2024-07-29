<?php
session_start();
include('./connection.php');
include('./function.php');
$user = get_user_data($user_conn);

if(isset($user['system_sid'])){
    header('location: ../html/student-interface.html');
}

if(isset($user['system_tid'])){
    header('location: ../html/teacher-interface.html');
}

?>