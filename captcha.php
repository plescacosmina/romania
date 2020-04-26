<?php
	session_start();
	include("./phptextClass.php");	

	$phptextObj = new phptextClass();
	$phptextObj->phpcaptcha('#162453', '#red', 120, 40, 10, 25);