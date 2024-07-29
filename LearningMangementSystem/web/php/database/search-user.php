<?php
include('../connection.php');
include('../function.php');
if(isset($_GET['user'])){
    $text = '';
    $selection = mysqli_real_escape_string($user_conn, $_GET['select']);
    $name = mysqli_real_escape_string($user_conn, $_GET['name']);
    if($_GET['user'] == 'student'){
        if($name == ''){
            if($selection == 'all'){
                $query = "SELECT * FROM student";
            }else{
                $query = "SELECT * FROM student INNER JOIN student_class ON
                student.system_sid = student_class.student_sid WHERE student_class.class_no = '$selection'";
            }
        }else{
            if($selection == 'all'){
                $query = "SELECT * FROM student WHERE name LIKE '$name%'";
            }else{
                $query = "SELECT * FROM student INNER JOIN student_class ON
                student.system_sid = student_class.student_sid WHERE student_class.class_no = '$selection' AND student.name LIKE '$name%'";
            }
        }
        $result = mysqli_query($user_conn , $query);
        while($data = mysqli_fetch_assoc($result)){
            $id = $data["system_sid"];
            $pic_url = get_profile_pic($user_conn , $id);
            $st_cls = getStudentClass($user_conn , $id);
            $class_name = getClassName($user_conn , $st_cls);
            $text .= " <li id='$id'>
            <div class='user-pic'>
                <img src='$pic_url' >
            </div>
            <div class='user-name'>$data[name]</div>
            <div class='user-class'>$class_name</div>
        </li>";
        }
        echo $text ;
    }

    if($_GET['user'] == 'teacher'){
        if($name == ''){
            if($selection == 'all'){
                $query = "SELECT * FROM teacher";
            }else{
                $query = "SELECT * FROM teacher INNER JOIN teacher_subject ON
                teacher.system_tid = teacher_subject.teacher_sid WHERE teacher_subject.sub_id = '$selection'";
            }
        }else{
            if($selection == 'all'){
                $query = "SELECT * FROM teacher WHERE name LIKE '$name%'";
            }else{
                $query = "SELECT * FROM teacher INNER JOIN teacher_subject ON
                teacher.system_tid = teacher_subject.teacher_sid WHERE teacher_subject.sub_id = '$selection' AND teacher.name LIKE '$name%'";
            }
        }
        $result = mysqli_query($user_conn , $query);
        while($data = mysqli_fetch_assoc($result)){
            $id = $data["system_tid"];
            $pic_url = get_profile_pic($user_conn , $id);
            $text .= " <li id='$id'>
            <div class='user-pic'>
                <img src='$pic_url' >
            </div>
            <div class='user-name'>$data[name]</div>
        </li>";
        }
        echo $text ;
    }
}
?>