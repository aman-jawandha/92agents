<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];

        $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

        
                $key = $_POST["email"];
$password = $_POST["password"];
                $sql = "update spr_userlogin set password = '$password'  WHERE email= '$key'";
                
 if(mysqli_query($con,$sql)){
      echo 'data updated successfully';
    }
    else{
      echo 'failure';
    }


mysqli_close($con);
?>