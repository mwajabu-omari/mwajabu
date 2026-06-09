<?php
$title = "Students";
include("db.php");
include("header.php");

# DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

     $stmt1 = mysqli_prepare($conn, "DELETE FROM Attendance WHERE student_id=?");
    mysqli_stmt_bind_param($stmt1, "i", $id);
    if(mysqli_stmt_execute($stmt1)){
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE student_id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    }
}

# UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $class = $_POST['class'];

    $stmt = mysqli_prepare($conn,
        "UPDATE students SET full_name=?, class=? WHERE student_id=?"
    );

    mysqli_stmt_bind_param($stmt, "ssi", $name, $class, $id);
    mysqli_stmt_execute($stmt);
    header("Location: students.php");
}

# FETCH FOR EDIT
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $res = mysqli_query($conn, "SELECT * FROM students WHERE student_id=$id");
    $editData = mysqli_fetch_assoc($res);
}
?>

<h2>Students</h2>

<!-- ADD / EDIT FORM -->
<div id="formBox" style="display:none;">

    <form method="POST">

        <input type="hidden" name="id" value="<?= $editData['student_id'] ?? '' ?>">

        <input name="name"
               id="nameField"
               value="<?= $editData['full_name'] ?? '' ?>"
               placeholder="Student Name" required>

        <input name="class"
               id="classField"
               value="<?= $editData['class'] ?? '' ?>"
               placeholder="Class" required>

        <?php if ($editData) { ?>
            <button name="update">Update</button>
        <?php } ?>

    </form>

    <!-- RETURN BUTTON (ONLY WHEN EDITING) -->
    <div id="viewBtn" style="display:none; margin-top:10px;">
        <a href="students.php" class="dashboard-btn">
            Return to Students
        </a>
    </div>

</div>

<br>

<div id="tableBox">
<table>
<tr>
    <th>SN</th>
    <th>Name</th>
    <th>Class</th>
    <th>Actions</th>
</tr>

<?php
$count = 1;
$res = mysqli_query($conn, "SELECT * FROM students");
while ($row = mysqli_fetch_assoc($res)) {
?>
<tr>
    <td> <?= $count++ ?> </td>
    <td><?= $row['full_name'] ?></td>
    <td><?= $row['class'] ?></td>
    <td>
        <div class="action-links">
            <a href="?edit=<?= $row['student_id'] ?>">Edit</a>
            <a href="?delete=<?= $row['student_id'] ?>"
               onclick="return confirm('Delete student?')">
               Delete
            </a>
        </div>
    </td>
</tr>
<?php } ?>
</table>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function () {

    const urlParams = new URLSearchParams(window.location.search);
    const isEdit = urlParams.has("edit");

    const formBox = document.getElementById("formBox");
    const tableBox = document.getElementById("tableBox");
    const viewBtn = document.getElementById("viewBtn");

    if (isEdit) {
        formBox.style.display = "block";
        tableBox.style.display = "none";
        viewBtn.style.display = "block";
    } else {
        formBox.style.display = "none";
        tableBox.style.display = "block";
        viewBtn.style.display = "none";
    }

});
</script>
</body>
</html>