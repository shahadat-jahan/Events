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
$club_row= checkUser();
checkClubData($club_row);
function writeEvents()
	{
		global $club_row;
		$events= getEvents($club_row["id"]);
		if(!$events)
		{
			print "You have no events in your schedule<p>";
			return;
		}
		print "<table border=1>\n";
		print "<td><b>Date</b></td>\n<td><b>Name</b></td>\n<td><b>&nbsp;</b></td\n>";

		foreach ($events as $row) {
			print "<tr>\n";
			print "<td>".date("j M Y H i", $row["edate"])."</td>\n";
			print "<td><a href='updateevent.php?event_id=".$row["id"]."'>".
			html($row["ename"])."</a></td>\n";
			print "<td><a href='reviewevents.php?event_id=".$row["id"]."&actionflag=deleteEvent'>delete</a><br></td>";
			print "</tr>\n";
		}
		print "</table>\n";
	}
	$message="";
	if(isset ($actionflag)&&$actionflag=="deleteEvent"&& isset($event_id) )
	{
		deleteEvent($event_id);
		$message.="That event is now history!<br>";
	}
include("publicnav.php");
?>
	<h2>Review event schedule</h2>
	<?php
		if($message!="")
		{
			print "<b>$message</b>";
		}

		writeEvents();
	?>
	</body>
</html>