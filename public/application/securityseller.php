<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
    
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
    
     $email = $_POST['email'];
     $que1 = $_POST['que1'];
     $answer1 = $_POST['answer1'];
     $que2 = $_POST['que2'];
     $answer2 = $_POST['answer2'];

$sql = "update spr_securityquestion set que1 = '$que1',answer1 = '$answer1',que2 = '$que2',answer2 = '$answer2' where email = '$email' ";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>