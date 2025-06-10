<?php
    
    include 'envVariables.php';
    $db_name = $envVariables['DB_DATABASE'];
    $mysql_user=$envVariables['DB_USERNAME'];
    $mysql_pass=$envVariables['DB_PASSWORD'];
    $server_name=$envVariables['DB_HOST'];


$con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
if(!$con)
{
echo "Connection Error...".mysqli_connect_error();
}
else
{
echo "<h3> Database Connection Success.. </h3>";
}


?>