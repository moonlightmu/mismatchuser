<?php
if(isset($_SESSION['username']))
{
	//echo '&#10084;<a href="blogout.php">Log out('.$_COOKIE['username'].')</a><br/>';
	echo '&#10084;<div class="left"><a href="blogout.php">Log out('.$_SESSION['username'].')</a><br/></div>';
	echo '&#10084;<div class="left"><a href="edit.php">Edit</a><br/></div>';
	echo '&#10084;<div class="left"><a href="view.php">View</a></div>';
}
else{
	echo '&#10084; <div class="left"><a href="blogin.php">Log in</a><br/></div>';
	echo '&#10084; <div class="left"><a href="signup.php">Sign up</a></div>';
}
?>