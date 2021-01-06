<?php
include("dblib.php");
include("clublib.php");
include("date.php");
?>
<html>
<head>
	<title>Add/edit event</title>
</head>

<body>
<?php
$enameErr = $areaErr= $typeErr = $edescriptionErr = $evenueErr = $eaddressErr = $ezipErr ="";
$ename = $area = $type = $edescription = $evenue = $eaddress = $ezip ="";
$club_row= checkUser();
checkClubData($club_row);
$date=time();
$message="";

if(!empty($event_id))
	$event_row=getRow("events", "ename", $_POST["ename"]);
else
	$event_id= false;
if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["ename"]))
			$message.="The event must have name<br>\n";
		if(!getRow("areas", "id", $_POST["area"]))
			$message.="That area can't be found<br>\n";
		if(!getRow("type", "id", $_POST["type"]))
			$message.="That type can't be found<br>";
		foreach (array("years", "months", "days", "hours", "minutes") as $date_unit)
			{
				if(!isset($_POST["date_unit"]))
					{
						$message.="Can't make sense of that date";
						break;
					}
			}
			$date= mktime($_POST["minutes"], $_POST["hours"], 0, $_POST["days"], $_POST["months"], $_POST["years"]);
			if($date<time())
				$message.="Tou have chosen a date in the past";
			if($message== "")
			{
				insertEvent($_POST["ename"], $_POST["evenue"], $_POST["area"], $_POST["type"], $_POST["eaddress"], $_POST["ezip"],
					 $_POST["edescription"], $_SESSION["id"], $date, $event_id);
				header("Location: http://localhost/events/reviewevents.php");
			}
	}
	elseif ($event_id) {
		$_POST= $event_row;
		$date= $event_row["edate"];
		}
	else
		{
			$_POST["area"]= $club_row["area"];
			$_POST["type"]= $club_row["type"];
		}	
include("publicnav.php");
?>
<h2>Edit event</h2>
<?php
if($message!="")
	{
		echo "<b>$message</b>";
	}
?>
<p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<label>Event name</label>
		<input type="text" placeholder="Event name" name="ename" value="<?php echo $ename;?>" >
		<br>
		<br>
		<label>Date and time</label>
		<select name="years"><?php writeYearOptions($date)?></select>
		<select name="months"><?php writeMonthOptions($date)?></select>
		<select name="days"><?php writeDayOptions($date)?></select>
		<select name="hours"><?php writeHourOptions($date)?></select>
		<select name="minutes"><?php writeMinuteOptions($date)?></select>
		<br>
		<br>
		<label>Event area</label>
		<input type="text" placeholder="Event area" name="area" value="<?php echo $area?>">
		<br>
		<br>
		<label>Event type</label>
		<input type="text" placeholder="Event type" name="$_POST['type']" value="<?php echo $_POST['type']?>">
		<br>
		<br>
		<label>Event description</label>
		<textarea name="edescription" wrap="virtual" rows="10" cols="30">
			<?php echo $_POST['edescription']?>
		</textarea>
		<br>
		<br>
		<label>Venue name</label>
		<input type="text" placeholder="Venue name" name="evenue" value="<?php echo $_POST['evenue']?>">
		<br>
		<br>
		<label>Venue address</label>
		<textarea name="eaddress" wrap="virtual" rows="10" cols="30">
			<?php echo $_POST['eaddress']?>
		</textarea>
		<br>
		<br>
		<label>Venue zip code</label>
		<input type="text" placeholder="Zip code" name="ezip" value="<?php echo $_POST['ezip']?>">
		<br>
		<br>
		<input type="submit" value="Update">
		<input type="reset">
	</form>
</p>
</body>
</html>