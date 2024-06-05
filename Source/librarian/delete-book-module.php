<?php
session_start();

if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
    exit; // Terminate further execution
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch book details from book_module based on id
    $query = "SELECT * FROM book_module WHERE accession_number = '" . mysqli_real_escape_string($link, $id) . "'";
    $result = mysqli_query($link, $query);
    $book = mysqli_fetch_assoc($result);

    if ($book) {
        // Escape all fields
        foreach ($book as $key => $value) {
            $book[$key] = mysqli_real_escape_string($link, $value);
        }

        // Insert book details into book_module_archive
        $insert_query = "INSERT INTO book_module_archive (accession_number, title_proper, responsibility, preffered_title, parallel_title, main_creator, add_entry_creator, contributors, add_entry_corporate, place_of_publication, publisher, date_of_publication, edition, extent_of_text, illustrations, dimension, acc_materials, series, supp_content, ISBN, content_type, media_type, carrier_type, URL, subject_type, subject_info, call_number_type, call_number_info, language, library_location, electronic_access, book_image, entered_by, updated_by, date_entered, date_updated, quantity, available, location, content_notes, abstract, review, remarks) 
                        VALUES ('{$book['accession_number']}', '{$book['title_proper']}', '{$book['responsibility']}', '{$book['preffered_title']}', '{$book['parallel_title']}', '{$book['main_creator']}', '{$book['add_entry_creator']}', '{$book['contributors']}', '{$book['add_entry_corporate']}', '{$book['place_of_publication']}', '{$book['publisher']}', '{$book['date_of_publication']}', '{$book['edition']}', '{$book['extent_of_text']}', '{$book['illustrations']}', '{$book['dimension']}', '{$book['acc_materials']}', '{$book['series']}', '{$book['supp_content']}', '{$book['ISBN']}', '{$book['content_type']}', '{$book['media_type']}', '{$book['carrier_type']}', '{$book['URL']}', '{$book['subject_type']}', '{$book['subject_info']}', '{$book['call_number_type']}', '{$book['call_number_info']}', '{$book['language']}', '{$book['library_location']}', '{$book['electronic_access']}', '{$book['book_image']}', '{$book['entered_by']}', '{$book['updated_by']}', '{$book['date_entered']}', '{$book['date_updated']}', '{$book['quantity']}', '{$book['available']}', '{$book['location']}', '{$book['content_notes']}', '{$book['abstract']}', '{$book['review']}', '{$book['remarks']}')";

        $archive_result = mysqli_query($link, $insert_query);

        if ($archive_result) {
            // Book archived successfully, now delete from book_module
            $delete_query = "DELETE FROM book_module WHERE accession_number = '{$book['accession_number']}'";
            $delete_result = mysqli_query($link, $delete_query);

            if ($delete_result) {
                // Set success message and redirect
                $_SESSION['success_message'] = "Book Archive successfully.";
                echo "<script>alert('Book Archive successfully.'); window.location='display-book-module.php';</script>";
                exit();
            } else {
                // Set error message and redirect
                $_SESSION['error_message'] = "Error archiving book.";
                echo "<script>alert('Error archiving.'); window.location='display-book-module.php';</script>";
                exit();
            }
        } else {
            // Set error message and redirect
            $_SESSION['error_message'] = "Book id not provided.";
            echo "<script>alert('Book id not provided.'); window.location='display-book-module.php';</script>";
            exit();
        }
    }
}


?>
