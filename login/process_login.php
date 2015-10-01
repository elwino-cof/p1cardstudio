<?php
session_start();

// Verify email
$pos = stripos($_POST['email'], "@capitalone.com");
if ($pos === false || $pos == null) {
	$_SESSION["login"] = NULL;
	header("Location: https://designedbypirates.com/login/"); /* Redirect browser */
	exit;
}

// Verify password
if ($_POST["password"] == "ChangeForGood") {
	$_SESSION["login"] = "yes";
	$_SESSION["email"] = $_POST['email'];
// 	header("Location: https://designedbypirates.com/pilot/"); /* Redirect browser */
	header("Location: https://designedbypirates.com/gestalt/"); /* Redirect browser */
	exit;
} else {
	$_SESSION["login"] = NULL;
	header("Location: https://designedbypirates.com/login/"); /* Redirect browser */
	exit;
}
?>