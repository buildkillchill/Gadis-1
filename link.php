<?php
	require 'settings.php';
	if(!isset($_GET['id']) || !isset($_GET['code']))
	{
		header('Location http://zenforic.com');
	}
	else
	{
		$SID = $_GET['id'];
		// TODO: Load these values from shared config
		$conn = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
		if($conn->connect_error) { die('DB Connection Failed: ' . $conn->connect_error); }
		$res = $conn->query("SELECT `id` FROM `link` WHERE `code`='".$_GET['code']."' AND `used`=FALSE");
		if($res->num_rows < 1)
		{
			die('Link Failed: Invalid link code');
		}
		$row = $res->fetch_assoc();
		$DID = $row["id"];
		$res = $conn->query("INSERT INTO `linked` (`sid`, `did`) VALUES (".$SID.",".$DID.") ON DUPLICATE KEY UPDATE `did`=".$DID.",`sid`=".$SID);
		if($res === TRUE)
		{
			$conn->query("UPDATE `link` SET `used`=TRUE WHERE `code`='".$_GET['code']."'");
		}
		else { die('Link Failed: ' . $conn->error); }
		$conn->close();
	}
?>
