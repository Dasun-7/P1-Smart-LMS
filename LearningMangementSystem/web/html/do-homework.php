<?php

session_start();
include("../php/connection.php");
include("../php/function.php");

$outPut = "";
$user = get_user_data($user_conn);
$homework_id = $_GET["homework_id"];
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $query = "SELECT * FROM homework WHERE homework_id = '$homework_id' LIMIT 1";
    $result = $system_conn -> query($query);
    if($result){
        $data = mysqli_fetch_assoc($result);
        $title = $data["title"];
        $sub_name = getSubName($user_conn , $data["sub_id"]);
        $teacher_name = getTeacherName($user_conn , $data["teacher_sid"]);
        $date = $data["date"];
        $time_limit = $data["time_limit"];
        $question = $data["question"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Homework</title>
    <link rel="stylesheet" href="../css/main-styles.css">
    <link rel="stylesheet" href="../css/student/student-homework.css">
</head>

<body>
    <div class="container">
        <div class="col title-col">
            <H1><?php echo $title?></H1>
            <h2><?php echo $sub_name?></h2>
            <h5 class="teacher-name"><?php echo $teacher_name?></h5>
        </div>
        <div class="col homework-info">
            <div>
                <label>Homework id : </label> <label for=""><?php echo $homework_id?></label>
            </div>
            <div>
                <label>uploaded date : </label> <label for=""><?php echo $date?></label>
            </div>
            <div>
                <label>time limite : </label> <label for=""><?php echo $time_limit?></label>
            </div>
        </div>
        <div class="col question-col">
            <h5>question</h5>
            <p>
            <?php echo $question?>
            </p>
        </div>
        <form action="" method="POST">
            <div class="col answer-col">
                <h5>Your Answer</h5>
                <textarea name="answer"></textarea>
            </div>
            <div class="col attachment-col">
                <?php
                    $query = "SELECT * FROM homework_file WHERE homework_id = '$homework_id'";
                    $result = $system_conn -> query($query);
                    if($result){
                        if(mysqli_num_rows($result) > 0 ){
                            echo "
                            <div class='left'>
                            <h5>download homework attachment</h5>
                            <div class='attachment-icon'>
                                <img src='../svg/upload-svgrepo-com (1).svg'>
                            </div>
                        </div>
                            ";
                        }
                    }
                ?>
    
                <div class="right">
                    <h5>upload your attachment</h5>
                    <label for="hw-file" class="attachment-icon">
                        <img src="../svg/upload-svgrepo-com.svg" alt="">
                </label>
                    <input type="file" id="hw-file" name="hw-file" hidden>
                </div>
            </div>

            <div class="col upload-btn-box">
                <label for="submit-btn" class="upload-btn">Upload</label>
                <input type="submit" id="submit-btn" name="submit-btn" hidden>
            </div>
        </form>
    </div>

    <div class="msg-box">
        <div class="close-btn">
            <img src="../svg/close-svgrepo-com.svg" alt="">
        </div>
        <label>Faild to upload data !!</label>
    </div>

</body>

</html>

<?php
    if(isset($_POST['submit-btn'])){
        $answer = $_POST["answer"];
        if(!empty($answer) || !empty($_FILES['hw-file']["name"])){

        $query = "INSERT INTO student_homework (homework_id , student_sid , answer , status) VALUES('$homework_id' , '$id' , '$answer' , 'pending')";
        $result = mysqli_query($system_conn , $query);

        if($result && !empty($_FILES['hw-file']["name"])){
            $hw_id = create_id("st-HW-" , 6);
            $fName = $_FILES['hw-file']["name"];
            $filetmpName = $_FILES['hw-file']["tmpname"];
            $folder = $student_hw_folder ;
            $type = get_file_extension($fName);
            $url = $folder.$hw_id.'.'.$type ;
            $fileNM = $hw_id.'.'.$type ;

            if(move_uploaded_file($filetmpName , $url)){
                $query = "INSERT INTO student_homework_file(homework_id, file_name , student_sid) VALUES('$homework_id' , '$fileNM' , '$id')";
                if(mysqli_query($system_conn , $query)){
                
                }
            }
            
        }
        echo "<script>window.close()</script>";
    }
}
?>