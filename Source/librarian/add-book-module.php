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


    </style>
<body>
 
    
<div class="container">
   

    <form action="#" method="post" enctype="multipart/form-data" >
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
                        <input type="text" placeholder="Title Proper" name="title_proper" required="" id="title_proper">
                    </div>

                    <div class="input-field1">
                        <label>Responsibility</label>
                        <input type="text" placeholder="Responsibility" name="responsibility" required="">
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
                        <input type="text" placeholder="Place of Publication" name="place_of_publication" required="" id="place_of_publication">
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
                            <input type="text" placeholder="Accession Number" name="accession_number[]" required>
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
                        <input type="number" placeholder="Available" name="available" required>
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
if (isset($_POST["submit"])) {
    // Establish database connection (assuming $link is already defined)
    
    foreach ($_POST['accession_number'] as $accession_number) {
        // Check if the accession number already exists
        $query = "SELECT COUNT(*) AS count FROM book_module WHERE accession_number = '$accession_number'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            // If accession number already exists, alert the user
            echo "<script>alert('Accession number $accession_number already exists.');</script>";
          
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
            // Your existing code to insert into the database goes here
            mysqli_query($link, "INSERT INTO book_module VALUES (
                '$escaped_accession_number',
                '$_POST[title_proper]',
                '$_POST[responsibility]',
                '$_POST[preffered_title]',
                '$_POST[parallel_title]',
                '$_POST[main_creator]',
                '$_POST[add_entry_creator]',
                '$_POST[contributors]',
                '$_POST[add_entry_corporate]',
                '$_POST[place_of_publication]',
                '$_POST[publisher]',
                '$_POST[date_of_publication]',
                '$_POST[edition]',
                '$_POST[extent_of_text]',
                '$_POST[illustrations]',
                '$_POST[dimension]',
                '$_POST[acc_materials]',
                '$_POST[series]',
                '$_POST[supp_content]',
                '$_POST[ISBN]',
                '$_POST[content_type]',
                '$_POST[media_type]',
                '$_POST[carrier_type]',
                '$filepath',
                '$_POST[subject_type]',
                '$_POST[subject_info]',
                '$_POST[call_number_type]',
                '$_POST[call_number_info]',
                '$_POST[language]',
                '$_POST[library_location]',
                '$_POST[electronic_access]',
                '$imagepath',
                '$_POST[entered_by]',
                '$_POST[updated_by]',
                '$_POST[date_entered]',
                '$_POST[date_updated]',
                '$_POST[quantity]',
                '$_POST[available]',
                '$_POST[location]',
                '$_POST[content_notes]',
                '$_POST[abstract]',
                '$_POST[review]','')"
            );
        }
    }
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

       // if (document.getElementById('title_proper').value.trim() === '') {
            //     alert('Title Proper is required.');
            //     return false;
            // }
            
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
    function addAccessionNumberField() {
        var div = document.createElement('div');
        div.innerHTML = '<div class="input-field1"><label>Accession Number</label><input type="text" placeholder="Accession Number" name="accession_number[]" required></div>';
        document.getElementById('accessionNumberFields').appendChild(div);
    }
</script>
