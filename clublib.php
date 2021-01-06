<?php

session_start();
//session_register("session");

function cleanMemberSession($id, $login){
	$_SESSION["id"]=$id;
	$_SESSION["login"]=$login;

	$_SESSION["logged_in"] ="true";
	
	//session_destroy();	
		//header('Location: http://localhost/events/index.php');
}

function checkUser(){
	
	$_SESSION["logged_in"] = false;
	$club_obj = getRow ("clubs", "id", $_SESSION["id"]);
	if($club_obj->num_rows>0){
		$club_data = $club_obj->fetch_assoc();
		if($club_data["login"] == $_SESSION["login"]){
			$_SESSION["logged_in"] = true;
			return $club_data;
		}
	} 
	else{
		header("Location: http://localhost/events/login.php");
	}

		//|| $club_row["login"] != $session["login"] || $club_row["password"] != $session["password"]) {
		
		//exit;
	}
	
function checkClubData($clubarray)
	{
		if(!isset($clubarray["name"]))
		{
			header("Location: http://localhost/events/updateclub.php");
			exit;
		}
	}

function html($str)
	{
		if(is_array($str))
		{
			foreach ($str as $key=>$val)
				$str["$key"]=htmlstr($val);
			return $str;
		}
		return htmlstr($str);
	}

function htmlstr($str)
	{
		$str=htmlspecialchars($str);
		$str=nl2br($str);
		return $str;
	}

?>