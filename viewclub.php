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
	if(!isset($club_id))
		header("Location:http://localhost/events/viewclubs.php");
	$club=getClubJoined($club_id);
	$club=html($club);
	if($club["mail"] !="")
		$club["mail"]="<a href=\"mailto:Club["mail"]\">$club["mail"]</a>";
	function displayEvents()
		{
			global $club_id;
			$events=getEvents($club_id);
			if(!$events)
			{
				print "No events yet for this club<p>";
				return;
			}
			print "<table border=1>\n";
			print "<td><b>Date</b></td>\n";
			print "<td><b>Event</b></td>\n";
			print "<td><b>Area</b></td>\n";
			print "<td><b>Type</b></td>\n";
			foreach ($events as $row)
			 {
				print "<tr>\n";
				print "<td>".date("j M Y H. i", $row["edate"])."</td>\n";
				print "<td><a href=\"viewevent.php?event_id=$row["id"]\">".
						html($row["ename"])."</a></td>\n";
				print "<td>$row["areaname"]</td>\n";
				print "<td>$row["typename"]</td>\n";
				print "</tr>\n";
			}
			print "</table>\n";
		}
	include("publicnav.php");
	?>
	<p>
		<h2>View club details</h2>
		<h4><?php print $club["name"] ?></h4>
		<p>
			Area: <b><?php print $club["areaname"] ?></b>
			<br>
			Type: <b><?php print $club["typename"] ?></b>
			<br>
			Mail: <b><?php print $club["mail"] ?></b>
		</p>
			Description:<br> 
			<b><?php print $club["descrption"] ?></b>
			<br>
			<?php 
			displayEvents();
			?>
		
	</p>
</body>
</html>