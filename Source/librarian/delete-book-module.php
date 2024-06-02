<?php
session_start();

if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare the SQL query
    $query = "DELETE FROM book_module WHERE accession_number = ?";
    $stmt = mysqli_prepare($link, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Deletion successful, redirect to display-book-module.php
        ?>
        <script type="text/javascript">
            window.location = "display-book-module.php";
        </script>
        <?php
    } else {
        // Deletion failed, handle the error
        echo "Error: Unable to delete the book module.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
