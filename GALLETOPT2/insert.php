<?php require_once 'core/handleForms.php';
require_once 'core/models.php'; 
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
   <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
	<h1>Insert a new student</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstname">First Name</label> 
			<input type="text" name="namefirst">
		</p>
		<p>
			<label for="lastname">Last Name</label> 
			<input type="text" name="namelast">
		</p>
		<p>
			<label for="firstname">School year</label> 
			<input type="text" name="schoolyear">
		</p>
		<p>
			<label for="firstname">Address</label> 
			<input type="text" name="address">
		</p>
		<p>
			<label for="firstname">Department</label> 
			<input type="text" name="department">
		</p>
		<p>
			<label for="firstname">Contact number</label> 
			<input type="text" name="contact_number">
			<input type="submit" name="insertBtn" value="Insert">
		</p>

	</form>
</body>
</html>