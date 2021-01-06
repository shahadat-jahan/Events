<p>
<a href="index.php">Home</a> |
<a href="viewclubs.php">Browse clubs</a> |
<a href="viewevents.php">Browse events</a> |
<a href="join.php">Join</a> |
<a href="login.php">Login</a>
</p>
<?php
	if (isset($_SESSION["logged_in"])) {
		?>
		<p>
			<a href="updateclub.php">Your details</a> |
			<a href="reviewevents.php">Your events</a> |
			<a href="updateevent.php">New event</a> |
			<a href="membersmenu.php">Members home</a> |
		</p>
		<?php
	}
?>