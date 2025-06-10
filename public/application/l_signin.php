<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];

        $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

        
                $key = $_GET["email"];
                 $password = $_GET["password"];
                $sql = "SELECT * FROM spr_userlogin WHERE email = '$key' and password = '$password'";
                $raw = mysqli_query($con,$sql);
                while($res=mysqli_fetch_assoc($raw)){
                    $data[]=$res;
                }
                print(json_encode($data));
           

?>