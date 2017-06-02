<html>
<head>
<title>index</title>
<link type="text/css" rel="stylesheet" href="total.css">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no,
minimum-scale=1.0,maximum-scale=1.0"/>
</head>
<body>
<h1>Mismatch</h1>
<?php

require_once('appvars.php');
require_once('connectvars.php');
//if(isset($_COOKIE['username']))
require_once('startsession.php');
require_once('navmenu.php');
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query="select username from mismatch_user";
$data=mysqli_query($dbc, $query);
while($row=mysqli_fetch_array($data))
{
	if(isset($_SESSION['user_id']))
	{
		echo '<p>username='.$row['username'].'</p>';
	 }
	else{
		echo '<p>username='.$row['username'].'</p>';
		
	}
}
?>
</body>
</html>