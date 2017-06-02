<?php
require_once ('appvars.php');
require_once('connectvars.php');

//if user input the password and username or send the header
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ){
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate:Basic realm=" head Mismatch"');
exit('<h3>Mismatch</h3>Sorry,you must enter your username and password to log in and access this page.');
}
//connect to the database
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//GRAB 
$user_username=mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_USER']));
$user_password=mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_PW']));

//Look up the username and password in the database
$query="select user_id,username from mismatch_user where username='$user_username' 
and password=SHA('$user_password')";

$data=mysqli_query($dbc,$query);

if (mysqli_num_rows($data) == 1) {
$row=mysqli_fetch_array($data);
$userid = $row['user_id'];
$username = $row['username'];
}
echo '<p>You are logged in as '.$username.'</p>';

?>