<?php
$title = "Add teachers";
include("db.php");
include("header.php");

if (isset($_POST['create'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "teacher";

    $stmt = mysqli_prepare($conn,
        "INSERT INTO users(full_name, username, password, role) VALUES (?,?,?,?)"
    );

    mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $password, $role);
    mysqli_stmt_execute($stmt);

    echo "Teacher created!";
}
?>

<h2>Create Teacher</h2>
<form method="POST">
    <input name="name" placeholder="Full Name">
    <input name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button name="create">Create</button>
</form>

</body>
</html>