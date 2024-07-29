<?php
session_start();
include('../connection.php');
include('../function.php');
$user = get_user_data($user_conn);

$outPut = "";

if(isset($user['system_tid'])){
    $teacher_id = $user['system_tid'] ;
    $hw_id = create_id("HW-", 7);
    $title = mysqli_real_escape_string($system_conn , $_POST["title"]);
    $sub_id = mysqli_real_escape_string($system_conn , $_POST["subject"]);
    $question = mysqli_real_escape_string($system_conn , $_POST["question"]);
    $class = mysqli_real_escape_string($system_conn , $_POST["class"]);
    $class = explode(',' , $class);
    $time_limit = mysqli_real_escape_string($system_conn , $_POST["time-limit"]);
    $day = date('m');
    $month = date('M');
    $date = $day.'/'.$month;

    $query = "INSERT INTO homework(homework_id , teacher_sid , sub_id , title , question , time_limit , date) 
    VALUES('$hw_id' , '$teacher_id' , '$sub_id' , '$title' , '$question' , '$time_limit' , '$date' )";
    $result = $system_conn -> query($query);
    if($result){
        $outPut = array( 'success' => "homework Successfully Added.");
        for($i = 0 ; sizeof($class) > $i ; $i++){
            $queryCl = "INSERT INTO homework_class(homework_id , class_no) VALUES('$hw_id' , '$class[$i]')";
            $system_conn -> query($queryCl);
        }

        if(!empty($_FILES['hw-file']['name'])){
            $id = create_id('HW-File', 7);
            $fileName = $_FILES['hw-file']['name'];
            $filetmpName = $_FILES['hw-file']['tmp_name'];
            $folder = $teacher_hw_folder;
            $type = get_file_extension($fileName);
            $url = $folder.$id.'.'.$type ;
            $flNM = $id.$type;

            if(move_uploaded_file($filetmpName , $url)){
                $query = "INSERT INTO homework_file(homework_id, file_name) VALUES('$hw_id' , '$flNM')";
                if(mysqli_query($system_conn , $query)){
                    $outPut = array( 'success' => "homework Successfully Added.");
                }else{
                    $outPut = array( 'success' => "homework Successfully Added But file uploading failed.");
                }
            }         
        } 
    echo json_encode($outPut);
}
}

?>