<?php
include("db.php");

$data = json_decode(file_get_contents("php://input"), true);

$teacher_id = $_SESSION['user_id'];
$date = date("Y-m-d");

foreach ($data as $row) {

    // CHECK IF RECORD EXISTS
    $check = mysqli_prepare($conn,
        "SELECT attendance_id FROM attendance 
         WHERE student_id=? AND attendance_date=?"
    );

    mysqli_stmt_bind_param($check, "is", $row['student_id'], $date);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {

        // UPDATE EXISTING RECORD
        $update = mysqli_prepare($conn,
            "UPDATE attendance 
             SET status=?, marked_by=? 
             WHERE student_id=? AND attendance_date=?"
        );

        mysqli_stmt_bind_param(
            $update,
            "siss",
            $row['status'],
            $teacher_id,
            $row['student_id'],
            $date
        );

        mysqli_stmt_execute($update);

    } else {

        // INSERT NEW RECORD
        $insert = mysqli_prepare($conn,
            "INSERT INTO attendance(student_id, attendance_date, status, marked_by)
             VALUES (?,?,?,?)"
        );

        mysqli_stmt_bind_param(
            $insert,
            "issi",
            $row['student_id'],
            $date,
            $row['status'],
            $teacher_id
        );

        mysqli_stmt_execute($insert);
    }
}

echo "Attendance saved successfully!";
?>