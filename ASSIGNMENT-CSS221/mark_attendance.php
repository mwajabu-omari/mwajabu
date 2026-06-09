<?php
$title = "Attendance";
include("db.php");
include("header.php");

$students = mysqli_query($conn, "SELECT * FROM students");
?>

<h2>Mark Attendance</h2>

<div class="attendance-actions">
    <button type="button" onclick="markAll('Present')">
        Mark All Present
    </button>

    <button type="button" onclick="markAll('Absent')">
        Mark All Absent
    </button>

    <button type="button" onclick="resetAll()">
        Reset
    </button>
</div>
<div id="msg"></div>
<div id="scrollTarget"></div>

<form id="attendanceForm">

<table>
<tr><th>SN</th><th>Name</th><th>Status</th></tr>

<?php $count = 1; while ($s = mysqli_fetch_assoc($students)) { ?>
<tr class="student-row">
    <td> <?= $count++ ?> </td>
    <td>
        <?= $s['full_name'] ?>
        <input type="hidden" class="student_id" value="<?= $s['student_id'] ?>">
    </td>
    <td>
        <select class="status">
            <option value="">-- Select --</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
    </td>
</tr>
<?php } ?>

</table>

<br>
<button type="submit">Save Attendance</button>
</form>

<script src="javascript/script.js"></script>


</body>
</html>