<?php
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];

        $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

        if (empty($_GET['abid'])) {
                $key = $_GET["userkey"];
                $sql = "SELECT * FROM spr_sellerbookmark WHERE userkey = '$key'";
                $raw = mysqli_query($con,$sql);
                while($res=mysqli_fetch_assoc($raw)){
                    $data[]=$res;
                }
                print(json_encode($data));
               
            
         }else{
                $key = $_GET["userkey"];
                $abid = $_GET["abid"];

                $sql = "SELECT * FROM spr_sellerbookmark WHERE userkey = '$key' AND abid = '$abid'";
                $raw = mysqli_query($con,$sql);
                while($res=mysqli_fetch_assoc($raw)){
                    $data[]=$res;
                }
                print(json_encode($data));
            }



        


?>