<?php
include('../connection.php');
if(isset($_GET['cs'])){
    $text = "";
    if($_GET['cs'] == 'class'){
        $query = "SELECT * FROM class";
        $result = mysqli_query($user_conn , $query);
        while($data = mysqli_fetch_assoc($result)){
          
            $text .= "<li id='$data[class_no]'>
            <div class='cs-id'>$data[class_no]</div>
            <div class='cs-name'>$data[class_name]</div>
            <div class='delete-btn'>
                <img src='../svg/delete-2-svgrepo-com.svg'>
            </div>
        </li>";           
        }
        echo $text ;
    }

    if($_GET['cs'] == 'subject'){
        $query = "SELECT * FROM subject";
        $result = mysqli_query($user_conn , $query);
        while($data = mysqli_fetch_assoc($result)){         
            $text .= "<li id='$data[sub_id]'>
            <div class='cs-id'>$data[sub_id]</div>
            <div class='cs-name'>$data[sub_name]</div>
            <div class='delete-btn'>
                <img src='../svg/delete-2-svgrepo-com.svg'>
            </div>
        </li>";           
        }
        echo $text ;
    }
}
?>