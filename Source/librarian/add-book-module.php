<?php 
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
}
$page = 'add-b';
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
.responsive-input {
    width: 615px; /* Default width for larger screens */
}

/* Adjust input width for smaller screens */
@media (max-width: 1290px) {
    .responsive-input {
        width: calc(100% - 20px); /* Subtract 20px from the full width */
    }
}
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
   

<form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" >
    <div class="header-container">
                <header>Add Book Module</header>
                <!-- Save button -->
                <button type="submit" name="submit" class="editButton">
                    <i class="fas fa-save"></i> Add Book
                </button>
    </div>

            <div class="tab-buttons">
                <button type="button" onclick="showTab(0)">Title Proper</button>
                <button type="button" onclick="showTab(1)">Publication</button>
                <button type="button" onclick="showTab(2)">Local Information</button>
                <button type="button" onclick="showTab(3)">Access Point</button>
                <button type="button" onclick="showTab(4)">Abstracts</button>
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

                    <div class="input-field2">
                        <label>Suplementary content</label>
                        <select name="supplementary_content">
                            <option></option>
                            <option>Includes index</option>
                            <option>Includes bibliographic references</option>
                            <option>Includes bibliographic and index</option>
                            <option>Includes bibliographic </option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Identifier/ISBN</label>
                        <input type="text" placeholder="Identifier/ISBN" name="ISBN">
                        <div id="ISBN_error" class="error"></div>
                    </div>

                    <div class="input-field2">
                        <label>Content Type</label>
                        <select name="content_type">
                            <option></option>
                            <option>cartographic date_time_set</option>
                            <option>cartographic image</option>
                            <option>cartographic moving image</option>
                            <option>cartographic tactile image </option>
                            <option>cartographic tactile three-dimensional form </option>
                            <option>cartographic three-dimensional form </option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Media Type</label>
                        <select name="media_type">
                            <option></option>
                            <option>audio</option>
                            <option>computer</option>
                            <option>cartographic moving image</option>
                            <option>microform </option>
                            <option>microscopic</option>
                            <option>projected</option>
                            <option>stereographic</option>
                            <option>unmediated</option>
                            <option>video</option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Carrier Type</label>
                        <select name="carrier_type">
                            <option></option>
                            <option>audio cartridge</option>
                            <option>audio cylinder</option>
                            <option>audio disc</option>
                            <option>aperture card </option>
                            <option>audio roll</option>
                            <option>audiocassette</option>
                            <option>audiotape reel</option>
                            <option>card</option>
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>URL</label>
                        <input type="file" name="file">
                    </div>
                </div>

            </div>
        </div>

        <!--  SECOND FORM END  -->

        
        <!-- FOURTH  FORM -->
        <div class="tab">
   
            <div class="details ID">
                <span class="title">LOCAL INFORMATION</span>
                <div class="fields">
                <div class="input-field1">
                            <span>
                            <label>Accession Number</label>
                            <input type="button" onclick="addAccessionNumberField()" style="width:50px; height:30px; border:none; font-size: 20px; background-color: #d52033; color: white;" value="&#43;">
                            </input>
                            </span>
                            <input type="text" placeholder="Accession Number" name="accession_number[]" class="responsive-input"/>
                            <div id="accession_number_error" class="error"></div>
                            <div id="accessionNumberFields"></div>
                </div>

                
                    <div class="input-field2">
                        <label>Call Number</label>
                        <select placeholder="Title Proper" name="call_number_type">
                        <option></option>
                            <option>BIO</option>
                            <option>CD-ROM</option>
                            <option>CIR</option>
                            <option>FIC</option>
                            <option>FIL</option>
                            <option>REF</option>
                            <option>TH</option>
                        
                        </select>
                    </div>

                    <div class="input-field2">
                        <label>Call Number</label>
                        <input type="text" placeholder="Call Number" name="call_number_info">
                        <div id="call_number_info_error" class="error"></div>
                    </div>

                
                 
            

                    <div class="input-field2">
                        <label>Language</label>
                        <select placeholder="Title Proper" name="language">
                        <option></option>
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
                        <option></option>
                            <option>College Library</option>
                            <option>Grade School Library</option>
                            <option>Graduate School Library</option>
                            <option>High School Library</option>
                            <option>Junior High School Library</option>
                            <option>Pre-School Library</option>
                            <option>Senior High School Library</option>
        
                        </select>
                    </div>

                    <!-- <div class="input-field2">
                        <label>Electronic Access</label>
                        <input type="text" placeholder="Library/Location" name="electronic_access">
                    </div> -->

                    <div class="input-field1">
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
                        <div id="quantity_error" class="error"></div>
                    </div>

                    <div class="input-field2">
                        <label>Available</label>
                        <input type="number" placeholder="Available" name="available">
                        <div id="available_error" class="error"></div>
                    </div>



                    <div class="input-field2">
                        <label>Circulation</label>
                        <select name="location">
                        <option></option>
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


        <div class="tab">
        <!-- 3RD  FORM -->
  
            <div class="details ID">
                <span class="title"> SUBJECT ENTRY</span>
                <div class="fields">
                    <div class="input-field2">
                        <label>Subject</label>
                        <select name="subject_type">
                            <option></option>
                            <option>Topical</option>
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


        <!-- Fifth  FORM -->
        <div class="tab">

            <div class="details ID">
                <span class="title"> Content / Abstract / Review</span>
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
if (isset($_POST["submit"])) {
    foreach ($_POST['accession_number'] as $accession_number) {
        // Check if the accession number already exists
        $query = "SELECT COUNT(*) AS count FROM book_module WHERE accession_number = '$accession_number'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        if ($count > 0) {
            // If accession number already exists, add it to the failed list
            $failedList[] = $accession_number;
        } else {
            // If accession number is unique, proceed with insertion
            $image_name = $_FILES['f1']['name'];
            $file_name = $_FILES['file']['name'];
            $temp = explode(".", $image_name);
            $temp2 = explode(".", $file_name);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $newfilename2 = round(microtime(true)) . '.' . end($temp2);
            $imagepath = "books-image/" . $newfilename;
            $filepath = "books-file/" . $newfilename2;
            move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);
            move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
            // Escape the values to prevent SQL injection
            $escaped_accession_number = mysqli_real_escape_string($link, $accession_number);
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
            
      
            mysqli_query($link, "INSERT INTO book_module VALUES (
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
                '$filepath',
                '$subject_type',
                '$subject_info',
                '$call_number_type',
                '$call_number_info',
                '$language',
                '$library_location',
                '',
                '$imagepath',
                '$entered_by',
                '$updated_by',
                '$date_entered',
                '$date_updated',
                '$quantity',
                '$available',
                '$location',
                '$content_notes',
                '$abstract',
                '$review','')"
                
            );
          
            $successList[] = $accession_number;
          
         

        }
}

