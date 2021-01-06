<?php
include("dblib.php");
include("clublib.php");
?>
<html>
<head>
	<title>Update your club listing</title>
</head>

<body>

<?php
$club_row = checkUser();
print_r($club_row);
$nameErr = $typeErr = $areaErr = $emailErr = $descriptionErr ="";
$name = $type = $area = $email = $description ="";

$has_error = false;//boolean type variable

if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if (empty($_POST["name"])) {
					$nameErr = "Club name is required";
					$has_error = true;
				}
				else {
					$name = test_input($_POST["name"]);
					if (!preg_match("/^[a-z A-Z 0-9]*$/",$name)){
						$nameErr = "Only letter and number allowed";
						$has_error = true;
					}
				}

				if (empty($_POST["type"])) {
					$typeErr = "Culb type is required";
					$has_error = true;
				}
				

				if (empty($_POST["area"])) {
					$areaErr = "Culb area is required";
					$has_error = true;
				}
				
				if (empty($_POST["email"])) {
					$emailErr = "Email is required";
					$has_error = true;
				}
				else {
					$email = test_input($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
						$emailErr = "Invalid email format";
						$has_error = true;
					}
				}


					$description = test_input($_POST["description"]);
				

 				// echo "has_error=".$has_error;
				if(!$has_error){
					updateOrg($_SESSION["id"], $_POST["name"], $_POST["type"], $_POST["area"], $_POST["email"], $_POST["description"]);
					
					header("Location: http://localhost/events/membersmenu.php");
				}
			
 			}

 			else{
 				$name = $club_row['name'];
 				$email = $club_row['email'];
 				$description = $club_row['description'];
 				$type = $club_row['type'];
 				$area = $club_row['area'];
 			}

 	function test_input($data){
				$data = trim($data);
				$data = stripcslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

include("publicnav.php");

?>
	
		<form method="post" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Club information</h2>
				<p class="error">* required field.</p>
				<div class="container">
					<label><span class="error">* <?php echo $nameErr;?></span> Club name</label><br>
					<input type="text" placeholder="Club name" name="name" value="<?php echo $name;?>" >
					
					<br>
					<br>
					
					<label><span class="error">* <?php echo $typeErr;?></span> Club type</label><br>
					<select name="type">
						<?php writeOptionList("types", $type, 'type')?>
					</select>
										
					<br>
					<br>

					<label><span class="error">* <?php echo $areaErr;?></span> Club area</label><br>
					<select name="area">
						<?php writeOptionList("areas", $area, 'area')?>
					</select>

					<br>
					<br>

					<label><span class="error">* <?php echo $emailErr;?></span> Club email</label><br>
					<input type="email" placeholder="Club email" name="email" value="<?php echo $email;?>" >

					<br>
					<br>

					<label><span class="error">* <?php echo $descriptionErr;?></span> Club description</label><br>
					<textarea name="description" rows="10" cols="50"><?php echo $description;?></textarea>

					<div class="clearfix">
						<input class="submitbtn" type="submit" name="submit" value="Update">
						<input type="reset">		
					</div>
				</div>
		</form>		
	</body>
</html>