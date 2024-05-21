<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    mysqli_query($link, "DELETE FROM student WHERE student_number=$id");

    $_SESSION['success_msg'] = "Student deleted successfully!";
    echo '<script type="text/javascript">window.location="all-student-info.php";</script>';
    exit();
}
?>