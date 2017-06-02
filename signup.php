<?php 
require_once('appvars.php');
require_once('connectvars.php');
if(isset($_POST['submit']) )
{
//CONNECT TO THE MISMATCH 
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//grap the string input 
$username=mysqli_real_escape_string($dbc,trim($_POST['username']));
$password=mysqli_real_escape_string($dbc,trim($_POST['password']));
$password2=mysqli_real_escape_string($dbc,trim($_POST['password2']));
if(!empty($username) && !empty($password) && !empty($password2) && ($password==$password2)){
//select into the dbc
$query="select username,password from mismatch_user where username='$username'";
//do select 
$data=mysqli_query($dbc,$query);
//get the select result
if(mysqli_num_rows($data)==1){
	echo '<p>change another</p>';
	$username="";
}
else {
	//not in the mismatech db ,insert it
	$query="insert into mismatch_user (username,password,join_date) values ('$username',sha('$password'),now());";
   mysqli_query($dbc,$query) or die('error on query');
   mysqli_close($dbc);
   echo '<p>Your new account has been successfully created.you <a href="edit.php">edit your info</a>.</p>';
   $home_url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
   header('Location: '.$home_url);
}
}
else{
	echo '<p> you must enter all the data</p>';
 }
}
?>
<html>
<head>
<title>signup</title>
<link type="text/css" rel="stylesheet" href="total.css">
</head>
<body>
<h1>Mismatch-Sign up</h1>
<p>Please input your username and password to sign up to Mismatch</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<fieldset>
<legend>Registeration info</legend>
<div id="tableRow">
<p id="blog">Username:</p>
<p><input type="text" name="username" value=<?php if(!empty($username)) echo $username;?>></p>
</div>
<div id="tableRow">
<p id="blog">Password:</p>
<p><input type="text" name="password"/></p>
</div>
<div id="tableRow">
<p id="blog">Password2:</p>
<p><input type="text" name="password2"/></p>
</div>
</fieldset>
<input type="submit" name="submit" value="Sign up"/>
</form>	
</body>
</html>		
	




















