<?php

$server = "localhost";
$db_name = "events";
$db_user = "root";
$db_pass = "123456";

// Create connection
$conn = new mysqli($server, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getRow ($table, $fnm, $fval)
	{
	global $conn;
	$sql = "SELECT * FROM $table WHERE $fnm='$fval'";
	$result = $conn->query($sql);
	if ($result) {
		
		return $result;
	}
	else {
		die("getRow fatal error: ".$conn->error);
	}
}

function newUser ($login, $password)
	{
		global $conn;
	
	$sql = "INSERT INTO clubs (login, password)
	VALUES ('$login', md5($password))";

	if ($conn->query($sql) === TRUE) {
	  return $conn->insert_id;
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close(); 
	}

function writeOptionList($table, $id, $fld)
	{
		global $conn;
		$sql = "SELECT * FROM $table ORDER BY $fld asc";
		$result = $conn->query($sql);
		if(!$result)
		{
			echo "failed to open $table<p>";
			return false;
		}
		//If data exist
		
		while ($a_row = $result->fetch_assoc())
		{
		
			if($id == $a_row["id"])
				$selected = "SELECTED";
			else
				$selected = "";

			echo "<option $selected value='".$a_row["id"]."'>".$a_row[$fld]."</option>";
		}
	}

function updateOrg($id, $name,$type, $area, $email, $description)
	{
		global $conn;
		$sql = "UPDATE `clubs` SET `name`='$name',`type`='$type',`area`='$area',`email`='$email',`description`='$description' WHERE id='$id'";
		$result = $conn->query($sql);
		if ($result){
			return $result;
		}
		else{
			die("updateOrg update error: ".$conn->error);
		}
	}	

function checkPassword($login, $password)
	{
		global $conn;
		$sql = "SELECT id,login,password FROM clubs WHERE login='".$login."' AND password='".md5($password)."' limit 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			// print_r($row);
        	return $row;
    		}
			// return true;// echo "User OK";
		}else {
		return false;// echo "User NO";
	}

//user_info function decaleration
//argument user_id
	}

function insertEvent($name, $venue, $area, $type, $address, $zip, $description, $club_id, $timestamp, $event_id)
	{
		global $conn;
		if(!$event_id)
		{
			$sql = "INSERT INTO events (ename, evenue, area, type, eaddress, ezip, edescription, eclub, edate)
			VALUES ('$name', '$venue', '$area', '$type', '$address', '$zip', '$description', '$club_id', '$timestamp')";
		}
		else{
			$sql = "UPDATE events SET ename='$name', evenue='$venue', area='$area', type='$type', eaddress='$address', ezip='$zip', edescription='$description', eclub='$club_id', edate='$timestamp' WHERE id='$event_id'";
		}
		$result = $conn->query($sql);
		if($result){
			return $result;	
		}
		else{
			die("insertEvent error: ".$conn->error);
		}
	}

function deleteEvent($id)
	{
		global $conn;
		$sql = "DELETE FROM events WHERE id='$id'";
			
		$result=$conn->query($sql);
		if($result){
			return $result;
		}
		else{
		die("deleteEvent fatal error: ".$conn->error);
		}
	}

function getEvents($club_id=0, $range=0, $area=0, $type=0)
	{
		global $conn;
		$sql = "SELECT clubs.name, events.*, areas.area as areaname, types.type as typename";
		$sql.= "FROM clubs, events, areas, types WHERE ";
		$sql.= "clubs.id=events.eclub AND events.area=areas.id AND events.type=types.id";
		if(!empty($club_id) && $club_id !="ANY")
			$sql.= "AND events.eclub='$club_id'";
		if(!empty($range))
			//$sql.=" AND events.edate >='$range["0"]' AND events.edate<= '$range["1"]'";
		if(!empty($area) && $area !="ANY")
			$sql.= "AND events.area='$area'";
		if(!empty($type) && $type !="ANY")
			$sql.= "AND events.type='$type'";
		$sql.= "ORDER BY events.edate";
		$result=$conn->query($sql);
		if(!$result)
			die("getIDevents fatal error: ".$conn->error);
		$ret=array();
		while ($row=$result->fetch_assoc())
			array_push($ret, $row);
		return $ret;
	}

function getClubs($area="", $type="")
	{
		global $conn;
		$sql="SELECT clubs.*, areas.area as areaname, types.type as typename";
		$sql.= "FROM clubs, events, areas, types WHERE ";
		$sql.= "clubs.area=areas.id AND clubs.type=types.id";
		if($area !="ANY"&& !empty($area))
			$sql.="AND clubs.area=$area";
		if($type !="ANY"&& !empty($type))
			$sql.="AND clubs.type=$type";
		$sql.= "ORDER BY clubs.area, clubs.type, clubs.name";
		$result=$conn->query($sql);
		if(!$result)
			die("getIDevents fatal error: ".$conn->error);
		$ret=array();
		while ($row=$result->fetch_assoc())
			array_push($ret, $row);
		return $ret;
	}

function getClubJoined($id)
	{
		global $conn;
		$sql="SELECT clubs.*, areas.area as areaname, types.type as typename";
		$sql.= "FROM clubs, events, areas, types WHERE ";
		$sql.= "clubs.area=areas.id AND clubs.type=types.id AND clubs.id='$id'";
		$result=$conn->query($sql);
		if($result){
			return $result;
		}
		else{
		die("getClubJoined fatal error: ".$conn->error);
		}
	}

function getEvent($event_id)
	{
		global $conn;
		$sql="SELECT clubs.name as clubname, events.*,areas.area as areaname, types.type as typename";
		$sql.= "FROM clubs, events, areas, types WHERE ";
		$sql.= "clubs.id=events.eclub AND events.area=areas.id AND events.type=types.id AND events.id='$event_id'";
		$result=$conn->query($sql);
		if($result){
			return $result;
		}
		else{
		die("getEvent fatal error: ".$conn->error);
		}
	}	
?>