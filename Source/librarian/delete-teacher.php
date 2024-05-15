<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    mysqli_query($link, "DELETE FROM teacher WHERE id_number=$id");

    $_SESSION['success_msg'] = "Teacher deleted successfully!";
    echo '<script type="text/javascript">window.location="all-teacher-info.php";</script>';
    exit();
}
?>