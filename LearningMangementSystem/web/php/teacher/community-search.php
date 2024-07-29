<?php
include('../connection.php');
include('../function.php');

if(isset($_GET['user_type'])){
    $text = '';
    $input = $_GET['name'];

    if($_GET['user_type'] == 'teacher'){
        $query = "SELECT * FROM teacher WHERE name LIKE '$input%'";
    }else{
        $query = "SELECT * FROM student WHERE name LIKE '$input%'";
    }

    $result = $user_conn -> query($query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($data = mysqli_fetch_assoc($result)){
                if(isset($data["system_tid"])){
                    $id = $data["system_tid"];
                }else{
                    $id = $data["system_sid"];
                }
                $pic_url = get_profile_pic($user_conn , $id);
                $text .= "<li id = '$id'>
                <div class='profile-pic'>
                    <img src='$pic_url'>
                </div>
                <div class='user-name'>$data[name]</div>
                <div class='user-class'>10-c</div>
            </li>";
            }
        }else{
            $text .="<label class='active'>No result..</label>";
        }

        $text .= "<div class='more-btn'>see more</div>";
        echo $text ;
    }
}
?>