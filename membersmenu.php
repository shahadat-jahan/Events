<?php
include("dblib.php");
include("clublib.php");
?>
<html>
<head>
	<title>Welcome</title>
</head>

<body>
<?php
$club_row = checkUser();
checkClubData($club_row);
include("publicnav.php");
?>
	<h2>Members menu</h2>
	<a href="updateclub.php">Review your club details</a><br>
	<a href="reviewevents.php">Review your events</a><br>
	<a href="updateevent.php">New event</a><br>
</body>
</html>