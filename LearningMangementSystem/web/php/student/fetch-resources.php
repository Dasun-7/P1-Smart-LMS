<?php
session_start();
include("../connection.php");
include("../function.php");

$outPut = "";
$user = get_user_data($user_conn);
if(isset($user["system_sid"])){
    $id = $user["system_sid"];
    $class = getStudentClass($user_conn ,$id);

    $query = "SELECT * FROM resource_class WHERE class_no = '$class'";
    $result = mysqli_query($system_conn , $query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($data = mysqli_fetch_assoc($result)){
                $res_id = $data["res_id"];
                $queryRes = "SELECT * FROM resource WHERE res_id = '$res_id'";
                $resultRes = mysqli_query($system_conn , $queryRes);

                if($resultRes){
                    $dataRes = mysqli_fetch_assoc($resultRes);
                    $sub_name = getSubName($user_conn , $dataRes["sub_id"]);
                    $outPut .= " <div class='resource-div' id='$dataRes[res_id]'>
                    <div class='date-div'>$dataRes[date]</div>
                    <h1>$sub_name</h1>
                    <h2>$dataRes[title]</h2>
                    <p>$dataRes[info]</p>
                    <div class='download-resource-btn'> download </div>
                </div>";
                }
              
            }
            
        }
        echo $outPut;
    }
}

?>