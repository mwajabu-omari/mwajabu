<?php
include("db.php");

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn,
        "SELECT user_id, full_name, password, role FROM users WHERE username=?"
    );

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == "admin") {
            header("Location: dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "Invalid login!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="login-page">

<div class="login-container">

    <div class="login-card">

        <div class="login-header">
            <h1>Student Attendance System</h1>
            <p>Login to continue</p>
        </div>

        <?php if(!empty($message)){ ?>
            <div class="alert-error">
                <?= $message ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Enter username"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    required
                >
            </div>

            <button type="submit" name="login" class="login-btn">
                Login
            </button>

        </form>

        <div class="login-footer">
            Student Attendance Management System
        </div>

    </div>

</div>

</body>
</html>