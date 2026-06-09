<?php
include("db.php");
include("header.php");

/* ADMIN DATA */
$teacherCount = 0;

/* TEACHER DATA */
$totalStudents = 0;
$totalPresent = 0;
$totalAbsent = 0;

if ($_SESSION['role'] == 'admin') {

    $result = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM users
         WHERE role='teacher'"
    );

    $teacherCount = mysqli_fetch_assoc($result)['total'];

} else {

    $students = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM students"
    );

    $totalStudents = mysqli_fetch_assoc($students)['total'];

    $today = date("Y-m-d");

    $present = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         WHERE attendance_date='$today'
         AND status='Present'"
    );

    $totalPresent = mysqli_fetch_assoc($present)['total'];

    $absent = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         WHERE attendance_date='$today'
         AND status='Absent'"
    );

    $totalAbsent = mysqli_fetch_assoc($absent)['total'];
}
?>

<h1>Dashboard</h1>

<?php if($_SESSION['role'] == 'admin'){ ?>

    <div class="dashboard-cards">

        <div class="card">
            <h2><?= $teacherCount ?></h2>
            <p>Total Teachers</p>
        </div>

    </div>

<?php } ?>

<?php if($_SESSION['role'] == 'teacher'){ ?>

    <div class="dashboard-cards">

        <div class="card">
            <h2><?= $totalStudents ?></h2>
            <p>Total Students</p>
        </div>

        <div class="card">
            <h2><?= $totalPresent ?></h2>
            <p>Present Today</p>
        </div>

        <div class="card">
            <h2><?= $totalAbsent ?></h2>
            <p>Absent Today</p>
        </div>

    </div>

<?php } ?>

</body>
</html>