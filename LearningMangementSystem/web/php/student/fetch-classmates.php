<?php
session_start();
include("../connection.php");
include("../function.php");

$outPut = "";
$user = get_user_data($user_conn);
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $class = getStudentClass($user_conn ,$id);
    $class_name = getClassName($user_conn , $class);

    $query = "SELECT * FROM student INNER JOIN student_class ON student.system_sid = student_class.student_sid WHERE student_class.class_no = '$class'";
    $result = mysqli_query($user_conn , $query);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($data = mysqli_fetch_assoc($result)){
                $pic_url = get_profile_pic($user_conn , $data["system_sid"]);
                $outPut .= " <li>
                <div class='profile-pic'>
                    <img src='$pic_url'>
                </div>
                <div class='user-name'>$data[name]</div>
                <div class='user-class'>$class_name</div>
            </li>";
            }
        }else{
            $outPut .= "<label class='active'>You Have no classmates</label>";
        }
    }

    echo $outPut;
}

?>