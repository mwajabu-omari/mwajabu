<?php 
if(empty($title)){
    $title = "Home";
}
?>
<!DOCTYPE html>
<html>
<head>
<title> <?php echo $title; ?> </title>
<link rel="stylesheet" href="styles/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<!-- TOP TITLE BAR -->
<div class="top-header">
    <h2>Attendance System</h2>
</div>

<!-- NAVBAR -->
<div class="navbar">

    <?php if($_SESSION['role'] == 'admin'){ ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="create_teacher.php">Create Teacher</a>
    <?php } ?>

    <?php if($_SESSION['role'] == 'teacher'){ ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_student.php">Add Student</a>
        <a href="students.php">Students</a>
        <a href="mark_attendance.php">Attendance</a>
        <a href="report.php">Reports</a>
    <?php } ?>

    <a href="logout.php">Logout</a>

</div>

<div class="container">