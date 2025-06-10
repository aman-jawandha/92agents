<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];

        $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

        
               $key = "svdhj";
                $sql = "SELECT * FROM spr_userlogin WHERE email = '$key'";
                

   $raw = mysqli_query($con,$sql);

if(mysqli_num_rows($raw) > 0){

while($res=mysqli_fetch_assoc($raw)){
     $data[]=$res;
    }
   print(json_encode($data)); 
echo 'success';
}
else{
     $data['userkey']=0;
$data['name']="abcd";
     $data['email']="abcd";;
$data['password']="abcd";
$data['type']="abcd";

print(json_encode($data));
echo 'failure';
}
          

mysqli_close($con);
?>