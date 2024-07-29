<?php
session_start();
include('connection.php');
$msg = '';

if(isset($_POST['user_name'])){
    $userName = mysqli_real_escape_string($user_conn, $_POST['user_name']) ;
    $password = mysqli_real_escape_string($user_conn, $_POST['password']) ;

    if(!empty($userName) && !empty($password)){
        $query = "SELECT * FROM student WHERE indexno='$userName' LIMIT 1";
        $result = mysqli_query($user_conn , $query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['password'] == $password){      
                $_SESSION['user_id'] = $user_data['system_sid'];
                $msg = array('success' => 'student');
            }else{
                $msg = array('error' => 'password');
            }
        }else{
        $query2 = "SELECT * FROM teacher WHERE teacher_id='$userName' LIMIT 1";
        $result2 = mysqli_query($user_conn , $query2);
        if($result2 && mysqli_num_rows($result2) > 0){
                $user_data = mysqli_fetch_assoc($result2);
                if($user_data['password'] == $password){
                    $_SESSION['user_id'] = $user_data['system_tid']; 
                    $msg = array('success' => 'teacher');
                }else{
                    $msg = array('error' => 'password');
                }
            }else{
                $msg = array('error' => 'username');
            }
        }
}else{
    $msg = array('error' => 'please enter valied Data.');
}

echo json_encode($msg);
}

?>