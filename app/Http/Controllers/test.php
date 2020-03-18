<?php
$username = "unnamed48";
$password = "dimas123";
$message = escapeshellcmd('python login.py '.$username.' '.$password);
		$out = shell_exec($message);
		$json = json_decode($out, true);
		echo $json['status'];
?>