<?php 
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
}
$page = '';
include 'inc/header.php';
include 'inc/connection.php';
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBS Library</title>
    <link rel="stylesheet" href="inc/css/progress.css">
</head>
<style>
/* Style for tabs */

.tab {
    display: none;
}

.tab.active {
    display: block;
}

.tab-buttons {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    justify-content: center; /* Center align the buttons */
    margin-bottom: 20px;
}

.tab-buttons button:hover{
    background-color: #666769;
}

.tab-buttons button {
    padding: 10px;
    cursor: pointer;
    margin: 5px; /* Add some margin between buttons */
    margin-right: 10px; /* Add space between buttons */
    background-color: #d52033; /* Default color for inactive buttons */
    color: white; /* Text color for buttons */
    border: none; /* Remove border for cleaner look */
}

.tab-buttons button.active {
    background-color: #666769; /* Color for active button */
}
.error{
    color:#d52033;
}


    </style>
<body>
 
    
<div class="container">
   

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" >
    <div class="header-container">
                <header>Edit Book Module</header>
                <!-- Save button -->
                <button type="submit" name="submit" class="editButton">
                    <i class="fas fa-save"></i> Add Book
                </button>
    </div>

            <div class="tab-buttons">
                <button type="button" onclick="showTab(0)">Book Catalogue</button>
                <button type="button" onclick="showTab(1)">Publication</button>
                <button type="button" onclick="showTab(2)">Subject Entry</button>
                <button type="button" onclick="showTab(3)">Local Information</button>
                <button type="button" onclick="showTab(4)">Content</button>
            </div>
            
    <div class="tab active">
            <div class="details personal">
                <span class="title"> BOOK CATALOGUE MODULE</span>
                <div class="fields">
                    <div class="input-field1">
                        <label>Title Proper</label>
                        <input type="text" placeholder="Title Proper" name="title_proper" id="title_proper">
                        <div id="title_proper_error" class="error"></div>
                    </div>

                    <div class="input-field1">
                        <label>Responsibility</label>
                        <input type="text" placeholder="Responsibility" name="responsibility" >
                    </div>

                    <div class="input-field1">
                        <label>Preffered Title</label>
                        <input type="text" placeholder="Preffered Title" name="preffered_title">
                    </div>

                    <div class="input-field1">
                        <label>Parallel Title</label>
                        <input type="text" placeholder="Parallel Title" name="parallel_title">
                    </div>

                    <div class="input-field1">
                        <label>Main Creator</label>
                        <input type="text" placeholder="Main Creator" name="main_creator">
                    </div>

                    <div class="input-field1">
                        <label>Added Entry Creator</label>
                        <input type="text" placeholder="Added Entry Creator" name="add_entry_creator">
                    </div>

                    <div class="input-field1">
                        <label>Contributors</label>
                        <input type="text" placeholder="Contributors" name="contributors">
                    </div>

                    <div class="input-field1">
                        <label>Added Entry Corporate</label>
                        <input type="text" placeholder="Added Entry Corporate" name="add_entry_corporate">
                    </div>
                </div> 
                                     
            </div>
        </div>

        <!-- END FIRST FORM -->

        <!-- SECOND FORM -->
        <div class="tab">

            <div class="details ID">
                <span class="title"> PUBLICATION</span>
                <div class="fields">
                    <div class="input-field1">
                        <label>Place of Publication</label>
                        <input type="text" placeholder="Place of Publication" name="place_of_publication" id="place_of_publication">
                        <div id="place_of_publication_error" class="error"></div>
                        
                    </div>

                    <div class="input-field1">
                        <label>Publisher</label>
                        <input type="text" placeholder="Publisher" name="publisher">
                    </div>
                    <div class="input-field">
                        <label>Date of Publication</label>
                        <input type="text" placeholder="Date of Publication" name="date_of_publication">
                    </div>

                    <div class="input-field">
                        <label> Edition</label>
                        <input type="text" placeholder="Edition" name="edition">
                    </div>

                    <div class="input-field">
                        <label> Extend of Text</label>
                        <input type="text" placeholder="Extend of Text" name="extent_of_text">
                    </div>

                    <div class="input-field">
                        <label> Illustration</label>
                        <input type="text" placeholder="Illustration" name="illustrations">
                    </div>

                    <div class="input-field">
                        <label> Dimension </label>
                        <input type="text" placeholder="Dimension" name="dimension">
                    </div>

                    <div class="input-field">
                        <label> Acc. Materials</label>
                        <input type="text" placeholder="Acc. Materials" name="acc_materials" >
                    </div>

                    <div class="input-field1">
                        <label>Series</label>
                        <input type="text" placeholder="Series" name="series">
                    </div>

                    <div class="input-field1">
                        <label>Suplementary content</label>
                        <input type="text" placeholder="Suplementary content" name="supp_content">
                    </div>

                    <div class="input-field1">
                        <label>Identifier/ISBN</label>
                        <input type="text" placeholder="Identifier/ISBN" name="ISBN">
                    </div>

                    <div class="input-field1">
                        <label>Content Type</label>
                        <input type="text" placeholder="Content Type" name="content_type">
                    </div>

                    <div class="input-field1">
                        <label>Media Type</label>
                        <input type="text" placeholder="Media Type" name="media_type">
                    </div>

                    <div class="input-field1">
                        <label>Carrier Type</label>
                        <input type="text" placeholder="Carrier Type" name="carrier_type">
                    </div>

                    <div class="input-field1">
                        <label>URL</label>
                        <input type="file" name="file">
                    </div>
                </div>

            </div>
        </div>

        <!--  SECOND FORM END  -->


        <div class="tab">
        <!-- 3RD  FORM -->
  
            <div class="details ID">
                <span class="title"> SUBJECT ENTRY</span>
                <div class="fields">
                    <div class="input-field">
                        <label>Subject</label>
                        <select name="subject_type">
                            <option>Tropical</option>
                            <option>Personal</option>
                            <option>Corporate</option>
                            <option>Geographical</option>
                        </select>
                    </div>
                    
                    <div class="input-field1">
                        <label>Subject Info</label>
                        <textarea name="subject_info" placeholder="Subject Info"></textarea>
                    </div>
                </div>
              
            </div>
        </div>

        <!-- 3rd form end -->

        <!-- FOURTH  FORM -->
        <div class="tab">
   
            <div class="details ID">
                <span class="title"> LOCAL INFORMATION</span>
                <div class="fields">
                    <div class="input-field2">
                        <label>Call Number</label>
                        <select placeholder="Title Proper" name="call_number_type">
                            <option>BIO</option>
                            <option>CD-ROM</option>
                            <option>CIR</option>
                            <option>FIC</option>
                            <option>FIL</option>
                            <option>REF</option>
                            <option>TH</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Call Number</label>
                        <input type="text" placeholder="Call Number" name="call_number_info">
                    </div>

                
                        <div class="input-field2">
                            <label>Accession Number</label>
                            <input type="text" placeholder="Accession Number" name="accession_number[]">
                            <div id="accession_number_error" class="error"></div>
                            <div id="accessionNumberFields"></div>
                           

                </div>
                <div class="buttons">
                    <button type="button" onclick="addAccessionNumberField()">
                        <span>Add More</span>
                    </button>
                </div>

                    <div class="input-field2">
                        <label>Language</label>
                        <select placeholder="Title Proper" name="language">
                            <option>English</option>
                            <option>Filipino</option>
                            <option>French</option>
                            <option>German</option>
                            <option>Italian</option>
                            <option>Korean</option>
                            <option>Latin</option>
                            <option>Mandarin</option>
                            <option>Nihongo</option>
                            <option>Spanish</option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Library/Location</label>
                        <select placeholder="Title Proper" name="library_location">
                            <option>BIO</option>
                            <option>CD-ROM</option>
                            <option>CIR</option>
                            <option>FIC</option>
                            <option>FIL</option>
                            <option>REF</option>
                            <option>TH</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Electronic Access</label>
                        <input type="text" placeholder="Library/Location" name="electronic_access">
                    </div>

                    <div class="input-field2">
                        <label>Cover Image file</label>
                        <input type="file" name="f1">
                    </div>

                    <div class="input-field2">
                        <label>Entered by</label>
                        <input type="text" placeholder="Entered by" name="entered_by">
                    </div>

                    <div class="input-field2">
                        <label>Updated by</label>
                        <input type="text" placeholder="Updated by" name="updated_by">
                    </div>

                    <div class="input-field2">
                        <label>Date Entered</label>
                        <input type="date" name="date_entered">
                    </div>

                    <div class="input-field2">
                        <label>Date Updated</label>
                        <input type="date" name="date_updated">
                    </div>

                    <div class="input-field2">
                        <label>Quantity</label>
                        <input type="number" placeholder="Quantity" name="quantity">
                    </div>

                    <div class="input-field2">
                        <label>Available</label>
                        <input type="number" placeholder="Available" name="available">
                        <div id="available_error" class="error"></div>
                    </div>

                    <div class="input-field2">
                        <label>Location</label>
                        <select name="location">
                            <option>General Circulation</option>
                            <option>Teachers Reference</option>
                            <option>Filipiniana</option>
                            <option>Circulation</option>
                            <option>Reference</option>
                            <option>Special Collection</option>
                            <option>Biography</option>
                            <option>Reserve</option>
                            <option>Scholastic</option>
                            <option>Fiction</option>
                            <option>Special Collection</option>
                        </select>
                    </div>
                </div>
               
            </div>
        </div>

        <!-- fOURTH form end -->

        <!-- Fifth  FORM -->
        <div class="tab">

            <div class="details ID">
                <span class="title"> SUBJECT ENTRY</span>
                <div class="fields">
                    <div class="input-field1">
                        <label>Content notes</label>
                        <textarea placeholder="Content notes" name="content_notes"></textarea>
                    </div>

                    <div class="input-field1">
                        <label>Abstract</label>
                        <textarea placeholder="Abstract" name="abstract"></textarea>
                    </div>

                    <div class="input-field1">
                        <label>Review</label>
                        <textarea placeholder="Review" name="review"></textarea>
                    </div>
                </div>
              
            </div>
        </div>

        <!-- FIFTH form end -->
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from form
    $titleProper = $_POST['title_proper'];
    $responsibility = $_POST['responsibility'];
    $preferredTitle = $_POST['preferred_title'];
    $parallelTitle = $_POST['parallel_title'];
    $mainCreator = $_POST['main_creator'];
    $addEntryCreator = $_POST['add_entry_creator'];
    $contributors = $_POST['contributors'];
    $addEntryCorporate = $_POST['add_entry_corporate'];

    $placeOfPublication = $_POST['place_of_publication'];
    $publisher = $_POST['publisher'];
    $dateOfPublication = $_POST['date_of_publication'];
    $edition = $_POST['edition'];
    $extentOfText = $_POST['extent_of_text'];
    $illustrations = $_POST['illustrations'];
    $dimension = $_POST['dimension'];
    $accMaterials = $_POST['acc_materials'];
    $series = $_POST['series'];
    $suppContent = $_POST['supp_content'];
    $ISBN = $_POST['ISBN'];
    $contentType = $_POST['content_type'];
    $mediaType = $_POST['media_type'];
    $carrierType = $_POST['carrier_type'];
    $filePath = "";

    if ($_FILES['file']['name']) {
        $filePath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
    }

    $subjectType = $_POST['subject_type'];
    $subjectInfo = $_POST['subject_info'];

    $callNumberType = $_POST['call_number_type'];
    $callNumberInfo = $_POST['call_number_info'];
    $accessionNumber = $_POST['accession_number'];
    $language = $_POST['language'];
    $libraryLocation = $_POST['library_location'];
    $electronicAccess = $_POST['electronic_access'];
    $coverImagePath = "";

    if ($_FILES['cover_image']['name']) {
        $coverImagePath = 'uploads/' . $_FILES['cover_image']['name'];
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $coverImagePath);
    }

    $enteredBy = $_POST['entered_by'];
    $updatedBy = $_POST['updated_by'];
    $dateEntered = $_POST['date_entered'];
    $dateUpdated = $_POST['date_updated'];
    $quantity = $_POST['quantity'];
    $available = $_POST['available'];
    $location = $_POST['location'];

    $contentNotes = $_POST['content_notes'];
    $abstract = $_POST['abstract'];
    $review = $_POST['review'];

    // Inserting data into book_catalogue
    $sql1 = "INSERT INTO book_catalogue (title_proper, responsibility, preferred_title, parallel_title, main_creator, add_entry_creator, contributors, add_entry_corporate)
             VALUES ('$titleProper', '$responsibility', '$preferredTitle', '$parallelTitle', '$mainCreator', '$addEntryCreator', '$contributors', '$addEntryCorporate')";

    if ($conn->query($sql1) === TRUE) {
        $book_id = $conn->insert_id; // Get the last inserted ID to use as foreign key

        // Inserting data into publication
        $sql2 = "INSERT INTO publication (book_id, place_of_publication, publisher, date_of_publication, edition, extent_of_text, illustrations, dimension, acc_materials, series, supp_content, ISBN, content_type, media_type, carrier_type, file_path)
                 VALUES ('$book_id', '$placeOfPublication', '$publisher', '$dateOfPublication', '$edition', '$extentOfText', '$illustrations', '$dimension', '$accMaterials', '$series', '$suppContent', '$ISBN', '$contentType', '$mediaType', '$carrierType', '$filePath')";
        $conn->query($sql2);

        // Inserting data into subject_entry
        $sql3 = "INSERT INTO subject_entry (book_id, subject_type, subject_info)
                 VALUES ('$book_id', '$subjectType', '$subjectInfo')";
        $conn->query($sql3);

        // Inserting data into local_information
        $sql4 = "INSERT INTO local_information (book_id, call_number_type, call_number_info, accession_number, language, library_location, electronic_access, cover_image_path, entered_by, updated_by, date_entered, date_updated, quantity, available, location)
                 VALUES ('$book_id', '$callNumberType', '$callNumberInfo', '$accessionNumber', '$language', '$libraryLocation', '$electronicAccess', '$coverImagePath', '$enteredBy', '$updatedBy', '$dateEntered', '$dateUpdated', '$quantity', '$available', '$location')";
        $conn->query($sql4);

        // Inserting data into content
        $sql5 = "INSERT INTO content (book_id, content_notes, abstract, review)
                 VALUES ('$book_id', '$contentNotes', '$abstract', '$review')";
        $conn->query($sql5);

        echo '<script type="text/javascript">alert("Book added successfully!");</script>';
    } else {
        echo '<script type="text/javascript">alert("Error: ' . $sql1 . '<br>' . $conn->error . '");</script>';
    }

    // Close connection
    $conn->close();
}
?>

