<?php
session_start();
include('./connection.php');
include('./function.php');
$user = get_user_data($user_conn);

if(isset($user['system_sid'])){
    $id = $user['system_sid'] ;
    $pic_url = get_profile_pic($user_conn , $id);
    $query = "SELECT * FROM student INNER JOIN student_class ON student.system_sid = student_class.student_sid WHERE student.system_sid = '$id' LIMIT 1";
    $result = mysqli_query($user_conn , $query);

    if($result){
        $user_data = mysqli_fetch_assoc($result);
        $queryCl = "SELECT * FROM class WHERE class_no='$user_data[class_no]'";
        $resultCl = mysqli_query($user_conn , $queryCl);
        if($resultCl){
            $class_data = mysqli_fetch_assoc($resultCl);
            $class_name = $class_data['class_name'];
        }

        $user_obj = array(
            'system_id' => $id ,
            'indexno' => $user_data['indexno'],
            'name' => $user_data['name'],
            'class_no' => $user_data['class_no'],
            'class_name' => $class_name,
            'pic_url' => $pic_url
        );
        echo json_encode($user_obj);
    }
}

if(isset($user['system_tid'])){
    $id = $user['system_tid'] ;
    $query = "SELECT * FROM teacher WHERE system_tid ='$id'";
    $result = mysqli_query($user_conn , $query);
    $subject = array();
    $class = array();
    $pic_url = get_profile_pic($user_conn , $id);

    if($result){
        $user_data = mysqli_fetch_assoc($result);
        $queryCl = "SELECT * FROM class INNER JOIN teacher_class ON class.class_no = teacher_class.class_no WHERE teacher_class.teacher_sid='$id'";
        $resultCl = mysqli_query($user_conn , $queryCl);
        if($resultCl){
            while($class_data = mysqli_fetch_assoc($resultCl)){
                $class[$class_data['class_no']] = $class_data['class_name'];
            }
        }

        $querySb = "SELECT * FROM subject INNER JOIN teacher_subject ON subject.sub_id = teacher_subject.sub_id  WHERE teacher_subject.teacher_sid = '$id' ";
        $resultSb = mysqli_query($user_conn , $querySb);
        if($resultSb){
            while($sub_data = mysqli_fetch_assoc($resultSb)){
                $subject[$sub_data['sub_id']] = $sub_data['sub_name'];
            }
        }

        $user_obj = array(
            'system_id' => $id ,
            'teacher_id' => $user_data['teacher_id'],
            'name' => $user_data['name'],
            'class' => $class,
            'subject' => $subject ,
            'pic_url' => $pic_url
        );
        echo json_encode($user_obj);
    }
}

?>