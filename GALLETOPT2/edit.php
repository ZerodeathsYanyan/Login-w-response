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
   <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
   <title>Document</title>
</head>
<body>
<?php $getUserByID = student($pdo, $_GET['student_id']); ?>

	<h1>Update Student</h1>
	<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">

	<input type="hidden" name="student_id" value="<?php echo $_GET['student_id']; ?>">
		<p>
			<label for="namefirst">First Name</label> 
			<input type="text" name="namefirst" value="<?php echo $getUserByID['namefirst']; ?>">
		</p>
		<p>
			<label for="namelast">Last Name</label> 
			<input type="text" name="namelast" value="<?php echo $getUserByID['namelast']; ?>">
		</p>
		<p>
			<label for="schoolyear">Schoolyear</label> 
			<input type="text" name="schoolyear" value="<?php echo $getUserByID['schoolyear']; ?>">
		</p>
		<p>
			<label for="address">Address</label> 
			<input type="text" name="address" value="<?php echo $getUserByID['address']; ?>">
		</p>
		<p>
			<label for="department">Department</label> 
			<input type="text" name="department" value="<?php echo $getUserByID['department']; ?>">
		</p>
		<p>
			<label for="contact_number">Contact Number</label> 
			<input type="text" name="contact_number" value="<?php echo $getUserByID['contact_number']; ?>">
			<input type="submit" value="Save" name="editStudent">
		</p>
	</form>
</body>
</html>