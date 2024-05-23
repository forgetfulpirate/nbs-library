<?php 
  session_start();
    include 'inc/connection.php';
    $id = $_GET["id"];

    

    // Check if the account is already activated or deactivated
    $fine_result = mysqli_query($link, "SELECT * FROM finezone WHERE id = $id");

    if (mysqli_num_rows($fine_result) > 0) {
        // If the ID corresponds to a student
        $fine_data = mysqli_fetch_assoc($fine_result);
        if ($fine_data['status'] == 'yes') {
            $_SESSION['error_msg'] = "The user already paid or 0 fine";
            echo "<script>window.location='fine.php';</script>";
        } elseif ($fine_data['status'] == 'no') {
            mysqli_query($link, "UPDATE finezone SET status='yes' WHERE id = $id");
            $_SESSION['success_msg'] = "The user paid successfully";
            echo "<script>window.location='fine.php';</script>";
            exit();
        }
    } 
?>
