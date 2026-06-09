<?php
$title = "Reports";
include("db.php");
include("header.php");

$class = "";
$date = "";

$query = "SELECT a.*, s.full_name, s.class
          FROM attendance a
          JOIN students s ON a.student_id = s.student_id
          WHERE 1=1";

if (isset($_GET['filter'])) {

    $class = $_GET['class'];
    $date = $_GET['date'];

    if (!empty($class)) {
        $query .= " AND s.class='$class'";
    }

    if (!empty($date)) {
        $query .= " AND a.attendance_date='$date'";
    }
}

$result = mysqli_query($conn, $query);
?>

<h2>Attendance Report</h2>

<form method="GET">
    <div class="report-filters">

    <input type="text"
           name="class"
           placeholder="Class">

    <input type="date"
           name="date">

    <button name="filter">
        Filter
    </button>

</div>
</form>

<br>

<table>
<tr>
    <th>SN</th>
    <th>Student</th>
    <th>Class</th>
    <th>Date</th>
    <th>Status</th>
</tr>

<?php $count = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td> <?= $count++ ?> </td>
    <td><?= $row['full_name'] ?></td>
    <td><?= $row['class'] ?></td>
    <td><?= $row['attendance_date'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>