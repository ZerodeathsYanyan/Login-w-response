<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

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
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>

	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20">
			<tr>
				<th>Activity Log ID</th>
				<th>Operation</th>
            <th>Student ID</th>
				<th>First Name</th>
            <th>Last Name</th>
            <th>School Year</th>
				<th>Address</th>
            <th>Department</th>
				<th>Contact Number</th>
				<th>Username</th>
				<th>Date Added</th>
			</tr>
			<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
			<?php foreach ($getAllActivityLogs as $row) { ?>
			<tr>
				<td><?php echo $row['activity_log_id']; ?></td>
				<td><?php echo $row['operation']; ?></td>
				<td><?php echo $row['student_id']; ?></td>
				<td><?php echo $row['namefirst']; ?></td>
            <td><?php echo $row['namelast']; ?></td>
				<td><?php echo $row['schoolyear']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['department']; ?></td>
				<td><?php echo $row['contact_number']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
			</tr>
			<?php } ?>
		</table>
</body>
</html>