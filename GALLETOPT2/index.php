<?php 
require_once 'core/dbConfig.php'; 
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
<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
    <input type="text" name="find" placeholder="Search here">
    <div style="display: inline-flex; gap: 10px;">
        <input type="submit" name="searchBtn" value="Search" style="padding: 10px; font-size: 1em;">
        <a href="index.php" style="text-decoration: none;">
            <button type="button">
                Clear Search
            </button>
        </a>
        <a href="insert.php" style="text-decoration: none;">
            <button type="button">
                Insert New Students
            </button>
        </a>
		  <a href="core/handleForms.php?logoutUserBtn=1">Logout</a>
    </div>
</form>


<div class="tableClass">
		<table style="width: 100%;" cellpadding="20"> 
			<tr>
				<th>Student ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>School Year</th>
				<th>Address</th>
				<th>Department</th>
				<th>Contact Number</th>
				<th>Date Added</th>
				<th>Added By</th>
				<th>Last Updated</th>
				<th>Last Updated By</th>
				<th>Actions</th>
			</tr>
			<?php if (!isset($_GET['searchBtn'])) { ?>
				<?php $getAllBranches = allstudents($pdo); ?>
				<?php foreach ($getAllBranches as $row) { ?>
				<tr>
					<td><?php echo $row['student_id']; ?></td>
					<td><?php echo $row['namefirst']; ?></td>
					<td><?php echo $row['namelast']; ?></td>
					<td><?php echo $row['schoolyear']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['department']; ?></td>
					<td><?php echo $row['contact_number']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="edit.php?student_id=<?php echo $row['student_id']; ?>">Update</a>
						<a href="delete.php?student_id=<?php echo $row['student_id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<?php $getAllBranchesBySearch = Findstudent($pdo, $_GET['find']); ?>
				<?php foreach ($getAllBranchesBySearch as $row) { ?>
				<tr>
					<td><?php echo $row['student_id']; ?></td>
					<td><?php echo $row['namefirst']; ?></td>
					<td><?php echo $row['namelast']; ?></td>
					<td><?php echo $row['schoolyear']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['department']; ?></td>
					<td><?php echo $row['contact_number']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="edit.php?student_id=<?php echo $row['student_id']; ?>">Update</a>
						<a href="delete.php?student_id=<?php echo $row['student_id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
</body>
</html>