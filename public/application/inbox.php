<?php
include 'envVariables.php';
$db_name = $envVariables['DB_DATABASE'];
$mysql_user=$envVariables['DB_USERNAME'];
$mysql_pass=$envVariables['DB_PASSWORD'];
$server_name=$envVariables['DB_HOST'];

    $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

if (empty($_GET['agentkey'])) {
$userkey = $_GET["userkey"];
  
 $sql = "select * from(
SELECT cid,msg,doc,image,agentname,username,agentkey,userkey,senderdevice, row_number() OVER (PARTITION BY agentkey ORDER BY CID DESC) as rownumber
         FROM   spr_chat
WHERE  userkey = '$userkey' ) AS a 
         WHERE  a.rownumber = 1" ;

  

   $raw = mysqli_query($con,$sql);

while($res=mysqli_fetch_assoc($raw)){
$data[]=$res;
     
    }
   print(json_encode($data));

}else{
 $agentkey = $_GET["agentkey"];
    

$sql = "select * from(
SELECT cid,msg,doc,image,agentname,username,agentkey,userkey,senderdevice, row_number() OVER (PARTITION BY agentkey ORDER BY CID DESC) as rownumber
         FROM   spr_chat
WHERE  agentkey = '$agentkey' ) AS a 
         WHERE  a.rownumber = 1" ;

  

   $raw = mysqli_query($con,$sql);

while($res=mysqli_fetch_assoc($raw)){
$data[]=$res;
     
    }
   print(json_encode($data));

}
?>


    