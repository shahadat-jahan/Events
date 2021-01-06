<?php
include("dblib.php");
include("clublib.php");
include("date.php");
?>
<html>
<head>
	<title>Review events</title>
</head>

<body>
<?php
	if (isset($actionflag)&&$actionflag=="showEvents")
		$_SESSION["viewevents"]=$$_POST;
	elseif ($_SESSION["viewevents"])
		$$_POST=$_SESSION["viewevents"];
	else {
		$d_array= getData(time());
		$_SESSION["viewevents"]["area"]="ANY";
		$_SESSION["viewevents"]["type"]="ANY";
		$_SESSION["viewevents"]["months"]=$d_array["mon"];
		$_SESSION["viewevents"]["years"]=$d_array["year"];
	}
	$range= getDataRange($_SESSION["viewevents"]["months"],
						$_SESSION["viewevents"]["years"]);
	function displayEvents()
		{
			global $range, $_SESSION;
			$events= getEvents(0, $range, $_SESSION["viewevents"]["area"],
								$_SESSION["viewevents"]["type"]);
			if(!$events)
			{
				print "NO events yet for this combination<p>";
				return;
			}
			print "<table border=1>\n";
			print "<td><b>Date</b></td>\n";
			print "<td><b>Event</b></td>\n";
			print "<td><b>Club</b></td>\n";
			print "<td><b>Area</b></td>\n";
			print "<td><b>Type</b></td>\n";
			foreach($events as $row)
			{
				print "<tr>\n";
				print "<td>".date("j M Y H. i", $row["edate"])."</td>\n";
				print "<td><a href=\"viewevents.php?event_id=$row["id"]&\">".
					html($row["ename"])."</a></td>\n";
				print "<td><a href=\"viewclub.php?club_id=$row["eclub"]&\">".
					html($row["name"])."</a></td>\n";
				print "<td>$row["areaname"]</td>\n";
				print "<td>$row["typename"]</td>\n";
				print "</tr>\n";
			}
			print "</table>\n";
		} 
include("publicnav.php");
?>
<h2>View Events</h2>
<p>
	<form action="<?php print $PHP_SELF;?>">
		<input type="hidden" name="actionflag" value="showEvents">
		<input type="hidden" name="<?php print SESSION_name()?>"
			value="<?php print SESSION_id()?>">
		<select name="POST["months"]">
			<?php writeOption($range["0"]);?>
		</select>

		<select name="POST["years"]">
			<?php writeOption($range["0"]);?>
		</select>

		<select name="POST["area"]">
			<option value="ANY">ANY Area
			<?php writeOptionList("areas, $_POST["area"]")?>
		</select>

		<select name="POST["type"]">
			<option value="ANY">ANY type of event
			<?php writeOptionList("types, $_POST["type"]")?>
		</select>

		<input type="submit" value="Change">
	</form>
</p>
<?php
displayEvents();
?>
</body>
</html>