<?php
$title = "Add students";
include("db.php");
include("header.php");

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $class = $_POST['class'];

    $stmt = mysqli_prepare($conn,
        "INSERT INTO students(full_name, class) VALUES (?,?)"
    );

    mysqli_stmt_bind_param($stmt, "ss", $name, $class);
    mysqli_stmt_execute($stmt);

    echo "<p style='color:green'>Student added successfully</p>";
}
?>

<h2>Add Student</h2>

<form method="POST">
    <input name="name" placeholder="Student Name" required>
    <input name="class" placeholder="Class" required>
    <button name="add">Add Student</button>
</form>


</body>
</html>