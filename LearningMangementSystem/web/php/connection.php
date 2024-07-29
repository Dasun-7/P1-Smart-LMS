<?php
$user_server = 'localhost';
$user_user = 'root';
$user_password ='';
$user_database = 'lms_user';

$user_conn = mysqli_connect($user_server , $user_user , $user_password , $user_database);

if($user_conn -> connect_error){
    die('Failde to connect lms user database'.$user_conn -> connect_error);
}

$system_server = 'localhost';
$system_user = 'root';
$system_password ='';
$system_database = 'lms_system';

$system_conn = mysqli_connect($system_server , $system_user , $system_password , $system_database);

if($system_conn -> connect_error){
    die('Failde to connect lms user database'.$system_conn -> connect_error);
}

$resurce_folder = $_SERVER['DOCUMENT_ROOT']."/LearningMangementSystem/media/resources/" ;
$propic_folder = $_SERVER['DOCUMENT_ROOT']."/LearningMangementSystem/media/propics/" ;
$teacher_hw_folder = $_SERVER['DOCUMENT_ROOT']."/LearningMangementSystem/media/homework/teacher_hw/";
$student_hw_folder = $_SERVER['DOCUMENT_ROOT']."/LearningMangementSystem/media/homework/student_hw/";
?>