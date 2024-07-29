<?php
session_start();
include('../connection.php');
include("../function.php");
$user = get_user_data($user_conn);

if(isset($_POST['res-title'])){
    $user_id = $user['system_tid'];
    $id = create_id('res' , 5);
    $title = $_POST["res-title"];
    $info = $_POST["res-info"];
    $subject = $_POST["res-subject"];
    $class = $_POST["res-class"];
    $class = explode(',' , $class);
    $day = date('m');
    $month = date('M');
    $date = $day.'/'.$month;


    $query = "INSERT INTO resource(res_id, title ,info, sub_id ,teacher_sid ,date) VALUES('$id' , '$title' , '$info', '$subject' , '$user_id', '$date')";
    $result = mysqli_query($system_conn , $query);

    if($result){
        $outPut = array("success" => "successfully added");
        for($i = 0 ; sizeof($class) > $i ; $i++){
        $query = "INSERT INTO resource_class(res_id , class_no) VALUES('$id','$class[$i]')";
        mysqli_query($system_conn , $query);
        }

        if(!empty($_FILES['resfile']['name'])){
            $id = create_id('res', 5);
            $fileName = $_FILES['resfile']['name'];
            $filetmpName = $_FILES['resfile']['tmp_name'];
            $folder = $resurce_folder;
            $type = get_file_extension($fileName);
            $url = $folder.$id.'.'.$type ;

            if(move_uploaded_file($filetmpName , $url)){
                $query = "INSERT INTO resource_file(res_id, res_url) VALUES('$id' , '$url')";
                if(mysqli_query($system_conn , $query)){
                    echo "resource Uploaded Successfully";
                }
            }else{
                echo "failed to upload the file";
            }
        }
        echo json_encode($outPut);
        
    }
}


?>