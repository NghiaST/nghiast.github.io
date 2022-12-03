<?php
	session_start();
	ini_set('session.gc-maxlifetime', 1*1*1);
	if (!isset($_SESSION['tuser'])) header("Location: login.php");
	else {
		$user['id'] = $_SESSION['tid'];
		$user['username'] = $_SESSION['tuser'];
		$user['password'] = $_SESSION['tpass'];
	}
