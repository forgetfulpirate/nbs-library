<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }

    include 'inc/connection.php';
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        mysqli_query($link, "delete from return_history where id=$id");
        $_SESSION['success_message'] = "History deleted successfully";
        ?>
        <script type="text/javascript">
          
            window.location="return-history.php";
        </script>
        <?php
    }



?>