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
        mysqli_query($link, "delete from book_module where accession_number=$id");
       

        ?>
        <script type="text/javascript">
            window.location="display-progress.php";
        </script>   
        <?php
     
    }

?>