<?php 
include 'inc/footer.php';
?>


<script>
  let currentTab = 0;

function showTab(n) {
    const tabs = document.querySelectorAll('.tab');
    const buttons = document.querySelectorAll('.tab-buttons button');

    //    if (document.getElementById('title_proper').value.trim() === '') {
    //             alert('Title Proper is required.');
    //             return false;
    //         }
            
    // Remove active class from the current tab and button
    tabs[currentTab].classList.remove('active');
    buttons[currentTab].classList.remove('active');

    // Set new current tab
    currentTab = n;

    // Add active class to the new current tab and button
    tabs[currentTab].classList.add('active');
    buttons[currentTab].classList.add('active');
}

// Set the initial active button and tab on page load
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tab')[currentTab].classList.add('active');
    document.querySelectorAll('.tab-buttons button')[currentTab].classList.add('active');
});
</script>

</body>
</html>
<script>
    function validateForm() {
    // Get the value of the required fields
    const titleProper = document.getElementById('title_proper').value.trim();
    const placeOfPublication = document.getElementById('place_of_publication').value.trim();
    const accession_number = document.querySelector('input[name="accession_number[]"]').value.trim();
    const available = document.querySelector('input[name="available"]').value.trim();
    const quantity = document.querySelector('input[name="quantity"]').value.trim();

    // Check if any required field is empty
    if (titleProper === '' ) {
        // Display error message next to the title proper input field
        alert('Please input Title Proper');
        document.getElementById('title_proper_error').innerText = 'Title Proper is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('title_proper_error').innerText = '';
    }

    if (placeOfPublication === '') {
    // Display error message next to the place of publication input field
    document.getElementById('place_of_publication_error').innerText = 'Place of Publication is required.';
    return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('place_of_publication_error').innerText = '';
    }

    if (accession_number === '') {
        // Display error message next to the accession number input field
        alert('Please input Accession Number');
        document.getElementById('accession_number_error').innerText = 'Accession Number is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('accession_number_error').innerText = '';
    }

    if (available === '') {
        // Display error message next to the available input field
        document.getElementById('available_error').innerText = 'Available is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('available_error').innerText = '';
    }

    if (quantity === '') {
        // Display error message next to the quantity input field
        document.getElementById('quantity_error').innerText = 'Quantity is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('quantity_error').innerText = '';
    }

    // If all required fields are filled, allow form submission
    return true;
}
    function addAccessionNumberField() {
        var div = document.createElement('div');
        div.innerHTML = '<div class="input-field1"><label>Accession Number</label><input type="text" placeholder="Accession Number" name="accession_number[]" required></div>';
        document.getElementById('accessionNumberFields').appendChild(div);
    }

</script>


