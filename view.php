<html>
<head>
<title>View</title>
<link rel="stylesheet" type="text/css" href="total.css"/>
</head>
<body>
<?php
require_once('blogin.php');
require_once('navmenu.php');
//$username=$_SERVER['PHP_AUTH_USER'];
//$username=$_COOKIE['username'];
$username=$_SESSION['username'];
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query="select * from mismatch_user where username='$username'";
$result=mysqli_query($dbc,$query) or die('error in query');

if($row=mysqli_fetch_array($result)){
	$firstname=$row['first_name'];
	$lastname=$row['last_name'];
	$gender=$row['gender'];
	$birthday=$row['brithday'];
	$location=$row['state']."".$row['city'];
	$picture=$row['picture'];
echo '<h1>Mismatch-View</h1>';
echo '<table>';
echo '<tr><td id="blog">First name:</td><td>'.'<input type="text" name="firstname" value="'.$firstname.'"/></td></tr>';
echo '<tr><td id="blog">Last name:</td><td>'.'<input type="text" name="lastname" value="'.$lastname.'"/></td></tr>';
echo '<tr><td id="blog">Gender:</td><td>'.'<input type="text" name="gender" value="'.$gender.'"/></td></tr>';
echo '<tr><td id="blog">Birthday:</td><td>'.'<input type="text" name="birthday" value="'.$birthday.'"/></td></tr>';
echo '<tr><td id="blog">Location:</td><td>'.'<input type="text" name="location" value="'.$location.'"/></td></tr>';
echo '<tr><td id="blog">Picture:</td><td>'.'<img name="picture" src="image/'.$picture.'"/></td></tr>';
echo '</table>';
echo '<p><a>would you want to edit your email</a></p>';
}
?>
</body>
</html>