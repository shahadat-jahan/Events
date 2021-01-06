<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
include("dblib.php");
include("clublib.php");
?>
<html>
<head>
	<title>Login</title>
</head>

<body>
<?php
	$message="";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["login"]) || empty($_POST["password"]))
			$message.="You must fill in all field<br>\n";
		$row_array = checkPassword($_POST["login"], $_POST["password"]);
	if(is_array($row_array) && count($row_array)>0){
		$_SESSION["id"] = $row_array['id'];///store user id into SESSION
		// $_SESSION["email"] = $user_info['email'];
		
		cleanMemberSession($row_array["id"], $row_array["login"], $row_array["password"]);
			header("Location: http://localhost/events/membersmenu.php");
	}else{
		$message.= "Username or passwrod incorrect.";
	}

	}
include("publicnav.php");
?>
	<h2>Login</h2>
	<?php
	if($message !="")
		{
			print "<p><b>$message</b></p>";
		}
	?>
	<p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="actionflag" value="login">
		<input type="hidden" name="<?php print session_name()?>">
		<label>Login</label>
		<input type="text" placeholder="Login" name="$_POST['login']" >

		<br>
		<br>

		<label>Password</label>
		<input type="password" placeholder="Enter password" name="$_POST['password']" >

		<div class="clearfix">
			<input type="submit" name="submit" value="Login">
			<input type="reset">
		</div>
		</form>
	</p>
</body>
</html>