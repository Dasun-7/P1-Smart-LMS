<?php


function get_user_data($con){
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $querySt = "SELECT * FROM student WHERE system_sid = '$id' LIMIT 1";
        $resultSt = mysqli_query($con , $querySt);
        if($resultSt){
            if(mysqli_num_rows($resultSt) > 0){
                $user_data = mysqli_fetch_assoc($resultSt);
                return $user_data;
            }
        }

        $queryth = "SELECT * FROM teacher WHERE system_tid = '$id' LIMIT 1";
        $resultth = mysqli_query($con , $queryth);
        if($resultth){
            if(mysqli_num_rows($resultth) > 0){
                $user_data = mysqli_fetch_assoc($resultth);
                return $user_data;
            }
        }
        
    }

    header("location: ../html/login.html");
    die;
}


function create_id($start ,$len ){
    $text = $start;
    for($i = 0 ; $len > $i ; $i++ ){
        $text .= rand(0,9);
    }

    return $text;
}

function check_extintion($con , $table , $col , $data){
    $query = "SELECT * FROM $table WHERE $col= '$data'";
    $result = mysqli_query($con , $query);
    if($result && mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

function get_file_extension($file_name) {
    return substr(strrchr($file_name,'.'),1);
}

function getSubName($con, $id) {
    $query = "SELECT * FROM subject WHERE sub_id = '{$id}'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['sub_name'];
    }
}

function getClassName($con, $id) {
    $query = "SELECT * FROM class WHERE class_no = '$id'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['class_name'];
    }
}

function getStudentClass($con , $id){
    $query = "SELECT * FROM student_class WHERE student_sid = '$id'";
    $result = mysqli_query($con , $query);

    if($result){
        $data = mysqli_fetch_assoc($result);
        return $data["class_no"];
    }
}

function getTeacherName($con , $id){
    $query = "SELECT * FROM teacher WHERE system_tid = '$id'  LIMIT 1";
    $result = mysqli_query($con , $query);

    if($result){
        $data = mysqli_fetch_assoc($result);
        return $data["name"];
    }
}

function get_profile_pic($con , $user_id){
    $propic_folder = "/LearningMangementSystem/media/propics/" ;

    $query = "SELECT * FROM user_propics WHERE user_id = '$user_id'";
    $result = mysqli_query($con , $query);

    if($result && mysqli_num_rows($result) > 0 ){
        $data = mysqli_fetch_assoc($result);
        return $propic_folder.$data["url"];
    }else{
        return $propic_folder."no_pro_pic.jpg";
    }

}
?>