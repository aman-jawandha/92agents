<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];
    
$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

    if (empty($_GET['userkey'])) {
    
   
}else{
 $type = $_GET["type"];
    $key = $_GET["userkey"];
    
        $sql = "SELECT * FROM spr_note WHERE userkey = '$key' AND type = '$type' ORDER BY NID DESC LIMIT 2";
        $raw = mysqli_query($con,$sql);
        while($res=mysqli_fetch_assoc($raw)){
        $data[]=$res;
    }
   print(json_encode($data));  
}


?>