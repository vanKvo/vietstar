<?php
//Start session
session_start();

//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Connect to mysql server. Standard: host, username, password, database, port
$conn = mysqli_connect('localhost', 'root', 'root', 'vietstar_shipping');
if (!$conn) {
	die('Failed to connect to server: ' . mysqli_error($conn));
}


//Function to sanitize values received from the form. Prevents SQL injection
function clean($str, $conn) // Added $conn as a parameter
{
	$str = trim($str);
	// magic_quotes is gone, so we just use the modern escape function
	return mysqli_real_escape_string($conn, $str);
}

//Sanitize the POST values
$login = clean($_POST['username'], $conn);
$password = clean($_POST['password'], $conn);
$hash = hash('sha1', $password);

//Input Validations
if ($login == '') {
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if ($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//If there are input validations, redirect back to the login form
if ($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: index.php");
	exit();
}

//Create query
$query = "SELECT * FROM user WHERE username='$login' AND password='$hash'";
$result = mysqli_query($conn, $query);

//Check whether the query was successful or not
if ($result) {
	if (mysqli_num_rows($result) > 0) {
		echo 'Login Successful';
		session_regenerate_id();
		$member = mysqli_fetch_assoc($result);
		$_SESSION['SESS_MEMBER_ID'] = $member['id'];
		$_SESSION['SESS_NAME'] = $member['name'];
		$_SESSION['SESS_POSITION'] = $member['position'];
		session_write_close();
		header("location: main/index.php");
		exit();
	} else {
		//Login failed
		header("location: index.php");
		exit();
	}
} else {
	die("Query failed");
}
?>