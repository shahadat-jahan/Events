<?php
include("dblib.php");
include("clublib.php");
include("date.php");
?>
<html>
<head>
	<title>View clubs</title>
</head>

<body>
	<?php
	if(isset($actionflag)&&$actionflag=="showClubs")
		$_SESSION["viewclubs"]=$_POST;
	elseif($_SESSION["viewclubs"])
		$_POST=$_SESSION["viewclubs"];
	else
	{
		$_SESSION["viewclubs"]["area"]="ANY";
		$_SESSION["viewclubs"]["type"]="ANY";
	}
	function displayClub()
		{
			global $_SESSION;
			$clubs=getClubs($_SESSION["viewclubs"]["area"],
							$_SESSION["viewclubs"]["type"]);
			if(!$clubs)
			{
				print "No clubs yet that fit these conditions<p>\n";
				return;
			}
			print "<table border=1>\n";
			print "<td><b>Club</b></td>\n";
			print "<td><b>Area</b></td>\n";
			print "<td><b>Type</b></td>\n";
			foreach ($clubs as $row)
			{
				print "<tr>\n";
				print "<td><a href=\"viewclub.php?club_id=$row["id"]\">".
						html($row["name"])."</a></td>\n";
				print "<td>$row["areaname"]</td>\n";
				print "<td>$row["typename"]</td>\n";
				print "</tr>\n";
			}
			print "</table>\n";
		}
	include("publicnav.php");
	?>
	<p>
		<h2>View Clubs</h2>
		<form action="<?php print $PHP_SELF;?>">
			<input type="hidden" name="actionflag" value="showClubs">
			<input type="hidden" name="<?php print SESSION_name()?>"
					value="<?php print SESSION_id()?>">
			<select name='POST["area"]'>
				<option value="ANY">Any Area
					<?php writeOptionList("areas",$_POST["area"])?>
				</option>
			</select>
			<select name='POST["type"]'>
				<option value="ANY">Any type of club
					<?php writeOptionList("types",$_POST["type"])?>
				</option>
			</select>
			<input type="submit" value="Change">
		</form>
	</p>
	<?php
	displayClubs();
	?>
</body>
</html>