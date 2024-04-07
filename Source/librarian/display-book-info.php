<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'sinfo';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="inc/css/tabs.css">
</head>
<body>
    <div class="tabs-controller">
        <div class="tabs-wrapper">

            <div class="tab-buttons">
                <div class="button active">Normal view</div>
                <div class="button">MARC view</div>
                <div class="button">ISBD view</div>
            </div>
            
            <div class="tab-contents">
                <!-- NORMAL VIEW CONTENT -->
                <div class="content active">
                    Content for normal view
                </div>
                <!-- END NORMAL VIEW CONTENT -->

                 <!-- MARC VIEW CONTENT -->
                <div class="content">
                    Content for MARC view
                </div>
                <!-- END MARC VIEW CONTENT -->
                
                <!-- ISBD VIEW CONTENT -->
                <div class="content">Content for ISBD view</div>
                <!-- END ISBD VIEW CONTENT -->
            </div>

        </div>
    </div>

    <script src="inc/js/tabs.js"></script>
</body>
</html>
