<?php
include 'envVariables.php';
$db_name = $envVariables['DB_DATABASE'];
$mysql_user=$envVariables['DB_USERNAME'];
$mysql_pass=$envVariables['DB_PASSWORD'];
$server_name=$envVariables['DB_HOST'];

        $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

        if (empty($_GET['psid'])) {
                $key = $_GET["agentkey"];
                $sql = "SELECT * FROM spr_agentbookmark WHERE agentkey = '$key'";
                $raw = mysqli_query($con,$sql);
                while($res=mysqli_fetch_assoc($raw)){
                    $data[]=$res;
                }
                print(json_encode($data));
               
            
         }else{
                $key = $_GET["agentkey"];
                $psid = $_GET["psid"];

                $sql = "SELECT * FROM spr_agentbookmark WHERE agentkey = '$key' AND psid = '$psid'";
                $raw = mysqli_query($con,$sql);
                while($res=mysqli_fetch_assoc($raw)){
                    $data[]=$res;
                }
                print(json_encode($data));
            }



        


?>