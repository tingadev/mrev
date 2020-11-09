<?php
// $lang = 'vn';

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "mrev";

foreach ($db as $key => $value){
    
    define(strtoupper($key),$value);
    
    
}

$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$counter_connected = true;
$query="SET NAMES utf8";

mysqli_query($connection,$query);

if(!$connection)
{
    $counter_connected = false;
    echo "Connect Database failed!";
    
}


?>