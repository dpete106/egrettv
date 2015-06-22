<?php 
//$dbc = mysql_connect('egrettvorg.ipagemysql.com', 'egrettvorg', 'Q$a6z5w7'); 
$dbc = new mysqli('egrettvorg.ipagemysql.com', 'egrettvorg', 'Q$a6z5w7');
if (!$dbc) { 
    die('Could not connect: ' . mysqli_connect_error()); 
} 
//echo 'Connected successfully'; 
mysqli_select_db($dbc,'egrettv'); 
?> 

