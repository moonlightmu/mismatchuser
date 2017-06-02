<?php
require_once('appvars.php');
require_once('connectvars.php');
session_start();
//clear the error message
$error_msg="";
//try to log
//if(!isset($_COOKIE['user_id']))
if(!isset($_SESSION['user_id']))
{
	if(isset($_POST['submit']))
	{	
		if(!empty($_POST['username']) && !empty($_POST['password']))
	    {
		   //connect to db
		   $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		   //Grab data
		   $user_username=mysqli_real_escape_string($dbc,trim($_POST['username']));
		   $user_password=mysqli_real_escape_string($dbc,trim($_POST['password']));
		   //query the db
		   $query="select * from mismatch_user where username='$user_username'
            and password=SHA('$user_password')";
		   $data=mysqli_query($dbc,$query);
		   
		    if(mysqli_num_rows($data)==1)
		    {
		     //chun zai ,keyi login	
		     $row=mysqli_fetch_array($data);
		     //setcookie('user_id',$row['user_id']);
		     $_SESSION['user_id']=$row['user_id'];
		     //setcookie('username',$row['username']);
		     $_SESSION['username']=$row['username'];
		     setcookie('user_id',$row['user_id'], time()+(60*60*24*30) );
		     setcookie('username',$row['username'],time()+(60*24*24*30) );
		     
		     $home_url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
		     echo'<p>'.$home_url.'</p>';
		     header('Location: '.$home_url);
	      	}
	      	else if(mysqli_num_rows($data)==0)
	      	{
	      		//xuyao zhuce
	      		$error_msg='you need to input a valid username or password';
	      	}else{
	      		echo '<p>ok</p>';
	      	}
	    }
	    else{
	    	$error_msg='you must enter your username,password';
	    }
	}
}
?>
<html>
<head>
<title>Login</title>
<link type="text/css" rel="stylesheet" href="total.css">
</head>
<body>
<?php 
//if(empty($_COOKIE['user_id']))
if(empty($_SESSION['user_id']))
{
	echo '<p>'.$error_msg.'</p>';
?>	
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<fieldset>
<legend>Login info</legend>
<div id="tableRow">
<p id="blog">Username:</p><p id="blog"><input type="text" name="username" 
value="<?php if(!empty($user_username)) echo $user_username; ?>"/></p>
</div>
<div id="tableRow">
<p id="blog">Password:</p><p id="blog"><input type="text" name="password"></p>
</div>
</fieldset>
<input type="submit" name="submit" value="submit">
</form>

<?php 
}
else{
	//echo '<p>you are logged in as '.$_COOKIE['username'].'</p>';
	echo '<p>you are logged in as '.$_SESSION['username'].'</p>';
}
?>
</body></html>

