<?php
include 'envVariables.php';
$db_name = $envVariables['DB_DATABASE'];
$mysql_user=$envVariables['DB_USERNAME'];
$mysql_pass=$envVariables['DB_PASSWORD'];
$server_name=$envVariables['DB_HOST'];    

$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

     $abid = $_POST['abid'];
     $agentname = $_POST['agentname'];
     $offaddress = $_POST['offaddress'];
     $state = $_POST['state'];
     $city = $_POST['city'];
     $zipcode = $_POST['zipcode'];
     $licenceno = $_POST['licenceno'];
     $franchise = $_POST['franchise'];
     $experience = $_POST['experience'];
     $companyname = $_POST['companyname'];
     $fax = $_POST['fax'];
     $brokername = $_POST['brokername'];
     $mlspublic = $_POST['mlspublic'];
     $mlsoffice = $_POST['mlsoffice'];
     $agentkey = $_POST['agentkey'];
     $userkey = $_POST['userkey'];

$sql = "INSERT INTO spr_sellerbookmark values (NULL,'$abid','$agentname','$offaddress','$state','$city','$zipcode','$licenceno','$franchise','$experience','$companyname','$fax','$brokername','$mlspublic','$mlsoffice','$agentkey','$userkey')";

  if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>