<?php 
    session_start();
    if (!isset($_SESSION["teacher"])) {
?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
<?php
    }
    $page = '';
    include 'inc/connection.php';
    include 'inc/header.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch book details based on ID
        $query = "SELECT * FROM book_module WHERE accession_number = $id";
        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $title_proper =  $row['title_proper'];
            $responsibility = $row['responsibility'];
            $preffered_title = $row['preffered_title'];
            $parallel_title = $row['parallel_title'];
            $main_creator = $row['main_creator'];
            $add_entry_creator = $row['add_entry_creator'];
            $contributors = $row['contributors'];
            $add_entry_corporate = $row['add_entry_corporate'];
            $place_of_publication = $row['place_of_publication'];
            $publisher = $row['publisher'];
            $date_of_publication = $row['date_of_publication'];
            $edition = $row['edition'];
            $extent_of_text = $row['extent_of_text'];
            $illustrations = $row['illustrations'];
            $dimension = $row['dimension'];
            $acc_materials = $row['acc_materials'];
            $series = $row['series'];
            $supp_content = $row['supp_content'];
            $ISBN = $row['ISBN'];
            $content_type = $row['content_type'];
            $media_type = $row['media_type'];
            $carrier_type = $row['carrier_type'];
            $filepath = $row['URL'];
            $subject_type = $row['subject_type'];
            $subject_info = $row['subject_info'];
            $call_number_type = $row['call_number_type'];
            $call_number_info = $row['call_number_info'];
            $accession_number = $row['accession_number'];
            $language = $row['language'];
            $library_location = $row['library_location'];
            $electronic_access = $row['electronic_access'];
            $imagepath = $row['book_image'];
            $entered_by = $row['entered_by'];
            $updated_by = $row['updated_by'];
            $date_entered = $row['date_entered'];
            $date_updated = $row['date_updated'];
            $quantity = $row['quantity'];
            $available = $row['available'];
            $location = $row['location'];
            $content_notes = $row['content_notes'];
            $abstract = $row['abstract'];
            $review = $row['review'];
          
        } else {
            echo "Book not found!";
            exit();
        }
    } else {
        echo "Book ID not provided!";
        exit();
    }
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
                    <div class="image-container">
                        <?php if(!empty($imagepath)): ?>
                            <img src="../../<?php echo $imagepath; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <h2>
                            <?php if(!empty($title_proper)): ?>
                                <span class="title"><?php echo $title_proper; ?></span>
                            <?php endif; ?>
                        </h2>
                    </div>
                    
                    <br>
                    <div class="normal-view">
                        <?php if(!empty($main_creator)): ?>
                            <span style="color:gray">By:</span>
                            <span class="normal-value"><?php echo $main_creator?></span>
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($contributors)): ?>
                            <span class="sub">Contributor(s):</span>
                            <span class="normal-value" style="color:gray"><?php echo $contributors?></span>
                        <?php endif; ?>
                    </div>

                    <div class="normal-view">
                        <?php if(!empty($place_of_publication) || !empty($publisher) || !empty($date_of_publication)): ?>
                            <span class="sub">Publisher:</span>
                            <span class="normal-value" style="color:gray"><?php echo $place_of_publication . ": " . $publisher . ", " . $date_of_publication?></span>
                        <?php endif; ?>
                    </div>

                    <div class="normal-view">
                        <?php if(!empty($edition)): ?>
                            <span class="sub">Edition:</span>
                            <span class="normal-value" style="color:gray"><?php echo $edition?></span>
                        <?php endif; ?>
                    </div>

                    <div class="normal-view">

                        <?php if(!empty($dimension) || !empty($illustrations)): ?>
                        
                            <?php if(!empty($dimension)): ?>
                                <span class="sub">Description:</span>
                                <span class="normal-value" style="color:gray"><?php echo $dimension . ": "; ?></span>
                            <?php endif; ?>

                            <?php if(!empty($illustrations)): ?>
                                <span class="sub">Illustration:</span>
                                <span class="normal-value" style="color:gray"><?php echo $illustrations; ?></span>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($content_type) || !empty($carrier_type)): ?>

                            <?php if(!empty($content_type)): ?>
                            <span  class="sub">Content Type: </span>
                            <span class="normal-value" style="color:gray"><?php echo $content_type?></span>
                            <?php endif; ?>

                            <?php if(!empty($carrier_type)): ?>
                            <span  class="sub">Carrier Type:</span>
                            <span class="normal-value" style="color:gray"><?php echo $carrier_type?></span>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>

                    <div class="normal-view">
                        <?php if(!empty($ISBN)): ?>
                            <span  class="sub">ISBN:</span>
                            <span class="normal-value" style="color:gray"><?php echo $ISBN?></span>
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($subject_info)): ?>
                            <span  class="sub">Subjects:</span>
                            <span class="normal-value" style="color:gray"> <?php echo $subject_info; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($call_number_info)): ?>
                            <span  class="sub">DDC classification:</span>
                            <span class="normal-value" style="color:gray"><?php echo $call_number_info?></span>
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($content_notes)): ?>
                            <span  class="sub">Contents:</span>
                            <div class="content-info" style="color:gray"><?php echo $content_notes?></div>
                        <?php endif; ?>
                    </div>
                    <div class="normal-view">
                        <?php if(!empty($review)): ?>
                            <span  class="sub">Summary:</span>
                            <span class="normal-value" style="color:gray"><?php echo $review?></span>
                        <?php endif; ?>
                    </div>
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