<?php
include("dblib.php");
include("clublib.php");
include("date.php");
?>
<html>
<head>
	<title>View event details</title>
</head>

<body>
	<?php
	if(!isset($event_id))
		header("Location:http://localhost/events/viewevents.php");
	$event=getEvent($event_id);
	html($event);
	include("publicnav.php");
	?>
	<p>
		<h2>View event details</h2>
		<h4><?php print $event["ename"]?></h4>
		<p>
			Club:
			<b>
				<?php print "<a href=\"viewclub.php?club_id=$event["eclub"]\">
				$event["clubname"]</a>"
			?>
			</b>
			<br>
			Area:
			<b>
				<?php print $event["areaname"]?>
			</b>
			<br>
			Type:
			<b>
				<?php print $event["typename"]?>
			</b>
		</p>
		Description:
		<br>
		<?php print $event["edescription"]?>
	</p>
</body>
</html>