<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
    
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
    
     $title = $_POST['title'];
     $note = $_POST['note'];
     $type = $_POST['type'];
     $userkey = $_POST['userkey'];

$sql = "INSERT INTO spr_note values (NULL,'$title','$note','$type','$userkey')";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>