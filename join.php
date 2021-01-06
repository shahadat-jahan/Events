

<?php
include("dblib.php");
include("clublib.php");
?>
<html>
<head>
	<title>Join!</title>
</head>

<body>

<?php

$loginErr = $passwordErr = $password2Err ="";
$login = $password = $password2 ="";

$has_error = false;//boolean type variable

if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if (empty($_POST["login"])) {
					$loginErr = "login is required";
					$has_error = true;
				}
				else {
					$login = test_input($_POST["login"]);
					if (!preg_match("/^[a-z A-Z 0-9]*$/",$login)){
						$loginErr = "Only letter and number allowed";
						$has_error = true;
					}else{
						$chk_username_obj = getRow ("clubs", "login", $_POST["login"]);
						if($chk_username_obj->num_rows> 0){							
							$loginErr = "login ".$_POST["login"]." already taken. Try another.";
							$has_error = true;
						}
					}	
				}
				
				if (empty($_POST["password"])) {
					$passwordErr = "Password is required";
					$has_error = true;
				}
				else {
					$password = test_input($_POST["password"]);
					if (!preg_match("/^[a-z A-Z 0-9]*$/",$password)){
						$passwordErr = "No white space allowed";
						$has_error = true;
					}	
				}

				if (empty($_POST["password2"])) {
					$password2Err = "Repeat password is required";
					$has_error = true;
				}
				elseif($_POST["password"] != $_POST["password2"]) {
					$password2Err = "Password does not match";
					$has_error = true;
						
				}else{
						$password2 = test_input($_POST["password2"]);
				} 
 				// echo "has_error=".$has_error;
				if(!$has_error){
					$id=newUser($login, $password);
					cleanMemberSession($id, $_POST["login"]);
					header('Location: http://localhost/events/updateclub.php');
				}
			
 			}

 	function test_input($data){
				$data = trim($data);
				$data = stripcslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

include("publicnav.php");

?>
	
		<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Join</h2>
				<p class="error">* required field.</p>
				<div class="container">
					<label><span class="error">* <?php echo $loginErr;?></span> Login</label><br>
					<input type="text" placeholder="Login" name="login" value="<?php echo $login;?>" maxlength="8" >
					
					<br>
					<br>
					
					<label><span class="error">* <?php echo $passwordErr;?></span> Password</label><br>
					<input type="password" placeholder="Enter Password" name="password" value="<?php echo $password;?>" minlength="6" maxlength="8">
					
					<br>
					<br>

					<label><span class="error">* <?php echo $password2Err;?></span> Repeat Password</label><br>
					<input type="password" placeholder="Repeat Password" name="password2" value="<?php echo $password2;?>" >

					<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

					<div class="clearfix">
						<input class="submitbtn" type="submit" name="submit" value="Submit">
						<input type="reset">
					</div>
				</div>
		</form>		
	</body>
</html>