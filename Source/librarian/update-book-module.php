<?php
session_start();


// Include database connection
include 'inc/connection.php';
// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; // Stop further execution
}

                if (isset($_POST["submit"])) {
                    $title_proper = mysqli_real_escape_string($link, $_POST['title_proper']);
                    $responsibility = mysqli_real_escape_string($link, $_POST['responsibility']);
                    $preffered_title = mysqli_real_escape_string($link, $_POST['preffered_title']);
                    $parallel_title = mysqli_real_escape_string($link, $_POST['parallel_title']);
                    $main_creator = mysqli_real_escape_string($link, $_POST['main_creator']);
                    $add_entry_creator = mysqli_real_escape_string($link, $_POST['add_entry_creator']);
                    $contributors = mysqli_real_escape_string($link, $_POST['contributors']);
                    $add_entry_corporate = mysqli_real_escape_string($link, $_POST['add_entry_corporate']);
                    $place_of_publication = mysqli_real_escape_string($link, $_POST['place_of_publication']);
                    $publisher = mysqli_real_escape_string($link, $_POST['publisher']);
                    $date_of_publication = mysqli_real_escape_string($link, $_POST['date_of_publication']);
                    $edition = mysqli_real_escape_string($link, $_POST['edition']);
                    $extent_of_text = mysqli_real_escape_string($link, $_POST['extent_of_text']);
                    $illustrations = mysqli_real_escape_string($link, $_POST['illustrations']);
                    $dimension = mysqli_real_escape_string($link, $_POST['dimension']);
                    $acc_materials = mysqli_real_escape_string($link, $_POST['acc_materials']);
                    $series = mysqli_real_escape_string($link, $_POST['series']);
                    $supp_content = mysqli_real_escape_string($link, $_POST['supp_content']);
                    $ISBN = mysqli_real_escape_string($link, $_POST['ISBN']);
                    $content_type = mysqli_real_escape_string($link, $_POST['content_type']);
                    $media_type = mysqli_real_escape_string($link, $_POST['media_type']);
                    $carrier_type = mysqli_real_escape_string($link, $_POST['carrier_type']);
                    $subject_type = mysqli_real_escape_string($link, $_POST['subject_type']);
                    $subject_info = mysqli_real_escape_string($link, $_POST['subject_info']);
                    $call_number_type = mysqli_real_escape_string($link, $_POST['call_number_type']);
                    $call_number_info = mysqli_real_escape_string($link, $_POST['call_number_info']);
                    $accession_number = mysqli_real_escape_string($link, $_POST['accession_number']);
                    $language = mysqli_real_escape_string($link, $_POST['language']);
                    $library_location = mysqli_real_escape_string($link, $_POST['library_location']);
                    $electronic_access = mysqli_real_escape_string($link, $_POST['electronic_access']);
                    $entered_by = mysqli_real_escape_string($link, $_POST['entered_by']);
                    $updated_by = mysqli_real_escape_string($link, $_POST['updated_by']);
                    $date_entered = mysqli_real_escape_string($link, $_POST['date_entered']);
                    $date_updated = mysqli_real_escape_string($link, $_POST['date_updated']);
                    $quantity = mysqli_real_escape_string($link, $_POST['quantity']);
                    $available = mysqli_real_escape_string($link, $_POST['available']);
                    $location = mysqli_real_escape_string($link, $_POST['location']);
                    $content_notes = mysqli_real_escape_string($link, $_POST['content_notes']);
                    $abstract = mysqli_real_escape_string($link, $_POST['abstract']);
                    $review = mysqli_real_escape_string($link, $_POST['review']);

                    if ($_FILES['f1']['name'] != "") {
                        $image_name = $_FILES['f1']['name'];
                        $temp = explode(".", $image_name);
                        $newfilename = round(microtime(true)) . '.' . end($temp);
                        $imagepath = "books-image/" . $newfilename;
                        move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);
                        $imagepath_update = ", book_image='$imagepath'";
                    } else {
                        $imagepath_update = "";
                    }
                
                    // Handle file upload
                    if ($_FILES['file']['name'] != "") {
                        $file_name = $_FILES['file']['name'];
                        $temp2 = explode(".", $file_name);
                        $newfilename2 = round(microtime(true)) . '.' . end($temp2);
                        $filepath = "books-file/" . $newfilename2;
                        move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
                        $filepath_update = ", URL='$filepath'";
                    } else {
                        $filepath_update = "";
                    }
                
                    // Update book details in database
                    $query = "UPDATE book_module SET 
                        title_proper='$title_proper', 
                        responsibility='$responsibility', 
                        preffered_title='$preffered_title', 
                        parallel_title='$parallel_title', 
                        main_creator='$main_creator', 
                        add_entry_creator='$add_entry_creator', 
                        contributors='$contributors', 
                        add_entry_corporate='$add_entry_corporate', 
                        place_of_publication='$place_of_publication', 
                        publisher='$publisher', 
                        date_of_publication='$date_of_publication', 
                        edition='$edition', 
                        extent_of_text='$extent_of_text', 
                        illustrations='$illustrations', 
                        dimension='$dimension', 
                        acc_materials='$acc_materials', 
                        series='$series', 
                        supp_content='$supp_content', 
                        ISBN='$ISBN', 
                        content_type='$content_type', 
                        media_type='$media_type', 
                        carrier_type='$carrier_type', 
                        subject_type='$subject_type', 
                        subject_info='$subject_info', 
                        call_number_type='$call_number_type', 
                        call_number_info='$call_number_info', 
                        accession_number='$accession_number', 
                        language='$language', 
                        library_location='$library_location', 
                        electronic_access='$electronic_access', 
                        entered_by='$entered_by', 
                        updated_by='$updated_by', 
                        date_entered='$date_entered', 
                        date_updated='$date_updated', 
                        quantity='$quantity', 
                        available='$available', 
                        location='$location', 
                        content_notes='$content_notes', 
                        abstract='$abstract', 
                        review='$review' 
                        $imagepath_update 
                        $filepath_update 
                        WHERE accession_number=$accession_number";
                
                    $result = mysqli_query($link, $query);
                
                    if ($result) {
                        $_SESSION['success_message'] = "Book updated successfully";
                        echo "<script>window.location.href = 'display-book-module.php'; alert('Success to update book');
                       
                        </script>";
                        exit();
                      
                       
                    } else {
                        
                        echo "<script>alert('Failed to update book');</script>";
                        echo "<p>Error updating book. Please try again.</p>";
                    }
                }
                
            ?>