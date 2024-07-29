<?php
include('../connection.php');

if($_GET['cs']){
    $arr = array();
    if($_GET['cs'] == 'class'){
        $query = "SELECT * FROM class";
        $result = mysqli_query($user_conn , $query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $id = $data['class_no'];
                $name = $data['class_name'];
                $arr[$id] = $name;
            }
        }
    }

    if($_GET['cs'] == 'subject'){
        $query = "SELECT * FROM subject";
        $result = mysqli_query($user_conn , $query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $id = $data['sub_id'];
                $name = $data['sub_name'];
                $arr[$id] = $name;
            }
        }
    }

    echo json_encode($arr);
}
?>