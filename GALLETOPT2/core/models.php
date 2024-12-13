<?php  

require_once 'dbConfig.php';

function alltitser($pdo) {
	$sql = "SELECT * FROM titser 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function titser($pdo, $id) {
	$sql = "SELECT * from titser WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function allstudents($pdo) {
	$sql = "SELECT * FROM students 
			ORDER BY namefirst ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function student($pdo, $student_id) {
	$sql = "SELECT * from students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function Findstudent($pdo, $find) {
	
	$sql = "SELECT * FROM students WHERE 
			CONCAT(student_id, namefirst, namelast, schoolyear, address,
				department, contact_number) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$find."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertNewStudent($pdo, $namefirst, $namelast, $schoolyear, 
	$address, $department, $contact_number, $added_by) {
		$response = array();
	$sql = "INSERT INTO students 
			(
				namefirst,
				namelast,
				schoolyear,
				address,
				department,
				contact_number,
				added_by
			)
			VALUES (?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$namefirst, $namelast, $schoolyear, 
	$address, $department, $contact_number, $added_by
	]);
	

	if ($executeQuery) {
		$findInsertedItemSQL = "SELECT * FROM students ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getStudentID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getStudentID['student_id'], 
			$getStudentID['namefirst'], $getStudentID['namelast'], 
			$getStudentID['schoolyear'], $getStudentID['address'], $getStudentID['department'], $getStudentID['contact_number'],  $_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"Student added successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;

}

function editStudent($pdo, $namefirst, $namelast, $schoolyear, 
$address, $department, $contact_number, $last_updated, $last_updated_by, $student_id) {
	$response = array();
	$sql = "UPDATE students
				SET namefirst = ?,
					namelast = ?,
					schoolyear = ?,
					address = ?,
					department = ?,
					contact_number = ?,
					last_updated = ?,
					last_updated_by = ?
				WHERE student_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$Update = $stmt->execute([$namefirst, $namelast, $schoolyear, 
	$address, $department, $contact_number, $last_updated, $last_updated_by, $student_id]);


	if ($Update) {

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getStudentID['student_id'], 
		$getStudentID['namefirst'], $getStudentID['namelast'], 
		$getStudentID['schoolyear'], $getStudentID['address'], $getStudentID['department'], $getStudentID['contact_number'],  $_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Updated the student successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}
function getStudentById($pdo, $student_id) {
	$sql = "SELECT * FROM students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$student_id]);
	return $stmt->fetch(); // Fetch student details after the update
}


function deleteStudent($pdo, $student_id) {
	$response = array();
	$sql = "SELECT * FROM students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$student_id]);
	$getStudentByID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getStudentID['student_id'], 
	$getStudentID['namefirst'], $getStudentID['namelast'], 
	$getStudentID['schoolyear'], $getStudentID['address'], $getStudentID['department'], $getStudentID['contact_number'],  $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM students WHERE student_id = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$student_id]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the student successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}


//new code:
function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM titser WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO titser (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}


function insertAnActivityLog($pdo, $operation, $student_id, $namefirst, $namelast, 
		$schoolyear, $address, $department, $contact_number, $username) {

	$sql = "INSERT INTO activity_logs (operation, student_id, namefirst, namelast, 
		schoolyear, address, department, contact_number, username) VALUES(?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $student_id, $namefirst, $namelast, 
	$schoolyear, $address, $department, $contact_number, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

?>