<?php
	require 'settings.php';
	$SID = $_GET['id'];
	$TIME = $_GET['hours'];
	$RANK = $_GET['rank'];
	$DONATED = (strpos($RANK, "Donator") !== FALSE ? "TRUE" : "FALSE");
	$conn = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
	if ($conn->connect_error) { die(); }
	$res = $conn->query("SELECT * FROM `linked` WHERE `sid`=".$SID);
	if($res->num_rows > 0)
	{
		$account = $res->fetch_assoc();
		$ID = $account['id'];
		$ranks = $conn->query("SELECT `id` FROM `ranks` WHERE `name`='".$RANK."'");
		$rank = "";
		if($ranks->num_rows > 0)
		{
			$ranklist = $ranks->fetch_assoc();
			$rank = $ranklist['id'];
			$sql = "UPDATE `linked` SET `donated`=".$DONATED.",`hours`=".$TIME.",`rank`=".$rank." WHERE `id`=".$ID;
			$conn->query($sql);
		}
	}
?>
