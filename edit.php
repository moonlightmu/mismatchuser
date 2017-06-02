<html>
<head>
<title>Edit</title>
<link type="text/css" rel="stylesheet" href="total.css"/>
</head>
<body>
<h1>Mismatch-Edit Profile</h1>
<?php

require_once('blogin.php');
require_once('navmenu.php');
if(isset($_POST['submit']))
{
	//connect
	//$username=$_SERVER['PHP_AUTH_USER'];
	//$password=$_SERVER['PHP_AUTH_PW'];
	//$username=$_COOKIE['username'];
	$username=$_SESSION['username'];
	$firstname=$_POST['first_name'];
	$lastname=$_POST['last_name'];
	$gender=$_POST['gender'];
	$birthday=$_POST['brithday'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	
	$picture=$_FILES['picture']['name'];
	$picture_type=$_FILES['picture']['type'];
	$picture_position=$_FILES['picture']['tmp_name'];
	$picture_size=$_FILES['picture']['size'];
	if(isset($picture_type) == 'image/jpeg')
	{
		if($_FILES['file']['error']==0)
		{
			$target=GW_UPLOADPATH.$picture;
			if(move_uploaded_file($_FILES['picture']['tmp_name'],$target))
			{
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
$query="update mismatch_user set 
first_name='$firstname',last_name='$lastname',gender='$gender',brithday='$birthday',
city='$city',state='$state',picture='$picture'
 where username='$username'";
$data=mysqli_query($dbc,$query) or die ('error on query');
@unlink($_FILES['picture']['tmp_name']);
echo '<h2>success</h2>';
mysqli_close($dbc);
			}
		}
	}
}
?>


<a href="index.php">Index</a><br/>
<a href="edit.php">Edit again</a>w
<form enctype="multipart/form-data"
 method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<fieldset>
<legend>Personal information</legend>
<div id="tableRow">
<p id="blog">First name:</p><p id="blog"><input type="text" name="first_name"></p>
</div>
<div id="tableRow">
<p id="blog">Last name:</p><p id="blog"><input type="text" name="last_name"></p>
</div>
<div id="tableRow">
<p id="blog">Gender:</p><p id="blog"><input type="text" name="gender"></p>
</div>
<div id="tableRow">
<p id="blog">Birthday:</p><p id="blog"><input type="text" name="brithday"></p>
</div>
<div id="tableRow">
<p id="blog">city:</p><p id="blog"><input type="text" name="city"></p>
</div>
<div id="tableRow">
<p id="blog">state:</p><p id="blog"><input type="text" name="state"></p>
</div>
<div id="tableRow">
<p id="blog">Picture:</p><p id="blog">
<input type="file" name="picture" id="picture">
<input type="submit" name="submit" value="Save"/></p>
</div>
</fieldset>
</form>
</body>
</html>

   