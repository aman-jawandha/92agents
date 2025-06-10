<?php
 include 'envVariables.php';
 $db_name = $envVariables['DB_DATABASE'];
 $mysql_user=$envVariables['DB_USERNAME'];
 $mysql_pass=$envVariables['DB_PASSWORD'];
 $server_name=$envVariables['DB_HOST'];   

$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

     $nid = $_POST['nid'];  
     $title = $_POST['title'];
     $note = $_POST['note'];

$sql = "update spr_note set title = '$title', note = '$note' WHERE nid= '$nid'";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>