if (!empty($successList)) {
    // If there are successfully added accession numbers, display a success message with the list
    $_SESSION['success_message'] = "Book added Successfully with Accession Number(s): " . implode(', ', $successList);
    echo '<script type="text/javascript">alert("Book Add Successful with Accession Number(s): ' . implode(', ', $successList) . '");</script>';
}

if (!empty($failedList)) {
    // If there are failed insertion due to existing accession numbers, alert the user
    echo '<script type="text/javascript">alert("Failed to insert due to existing Accession Number(s): ' . implode(', ', $failedList) . '");</script>';
}

// Redirect to display-book-module.php after processing
echo '<script>window.location="display-book-module.php";</script>';
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
    const ISBN = document.querySelector('input[name="ISBN"]').value.trim();
    const call_number_info = document.querySelector('input[name="call_number_info"]').value.trim();

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
    alert('Please input place of publication');
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
        alert('Please input availability');
        document.getElementById('available_error').innerText = 'Available is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('available_error').innerText = '';
    }

    if (quantity === '') {
        // Display error message next to the quantity input field
        alert('Please input quantity of books');
        document.getElementById('quantity_error').innerText = 'Quantity is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('quantity_error').innerText = '';
    }

    if (ISBN === '') {
        // Display error message next to the quantity input field
        alert('Please input ISBN');
        document.getElementById('ISBN_error').innerText = 'ISBN is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('ISBN_error').innerText = '';
    }

    if (call_number_info === '') {
        // Display error message next to the quantity input field
        alert('Please input Call No');
        document.getElementById('call_number_info_error').innerText = 'Call No is required.';
        return false; // Prevent form submission
    } else {
        // Clear error message if the field is not empty
        document.getElementById('call_number_info_error').innerText = '';
    }

    

    // If all required fields are filled, allow form submission
    return true;
}
function addAccessionNumberField() {
        var div = document.createElement('div');
        div.innerHTML = '<div class="input-field1"><span><label>Accession Number </label><input type="button" onclick="removeAccessionNumberField(this)" style="width:50px; height:30px; border:none; font-size: 20px; background-color: #d52033; color: white;" value="-" ></input></span>     <input type="text" placeholder="Accession Number" name="accession_number[]" class="responsive-input" required /></div>';
        document.getElementById('accessionNumberFields').appendChild(div);
    }

    function removeAccessionNumberField(element) {
    // Navigate up the DOM hierarchy to find the parent div containing both the button and the input
    var parentDiv = element.closest('.input-field1');
    // Remove the parent div
    if (parentDiv) {
        parentDiv.parentNode.removeChild(parentDiv);
    }
}

</script>


