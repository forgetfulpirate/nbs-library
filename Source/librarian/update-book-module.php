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
    $success_list = array();
    $error_list = array();

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
    $language = mysqli_real_escape_string($link, $_POST['language']);
    $library_location = mysqli_real_escape_string($link, $_POST['library_location']);
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

    // Handle file upload for image
    if ($_FILES['f1']['name'] != "") {
        $image_name = $_FILES['f1']['name'];
        $temp = explode(".", $image_name);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imagepath = "books-image/" . $newfilename;
        move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);
        $imagepath_update = ", book_image='$imagepath'";
    } else {
        // If no new image is uploaded, keep the existing image path
        $imagepath_query = "SELECT book_image FROM book_module WHERE accession_number='{$_POST['accession_number'][0]}'";
        $imagepath_result = mysqli_query($link, $imagepath_query);
        $imagepath_row = mysqli_fetch_assoc($imagepath_result);
        $imagepath = $imagepath_row['book_image'];
        $imagepath_update = "";
    }

    // Handle file upload for file
    if ($_FILES['file']['name'] != "") {
        $file_name = $_FILES['file']['name'];
        $temp2 = explode(".", $file_name);
        $newfilename2 = round(microtime(true)) . '.' . end($temp2);
        $filepath = "books-file/" . $newfilename2;
        move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
        $filepath_update = ", URL='$filepath'";
    } else {
        // If no new file is uploaded, keep the existing file path
        $filepath_query = "SELECT URL FROM book_module WHERE accession_number='{$_POST['accession_number'][0]}'";
        $filepath_result = mysqli_query($link, $filepath_query);
        $filepath_row = mysqli_fetch_assoc($filepath_result);
        $filepath = $filepath_row['URL'];
        $filepath_update = "";
    }

    // Update existing book details
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
        language='$language', 
        library_location='$library_location', 
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
        WHERE accession_number='{$_POST['accession_number'][0]}'";

    $result = mysqli_query($link, $query);

    if ($result) {
        $_SESSION['success_message'] = "Book details updated successfully.";
        echo "<script>alert('Book details updated successfully.'); window.location.href = 'display-book-module.php';</script>";
        exit();
    }

    foreach ($_POST['accession_number'] as $key => $accession_number) {
        if ($key == 0) continue; // Skip the first accession number as it's already updated

        $escaped_accession_number = mysqli_real_escape_string($link, $accession_number);
        $query_check = "SELECT COUNT(*) AS count FROM book_module WHERE accession_number = '$escaped_accession_number'";
        $result_check = mysqli_query($link, $query_check);
        $row_check = mysqli_fetch_assoc($result_check);

        if ($row_check['count'] == 0) {
            $query_insert = "INSERT INTO book_module (accession_number, title_proper, responsibility, preffered_title, parallel_title, main_creator, add_entry_creator, contributors, add_entry_corporate, place_of_publication, publisher, date_of_publication, edition, extent_of_text, illustrations, dimension, acc_materials, series, supp_content, ISBN, content_type, media_type, carrier_type, subject_type, subject_info, call_number_type, call_number_info, language, library_location, entered_by, updated_by, date_entered, date_updated, quantity, available, location, content_notes, abstract, review, book_image, URL) VALUES (
                '$escaped_accession_number',
                '$title_proper',
                '$responsibility',
                '$preffered_title',
                '$parallel_title',
                '$main_creator',
                '$add_entry_creator',
                '$contributors',
                '$add_entry_corporate',
                '$place_of_publication',
                '$publisher',
                '$date_of_publication',
                '$edition',
                '$extent_of_text',
                '$illustrations',
                '$dimension',
                '$acc_materials',
                '$series',
                '$supp_content',
                '$ISBN',
                '$content_type',
                '$media_type',
                '$carrier_type',
                '$subject_type',
                '$subject_info',
                '$call_number_type',
                '$call_number_info',
                '$language',
                '$library_location',
                '$entered_by',
                '$updated_by',
                '$date_entered',
                '$date_updated',
                '$quantity',
                '$available',
                '$location',
                '$content_notes',
                '$abstract',
                '$review',
                '$imagepath',
                '$filepath')";

            $result_insert = mysqli_query($link, $query_insert);

            if ($result_insert) {
                $success_list[] = $escaped_accession_number;
            } else {
                $error_list[] = $escaped_accession_number;
            }
        } else {
            $error_list[] = $escaped_accession_number;
        }
    }

    // Display success and error messages
    if (!empty($success_list)) {
        $success_message = "Successfully added: " . implode(", ", $success_list);
        echo "<script>alert('$success_message');</script>";
    }

    if (!empty($error_list)) {
        $error_message = "Failed to add: " . implode(", ", $error_list) . ". These accession numbers already exist.";
        $_SESSION['error_message'] = $error_message;
        echo "<script>alert('$error_message'); window.location.href = 'display-book-module.php';</script>";
        exit();
    }
}
?>
