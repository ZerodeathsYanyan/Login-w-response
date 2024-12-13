<?php 
require_once 'core/handleForms.php';
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$Thestudent = student($pdo, $_GET['student_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Are you sure you want to delete this student?</h1>
    <div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1;height: 500px;">
        <h2>First Name: <?php echo htmlspecialchars($Thestudent['namefirst']); ?></h2>
        <h2>Last Name: <?php echo htmlspecialchars($Thestudent['namelast']); ?></h2>
        <h2>School Year: <?php echo htmlspecialchars($Thestudent['schoolyear']); ?></h2>
        <h2>Address: <?php echo htmlspecialchars($Thestudent['address']); ?></h2>
        <h2>Department: <?php echo htmlspecialchars($Thestudent['department']); ?></h2>
        <h2>Contact Number: <?php echo htmlspecialchars($Thestudent['contact_number']); ?></h2>

        <div class="deleteBtn" style="float: right; margin-right: 10px;">
		  <form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">

                <input type="hidden" name="student_id" value="<?php echo $_GET['student_id']; ?>">
                <input type="submit" name="deleteUserBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
            </form>            
        </div>    
    </div>
</body>
</html>
