<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

 if (empty($_GET['agentkey'])) {
   
}else{
 $agentkey = $_GET["agentkey"];
    $userkey = $_GET["userkey"];

   $sql = "SELECT * FROM spr_chat WHERE agentkey = '$agentkey' AND userkey = '$userkey'";
    
  $raw = mysqli_query($con,$sql);

while($res=mysqli_fetch_assoc($raw)){
     $data[]=$res;
    }
   print(json_encode($data)); 
}

?>


    