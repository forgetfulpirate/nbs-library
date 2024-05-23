<?php 
    session_start();
    include 'inc/connection.php';
    $id = $_GET["id"];

    $fine_result = mysqli_query($link, "SELECT * FROM finezone WHERE id = $id");

    if (mysqli_num_rows($fine_result) > 0) {
     
        $fine_data = mysqli_fetch_assoc($fine_result);
        if ($fine_data['fine'] == 0) {
            $_SESSION['error_msg'] = "The user fine is already set as paid because the fine amount is 0.";
            echo "<script>window.location='fine.php';</script>";
        } elseif ($fine_data['status'] == 'no') {
            $_SESSION['error_msg'] = "The user fine is already set as not paid.";
            echo "<script>window.location='fine.php';</script>";
        } elseif ($fine_data['status'] == 'yes') {
            mysqli_query($link, "UPDATE finezone SET status='no' WHERE id = $id");
            $_SESSION['success_msg'] = "The user fine set as not paid successfully!";
            echo "<script>window.location='fine.php';</script>";
        }
    } 
?>
