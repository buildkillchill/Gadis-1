<?php
	require 'settings.php';
	$server = $_GET['serv'];
	$socket=socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ( !$socket ) { die(); }
	if ( !socket_connect($socket, $REMOTE_HOST, $REMOTE_PORT) ) { die(); }
	$cmd = "noadmin ".$server;
	socket_send($socket, $cmd, strlen($cmd), null);
	socket_close($socket);
?>
