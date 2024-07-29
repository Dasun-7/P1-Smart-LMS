<?php
include('../connection.php');
include('../function.php');
$msg = "";

if(isset($_POST['teacher_id'])){
    $system_id = create_id('t' , 5);
    while(check_extintion($user_conn , 'teacher' , 'system_tid' , $system_id)){
        $system_id = create_id('t' , 5);
    }
    $id = mysqli_real_escape_string($user_conn , $_POST['teacher_id']);
    $password = mysqli_real_escape_string($user_conn , $_POST['password']);
    $name = mysqli_real_escape_string($user_conn , $_POST['name']);
    $email  = mysqli_real_escape_string($user_conn , $_POST['email']);
    $classes = $_POST['class'];
    $classes = explode(',' , $classes);

    $subjects = $_POST['subject'];
    $subjects = explode(',' ,$subjects);

    $query1 = "INSERT INTO teacher(system_tid, teacher_id , password , name , email) VALUES('$system_id','$id','$password' , '$name' ,'$email')";
    $result1 = mysqli_query($user_conn, $query1);

    if($result1){
        $query2 = "SELECT system_tid FROM teacher WHERE teacher_id='$id'";
        $result2 = mysqli_query($user_conn , $query2);
        if($result2){
            $data = mysqli_fetch_assoc($result2);
            $s_id =  $data['system_tid'] ;
           
            if($subjects[0] != ""){
                for($i = 0 ; sizeof($subjects) > $i ; $i++){
                    $sub_query = "INSERT INTO teacher_subject(teacher_sid , sub_id) VALUES('$s_id','$subjects[$i]' )";
                    $sub_result = mysqli_query($user_conn , $sub_query);
                }
            }
            if($classes[0] != ""){
                for($i = 0 ; sizeof($classes) > $i ; $i++){
                    $class_query = "INSERT INTO teacher_class(teacher_sid , class_no) VALUES('$s_id','$classes[$i]' )";
                    $class_result = mysqli_query($user_conn , $class_query);
                }
            }

            if(!empty($_FILES['profile-pic']['name'])){
                $pic_id = create_id('th-pro', 5);
                $fileName = $_FILES['profile-pic']['name'];
                $filetmpName = $_FILES['profile-pic']['tmp_name'];
                $folder = $propic_folder;
                $type = get_file_extension($fileName);
                $url = $folder.$pic_id.'.'.$type ;
                $fileNM = $pic_id.'.'.$type ;

                if(move_uploaded_file($filetmpName , $url)){
                    $query = "INSERT INTO user_propics(user_id, url) VALUES('$system_id' , '$fileNM')";
                    if(mysqli_query($user_conn , $query)){
                
                    }
                }else{
               
                }
            }
        }
        $msg = array('success' => $name.' added');
}
}

if(isset($_POST["indexno"])){
    $system_id = create_id('st' , 5);
    while(check_extintion($user_conn , 'student' , 'system_sid' , $system_id)){
        $system_id = create_id('st' , 5);
    }
    $id = mysqli_real_escape_string($user_conn , $_POST['indexno']);
    $password = mysqli_real_escape_string($user_conn , $_POST['password']);
    $name = mysqli_real_escape_string($user_conn , $_POST['name']);
    $email  = mysqli_real_escape_string($user_conn , $_POST['email']);
    $class = mysqli_real_escape_string($user_conn ,$_POST['class']);
   
    $subjects = $_POST['subject'];
    $subjects = explode(',' ,$subjects);

    $query1 = "INSERT INTO student(system_sid,indexno , password , name , email) VALUES('$system_id','$id','$password' , '$name' ,'$email')";
    $result1 = mysqli_query($user_conn, $query1);

    if($result1){
        $query2 = "SELECT system_sid FROM student WHERE indexno='$id'";
        $result2 = mysqli_query($user_conn , $query2);
        if($result2){
            $data = mysqli_fetch_assoc($result2);
            $s_id =  $data['system_sid'] ;
           
            if($subjects[0] != ""){
                for($i = 0 ; sizeof($subjects) > $i ; $i++){
                    $sub_query = "INSERT INTO student_subject(student_sid , sub_id) VALUES('$s_id','$subjects[$i]' )";
                    $sub_result = mysqli_query($user_conn , $sub_query);
                }
            }
            $class_query = "INSERT INTO student_class(student_sid , class_no) VALUES('$s_id','$class')";
            $class_result = mysqli_query($user_conn , $class_query);         
        }
        $msg = array('success' => $name.' added');

        if(!empty($_FILES['profile-pic']['name'])){
            $pic_id = create_id('st-pro', 5);
            $fileName = $_FILES['profile-pic']['name'];
            $filetmpName = $_FILES['profile-pic']['tmp_name'];
            $folder = $propic_folder;
            $type = get_file_extension($fileName);
            $url = $folder.$pic_id.'.'.$type ;
            $fileNM = $pic_id.'.'.$type ;

            if(move_uploaded_file($filetmpName , $url)){
                $query = "INSERT INTO user_propics(user_id, url) VALUES('$system_id' , '$fileNM')";
                if(mysqli_query($user_conn , $query)){
                
                }
            }else{
               
            }
        }
}
}

echo json_encode($msg);
?>