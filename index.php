<?php include "config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Priest Chat</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	body {
		background-color: black;
	    background-image: url("backgroundImage.png");
	    background-repeat: no-repeat;
	    background-position: 50% 0%;
	}

	#loginField {
		background-color: lightblue;
		padding: 1rem;
		width: 17rem;
		margin: auto;
		margin-top: 13rem;
		border-radius: 6px;
		box-shadow: 7px 7px 7px;
	}
</style>
</head>

<body>
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	 ?>

    <h1>Member Area</h1>
  	 <p>Thanks for logging in! You are <b><?=$_SESSION['Username']?><b> and your email address is <b><?=$_SESSION['EmailAddress']?></b>.</p>
     <br/>
     <?php if ($_SESSION['Username'] == 'TedCrilly')
	 echo "<h4>FLag{if you want to meet priests your own age}</h4>";
	 ?>
     <ul>
        <li><a href="logout.php">Logout.</a></li>
    </ul>

    <?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
	 $username = $_POST['username'];
    $password = md5($_POST['password']);
		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);

	 $checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");

    if(mysql_num_rows($checklogin))
    {
    	 $row = mysql_fetch_array($checklogin);
        $email = $row['EmailAddress'];

        $_SESSION['Username'] = $row['Username'];
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = 1;

    	 echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='2;index.php' />";
    }
    else
    {
    	 echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
else
{
	?>

   <h1>Member Login</h1>

   <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>

	<form method="post" action="index.php" name="loginform" id="loginform">
	<fieldset>
		<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<input type="submit" name="login" id="login" value="Login" />
	</fieldset>
	</form>

   <?php
}
?>
</div>
</body>
</html>
