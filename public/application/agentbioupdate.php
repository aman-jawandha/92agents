<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

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
     $userkey = $_POST['userkey'];

$sql = "update spr_agentbio set offaddress = '$offaddress', state = '$state',city = '$city', zipcode = '$zipcode',licenceno = '$licenceno',franchise ='$franchise',experience = '$experience', companyname = '$companyname',fax = '$fax', brokername = '$brokername',mlspublic = '$mlspublic',mlsoffice ='$mlsoffice'  where userkey = '$userkey'";
    
  if(mysqli_query($con,$sql)){
   
    }
    else{
      echo 'failure';
    }
    mysqli_close($con);

?>