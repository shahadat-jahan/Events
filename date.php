<?php

function writeDayOptions($d)
	{
		$d_array= getDate($d);
		for ($x=1; $x<=31; $x++)
		{
			echo "<OPTION VALUE=\"$x\"";
			echo (($d_array["mday"]== $x)?"SELECTED":"");
			echo ">$x\n";
		}
	}

function writeMonthOptions($d)
	{
		$d_array= getDate($d);
		$months= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		foreach ($months as $key => $value) 
		{
			echo "<OPTION VALUE=\"".($key+1)."\"";
			echo (($d_array["mon"]==($key+1))?"SELECTED":"");
			echo ">$value\n";
		}
	}

function writeYearOptions($d)
	{
		$d_array= getData($d);
		$now_array= getDate(time());
		for($x=$now_array["year"]; $x<=($now_array["year"]+5);$x++)
		{
			echo "<OPTION VALUE=\"$x\"";
			echo (($d_array["year"]==$x)?"SELECTED":"");
			echo ">$x\n";
		}
	}

function writeHourOptions($d)
	{
		$d_array= getDate($d);
		for($x=0; $x<24; $x++)
		{
			echo "<OPTION VALUE=\"$x\"";
			echo (($d_array["hours"]==$x)?"SELECTED":"");
			echo ">".sprintf("%02d",$x)."\n";
		}
	}

function writeMinuteOptions($d)
	{
		$d_array= getDate($d);
		for($x=0; $x<=59; $x++)
		{
			echo "<OPTION VALUE=\"$x\"";
			echo (($d_array["minutes"]==$x)?"SELECTED":"");
			echo ">".sprintf("%02d",$x)."\n";
		}
	}

function getDateRange($mon, $year)
	{
		$start=mktime(0, 0, 0, $mon, 1, $year);
		$end=mktime(0, 0, 0, $mon+1, 1, $year);
		$end--;
		return array($start, $end);
	}	
?>