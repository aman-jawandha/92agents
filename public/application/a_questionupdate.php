<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];

$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
    
 $qid = $_POST['qid'];  
 $reply = $_POST['reply'];
     
$sql = "update spr_question set reply = '$reply' WHERE qid= '$qid'";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>