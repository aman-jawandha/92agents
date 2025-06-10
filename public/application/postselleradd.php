<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
    
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

$username = $_POST['username'];
     $title = $_POST['title'];
     $details = $_POST['details'];
     $line1 = $_POST['line1'];
     $line2 = $_POST['line2'];
     $state = $_POST['state'];
     $city = $_POST['city'];
     $zipcode = $_POST['zipcode'];
     $feature = $_POST['feature'];
     $date = $_POST['date'];
     $type = $_POST['type'];
     $nego = $_POST['nego'];
     $shortsale = $_POST['shortsale'];
     $startdate = $_POST['startdate'];
     $clodate = $_POST['clodate'];
     $applier = $_POST['applier'];
     $userkey = $_POST['userkey'];
    $usertype = $_POST['usertype'];
     $agentkey = $_POST['agentkey'];
     $agentname = $_POST['agentname'];

$sql = "INSERT INTO spr_sellerpost values (NULL,'$username','$title','$details','$line1','$line2','$state','$city','$zipcode','$feature','$date','$type','$nego','$shortsale','$startdate','$clodate','$applier','$userkey','$usertype','$agentkey','$agentname')";
    
  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>