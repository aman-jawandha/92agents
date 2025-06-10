<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
    

$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

     $too = $_POST['too'];
     $fromm = $_POST['fromm'];
     $question = $_POST['question'];
     $reply = $_POST['reply'];
     $receiverkey = $_POST['receiverkey'];
     $senderkey = $_POST['senderkey'];

$sql = "INSERT INTO spr_question values (NULL,'$too','$fromm','$question','$reply','$receiverkey','$senderkey')";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>