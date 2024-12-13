<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertBtn'])) {
	$namefirst = trim($_POST['namefirst']);
	$namelast = trim($_POST['namelast']);
	$schoolyear = trim($_POST['schoolyear']);
	$address = trim($_POST['address']);
	$department = trim($_POST['department']);
	$contact_number = trim($_POST['contact_number']);

	if (!empty($namefirst) && !empty($namelast) && !empty($schoolyear) && !empty($address) && !empty($department) && !empty($contact_number)) {
		$insertABranch = insertNewStudent($pdo, $namefirst, $namelast, $schoolyear, 
		$address, $department, $contact_number, $_SESSION['username']);
		$_SESSION['status'] =  $insertABranch['status']; 
		$_SESSION['message'] =  $insertABranch['message']; 
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../index.php");
	}
}


if (isset($_POST['editStudent'])) {
	$namefirst = $_POST['namefirst'];
	$namelast = $_POST['namelast'];
	$schoolyear = $_POST['schoolyear'];
	$address = $_POST['address'];
	$department = $_POST['department'];
	$contact_number = $_POST['contact_number'];
	$date = date('Y-m-d H:i:s');
	if (!empty($namefirst) && !empty($namelast) && !empty($schoolyear) && !empty($address) && !empty($department) && !empty($contact_number)) {

		$editStudent = editStudent($pdo, $namefirst, $namelast, $schoolyear, 
		$address, $department, $contact_number, $date, $_SESSION['username'], $_GET['student_id']);

		$_SESSION['message'] = $editStudent['message'];
		$_SESSION['status'] = $editStudent['status'];
		header("Location: ../index.php");
	}



}

if (isset($_POST['deleteUserBtn'])) {
	$studentid = $_GET['student_id'];

	if (!empty($studentid)) {
		$deletestudent = deleteStudent($pdo, $studentid);
		$_SESSION['message'] = $deletestudent['message'];
		$_SESSION['status'] = $deletestudent['status'];
		header("Location: ../index.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}



//new code:

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));
			$_SESSION['message'] = $insertQuery['message'];

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = '400';
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfUserExists($pdo, $username);
		$userIDFromDB = $loginQuery['userInfoArray']['user_id'];
		$usernameFromDB = $loginQuery['userInfoArray']['username'];
		$passwordFromDB = $loginQuery['userInfoArray']['password'];

		if (password_verify($password, $passwordFromDB)) {
			$_SESSION['user_id'] = $userIDFromDB;
			$_SESSION['username'] = $usernameFromDB;
			header("Location: ../index.php");
		}

		else {
			$_SESSION['message'] = "Username/password invalid";
			$_SESSION['status'] = "400";
			header("Location: ../login.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}

}
if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}