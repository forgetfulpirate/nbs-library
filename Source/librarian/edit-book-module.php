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

if(isset($_GET['id'])) {
    $accession_number = $_GET['id'];
    // Sanitize the input to prevent SQL injection
    $accession_number = mysqli_real_escape_string($link, $accession_number);

    // Fetch book details based on ID
    $query = "SELECT * FROM book_module WHERE accession_number = '$accession_number'";
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
        $resource_type = $row['resource_type'];
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
    <title>NBS Library</title>
    <link rel="stylesheet" href="inc/css/progress.css">
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
</head>
<body>
<div id="successMessage" style="display: none; color: green;">Book added successfully!</div>
<div id="errorMessage" style="display: none; color: red;">Failed to add book. Duplicate accession number exists.</div>
    <div class="container">
        <form action="update-book-module.php" method="post" enctype="multipart/form-data" id="bookForm">
            <div class="header-container">
                <header>Edit Book Module</header>
                <!-- Save button -->
                <button type="submit" name="submit" class="editButton">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>

            <div class="tab-buttons">
            <button type="button" onclick="showTab(0)">Title Proper</button>
                <button type="button" onclick="showTab(1)">Publication</button>
                <button type="button" onclick="showTab(2)">Access Point</button>
                <button type="button" onclick="showTab(3)">Abstracts</button>
                <button type="button" onclick="showTab(4)">Local Information</button>
            </div>

            <div class="tab active">
                <div class="details personal">
                    <span class="title">BOOK CATALOGUE MODULE</span>
                    <div class="fields">
                        <div class="input-field1">
                            <label>Title Proper</label>
                            <input type="text" placeholder="Title Proper" name="title_proper" required="" value="<?php echo $row['title_proper']; ?>" id="title_proper">
                        </div>

                            <div class="input-field1">
                                <label>Responsibility</label>
                                <input type="text" placeholder="Responsibility" name="responsibility"  value="<?php echo $responsibility; ?>">
                            </div>

                            <div class="input-field1">
                                <label>Preffered Title</label>
                                <input type="text" placeholder="Preferred Title" name="preffered_title" value="<?php echo $preffered_title; ?>">
                            </div>

                            <div class="input-field1">
                                <label>Parallel Title</label>
                                <input type="text" placeholder="Parallel Title" name="parallel_title" value="<?php echo $parallel_title; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Main Creator</label>
                                <input type="text" placeholder="Main Creator" name="main_creator" value="<?php echo $main_creator; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Added Entry Creator</label>
                                <input type="text" placeholder="Added Entry Creator" name="add_entry_creator" value="<?php echo $add_entry_creator; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Contributors</label>
                                <input type="text" placeholder="Contributors" name="contributors" value="<?php echo $contributors; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Added Entry Corporate</label>
                                <input type="text" placeholder="Added Entry Corporate" name="add_entry_corporate" value="<?php echo $add_entry_corporate; ?>">

                            </div>
                    </div>
                </div>
            </div>

            <div class="tab">
                <div class="details ID">
                    <span class="title">PUBLICATION</span>
                    <div class="fields">
                    <div class="input-field1">
                                <label>Place of Publication</label>
                                <input type="text" placeholder="Place of Publication" name="place_of_publication" value="<?php echo $place_of_publication; ?>" id="place_of_publication">

                            </div>

                            <div class="input-field1">
                                <label>Publisher</label>
                                <input type="text" placeholder="Publisher" name="publisher" value="<?php echo $publisher; ?>">

                            </div>
                            <div class="input-field">
                                <label>Date of Publication</label>
                                <input type="text" placeholder="Date of Publication" name="date_of_publication" value="<?php echo $date_of_publication; ?>">
                            </div>

                            <div class="input-field">
                                <label> Edition</label>
                                <input type="text" placeholder="Edition" name="edition" value="<?php echo $edition; ?>">

                            </div>

                            <div class="input-field">
                                <label> Extend of Text</label>
                                <input type="text" placeholder="Extent of Text" name="extent_of_text" value="<?php echo $extent_of_text; ?>">


                            </div>

                            <div class="input-field">
                                <label> Illustration</label>
                                <input type="text" placeholder="Illustration" name="illustrations" value="<?php echo $illustrations; ?>">


                            </div>

                            <div class="input-field">
                                <label> Dimension </label>
                                <input type="text" placeholder="Dimension" name="dimension" value="<?php echo $dimension; ?>">


                            </div>

                            

                            <div class="input-field">
                                <label> Acc. Materials</label>
                                <input type="text" placeholder="Acc. Materials" name="acc_materials" value="<?php echo $acc_materials; ?>">


                            </div>

                            <div class="input-field1">
                                <label>Series</label>
                                <input type="text" placeholder="Series" name="series" value="<?php echo $series; ?>">

                            </div>

                            <div class="input-field2">
                                <label>Suplementary content</label>      
                                <select name="supp_content">
                                <option <?php if ($supp_content == '') echo 'selected'; ?>></option>
                                    <option <?php if ($supp_content == 'Includes index') echo 'selected';?>>Includes index</option>
                                    <option <?php if ($supp_content == 'Includes bibliographic references') echo 'selected'; ?>>Includes bibliographic references</option>
                                    <option <?php if ($supp_content == 'Includes bibliographic and index') echo 'selected'; ?>>Includes bibliographic and index</option>
                                    <option <?php if ($supp_content == 'Includes bibliographic ') echo 'selected'; ?>>Includes bibliographic</option>
                                </select>

                            </div>

                            <div class="input-field2">
                                <label>Identifier/ISBN</label>
                                <input type="text" placeholder="Identifier/ISBN" name="ISBN" value="<?php echo $ISBN; ?>">


                            </div>
                            <div class="input-field2">
                                <label>Content Type</label>
                                <select name="content_type">
                                    <option <?php if ($content_type == '') echo 'selected'; ?>></option>
                                    <option <?php if ($content_type == 'cartographic dataset') echo 'selected'; ?>>cartographic dataset</option>
                                    <option <?php if ($content_type == 'cartographic image') echo 'selected'; ?>>cartographic image</option>
                                    <option <?php if ($content_type == 'cartographic moving image') echo 'selected'; ?>>cartographic moving image</option>
                                    <option <?php if ($content_type == 'cartographic tactile image') echo 'selected'; ?>>cartographic tactile image</option>
                                    <option <?php if ($content_type == 'cartographic tactile three-dimensional form') echo 'selected'; ?>>cartographic tactile three-dimensional form</option>
                                    <option <?php if ($content_type == 'cartographic three-dimensional form') echo 'selected'; ?>>cartographic three-dimensional form</option>
                                    <option <?php if ($content_type == 'computer dataset') echo 'selected'; ?>>computer dataset</option>
                                    <option <?php if ($content_type == 'computer program') echo 'selected'; ?>>computer program</option>
                                    <option <?php if ($content_type == 'notated movement') echo 'selected'; ?>>notated movement</option>
                                    <option <?php if ($content_type == 'notated music') echo 'selected'; ?>>notated music</option>
                                    <option <?php if ($content_type == 'sounds') echo 'selected'; ?>>sounds</option>
                                    <option <?php if ($content_type == 'spoken word') echo 'selected'; ?>>spoken word</option>
                                    <option <?php if ($content_type == 'still image') echo 'selected'; ?>>still image</option>
                                    <option <?php if ($content_type == 'tactile image') echo 'selected'; ?>>tactile image</option>
                                    <option <?php if ($content_type == 'tactile notated music') echo 'selected'; ?>>tactile notated music</option>
                                    <option <?php if ($content_type == 'tactile notated movement') echo 'selected'; ?>>tactile notated movement</option>
                                    <option <?php if ($content_type == 'tactile text') echo 'selected'; ?>>tactile text</option>
                                    <option <?php if ($content_type == 'tactile three-dimensional form') echo 'selected'; ?>>tactile three-dimensional form</option>
                                    <option <?php if ($content_type == 'text') echo 'selected'; ?>>text</option>
                                    <option <?php if ($content_type == 'three-dimensional form') echo 'selected'; ?>>three-dimensional form</option>
                                    <option <?php if ($content_type == 'three-dimensional moving image') echo 'selected'; ?>>three-dimensional moving image</option>
                                    <option <?php if ($content_type == 'other unspecified') echo 'selected'; ?>>other unspecified</option>
                                    <!-- Add more options here -->
                                </select>
                            </div>

                            <div class="input-field2">
                                <label>Media Type</label>
                                <select name="media_type">
                                    <option <?php if ($media_type == '') echo 'selected'; ?>></option>
                                    <option <?php if ($media_type == 'audio') echo 'selected'; ?>>audio</option>
                                    <option <?php if ($computer == 'computer') echo 'selected'; ?>>computer</option>
                                    <option <?php if ($media_type == 'cartographic moving image') echo 'selected'; ?>>cartographic moving image</option>
                                    <option <?php if ($media_type == 'microform') echo 'selected'; ?>>microform</option>
                                    <option <?php if ($media_type == 'microscopic') echo 'selected'; ?>>microscopic</option>
                                    <option <?php if ($media_type == 'projected') echo 'selected'; ?>>projected</option>
                                    <option <?php if ($media_type == 'stereographic') echo 'selected'; ?>>stereographic</option>
                                    <option <?php if ($media_type == 'unmediated') echo 'selected'; ?>>unmediated</option>
                                    <option <?php if ($media_type == 'video') echo 'selected'; ?>>video</option>
                                    <option <?php if ($media_type == 'other') echo 'selected'; ?>>other</option>
                                    <option <?php if ($media_type == 'unspecified') echo 'selected'; ?>>unspecified</option>
                                </select>
                            </div>


                            <div class="input-field2">
                                <label>Carrier Type</label>
                                <select name="carrier_type">
                                    <option <?php if ($carrier_type == '') echo 'selected'; ?>></option>
                                    <option <?php if ($carrier_type == 'audio cartridge') echo 'selected'; ?>>audio cartridge</option>
                                    <option <?php if ($carrier_type == 'audio cylinder') echo 'selected'; ?>>audio cylinder</option>
                                    <option <?php if ($carrier_type == 'audio disc') echo 'selected'; ?>>audio disc</option>
                                    <option <?php if ($carrier_type == 'aperture card') echo 'selected'; ?>>aperture card</option>
                                    <option <?php if ($carrier_type == 'audio roll') echo 'selected'; ?>>audio roll</option>
                                    <option <?php if ($carrier_type == 'audiocassette') echo 'selected'; ?>>audiocassette</option>
                                    <option <?php if ($carrier_type == 'audiotape reel') echo 'selected'; ?>>audiotape reel</option>
                                    <option <?php if ($carrier_type == 'card') echo 'selected'; ?>>card</option>
                                    <option <?php if ($carrier_type == 'computer card') echo 'selected'; ?>>computer card</option>
                                    <option <?php if ($carrier_type == 'computer chip cartridge') echo 'selected'; ?>>computer chip cartridge</option>
                                    <option <?php if ($carrier_type == 'computer disc') echo 'selected'; ?>>computer disc</option>
                                    <option <?php if ($carrier_type == 'computer disc cartridge') echo 'selected'; ?>>computer disc cartridge</option>
                                    <option <?php if ($carrier_type == 'computer tape cartridge') echo 'selected'; ?>>computer tape cartridge</option>
                                    <option <?php if ($carrier_type == 'computer tape cassette') echo 'selected'; ?>>computer tape cassette</option>
                                    <option <?php if ($carrier_type == 'computer tape reel') echo 'selected'; ?>>computer tape reel</option>
                                    <option <?php if ($carrier_type == 'film cartridge') echo 'selected'; ?>>film cartridge</option>
                                    <option <?php if ($carrier_type == 'film cassette') echo 'selected'; ?>>film cassette</option>
                                    <option <?php if ($carrier_type == 'film reel') echo 'selected'; ?>>film reel</option>
                                    <option <?php if ($carrier_type == 'film roll') echo 'selected'; ?>>film roll</option>
                                    <option <?php if ($carrier_type == 'filmslip') echo 'selected'; ?>>filmslip</option>
                                    <option <?php if ($carrier_type == 'filmstrip') echo 'selected'; ?>>filmstrip</option>
                                    <option <?php if ($carrier_type == 'filmstrip cartridge') echo 'selected'; ?>>filmstrip cartridge</option>
                                    <option <?php if ($carrier_type == 'flipchart') echo 'selected'; ?>>flipchart</option>
                                    <option <?php if ($carrier_type == 'microfiche') echo 'selected'; ?>>microfiche</option>
                                    <option <?php if ($carrier_type == 'microfiche cassette') echo 'selected'; ?>>microfiche cassette</option>
                                    <option <?php if ($carrier_type == 'microfilm cartridge') echo 'selected'; ?>>microfilm cartridge</option>
                                    <option <?php if ($carrier_type == 'microfilm cassette') echo 'selected'; ?>>microfilm cassette</option>
                                    <option <?php if ($carrier_type == 'microfilm reel') echo 'selected'; ?>>microfilm reel</option>
                                    <option <?php if ($carrier_type == 'microfilm roll') echo 'selected'; ?>>microfilm roll</option>
                                    <option <?php if ($carrier_type == 'microfilm slip') echo 'selected'; ?>>microfilm slip</option>
                                    <option <?php if ($carrier_type == 'microfilm slip') echo 'selected'; ?>>microfilm slip</option>
                                    <option <?php if ($carrier_type == 'microopaque') echo 'selected'; ?>>microopaque</option>
                                    <option <?php if ($carrier_type == 'microscope slide') echo 'selected'; ?>>microscope slide</option>
                                    <option <?php if ($carrier_type == 'objecti') echo 'selected'; ?>>objecti</option>
                                    <option <?php if ($carrier_type == 'online resource') echo 'selected'; ?>>online resource</option>
                                    <option <?php if ($carrier_type == 'overhead transparency') echo 'selected'; ?>>overhead transparency</option>
                                    <option <?php if ($carrier_type == 'roll') echo 'selected'; ?>>roll</option>
                                    <option <?php if ($carrier_type == 'slide') echo 'selected'; ?>>slide</option>
                                    <option <?php if ($carrier_type == 'sheet') echo 'selected'; ?>>sheet</option>
                                    <option <?php if ($carrier_type == 'sound track reel') echo 'selected'; ?>>sound track reel</option>
                                    <option <?php if ($carrier_type == 'stereograph card') echo 'selected'; ?>>stereograph card</option>
                                    <option <?php if ($carrier_type == 'stereograph disc') echo 'selected'; ?>>stereograph disc</option>
                                    <option <?php if ($carrier_type == 'volume') echo 'selected'; ?>>volume</option>
                                    <option <?php if ($carrier_type == 'video cartridge') echo 'selected'; ?>>video cartridge</option>
                                    <option <?php if ($carrier_type == 'videocassette') echo 'selected'; ?>>videocassette</option>
                                    <option <?php if ($carrier_type == 'videodisc') echo 'selected'; ?>>videodisc</option>
                                    <option <?php if ($carrier_type == 'videotape reel') echo 'selected'; ?>>videotape reel</option>
                                    <option <?php if ($carrier_type == 'unspecified') echo 'selected'; ?>>unspecified</option>
                                    <!-- Add more options here -->
                                </select>
                            </div>

                            <div class="input-field2">
                                <label>URL</label>
                                <input type="file" name="file">
                                <a href="<?php echo $filepath; ?>" target="_blank">View current file</a>
                            </div>
                    </div>
                </div>
            </div>


            <div class="tab">
                <div class="details personal">
                    <span class="title">SUBJECT ENTRY</span>
                    <div class="fields">
                    <div class="input-field">
                                    <label>Subject</label>
                                    <select name="subject_type">
                                    <option <?php if ($subject_type == '') echo 'selected'; ?>></option>
                                        <option <?php if ($subject_type == 'Topical') echo 'selected'; ?>>Topical</option>
                                        <option <?php if ($subject_type == 'Personal') echo 'selected'; ?>>Personal</option>
                                        <option <?php if ($subject_type == 'Corporate') echo 'selected'; ?>>Corporate</option>
                                        <option <?php if ($subject_type == 'Geographical') echo 'selected'; ?>>Geographical</option>
                                    </select>
                        </div>
                    
                        <div class="input-field1">
    <label>Subject Info</label>
    <textarea placeholder="Subject info" name="subject_info"><?php echo htmlspecialchars($subject_info, ENT_QUOTES, 'UTF-8'); ?></textarea>
</div>
                    </div>
                </div>
            </div>


            <div class="tab">
                <div class="details personal">
                    <span class="title">Content / Abstract / Review </span>
                    <div class="fields">
                    <div class="input-field1">
                        <label>Content notes</label>
                        <textarea placeholder="Content Notes" name="content_notes"><?php echo htmlspecialchars($content_notes, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="input-field1">
                        <label>Abstract</label>
                        <textarea placeholder="Abstract" name="abstract"><?php echo htmlspecialchars($abstract, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="input-field1">
                        <label>Review</label>
                        <textarea placeholder="Review" name="review"><?php echo htmlspecialchars($review, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>
                    </div>
                </div>
            </div>

            <div class="tab">
                <div class="details personal">
                    <span class="title">LOCAL INFORMATION</span>
                    <div class="fields">


<!-- Accession Number -->
<div class="input-field1">
    <span>
        <label>Accession Number</label>
        <input type="button" onclick="addAccessionNumberField()" style="width:50px; height:30px; border:none; font-size: 20px; background-color: #d52033; color: white;" value="&#43;">
    </span>
  
        <input type="text" placeholder="Accession Number" name="accession_number[]" class="responsive-input" required value="<?php echo $accession_number; ?>" readonly />

    <div id="accession_number_error" class="error"></div>
    <div id="accessionNumberFields"></div>
</div>
                        
                    <div class="input-field2">
                    <label>Call Number Prefix.</label>
                                        <select name="call_number_type">
                                        <option <?php if ($call_number_type == '') echo 'selected'; ?>></option>
                                            <option <?php if ($call_number_type == 'BIO') echo 'selected'; ?>>BIO</option>
                                            <option <?php if ($call_number_type == 'CD-ROM') echo 'selected'; ?>>CD-ROM</option>
                                            <option <?php if ($call_number_type == 'CIR') echo 'selected'; ?>>CIR</option>
                                            <option <?php if ($call_number_type == 'FIC') echo 'selected'; ?>>FIC</option>
                                            <option <?php if ($call_number_type == 'FIL') echo 'selected'; ?>>FIL</option>
                                            <option <?php if ($call_number_type == 'REF') echo 'selected'; ?>>REF</option>
                                            <option <?php if ($call_number_type == 'TH') echo 'selected'; ?>>TH</option>
                                        </select>
                        </div>

                        <div class="input-field2">
                                        <label>Call Number</label>
                                        <input type="text" placeholder="Call Number" name="call_number_info" value="<?php echo $call_number_info; ?>">

                                    
                        </div>


                        
                        <div class="input-field2">
                                <label>Language</label>
                                        <select name="language">
                                        <option <?php if ($language == '') echo 'selected'; ?>></option>
                                            <option <?php if ($language == 'English') echo 'selected'; ?>>English </option>
                                            <option <?php if ($language == 'Filipino') echo 'selected'; ?>>Filipino</option>
                                            <option <?php if ($language == 'French') echo 'selected'; ?>>French</option>
                                            <option <?php if ($language == 'German') echo 'selected'; ?>>German</option>
                                            <option <?php if ($language == 'Italian') echo 'selected'; ?>>Italian</option>
                                            <option <?php if ($language == 'Korean') echo 'selected'; ?>>Korean</option>
                                            <option <?php if ($language == 'Latin') echo 'selected'; ?>>Latin</option>
                                            <option <?php if ($language == 'Mandarin') echo 'selected'; ?>>Mandarin</option>
                                            <option <?php if ($language == 'Nihongo') echo 'selected'; ?>>Nihongo</option>
                                            <option <?php if ($language == 'Spanish') echo 'selected'; ?>>Spanish</option>
                            
                                        </select>
                               
                        </div>

                        <div class="input-field2">
                                <label>Library/Location</label>
                
   

                                            <select placeholder="library_location" name="library_location">
                                                <option <?php if ($library_location == '') echo 'selected'; ?>></option>
                                                <option <?php if ($library_location == 'College Library') echo 'selected'; ?>>College Library</option>
                                                <option <?php if ($library_location == 'Grade School Library') echo 'selected'; ?>>Grade School Library</option>
                                                <option <?php if ($library_location == 'Graduate School Library') echo 'selected'; ?>>Graduate School Library</option>
                                                <option <?php if ($library_location == 'High School Library') echo 'selected'; ?>>High School Library</option>
                                                <option <?php if ($library_location == 'Junior High School Library') echo 'selected'; ?>>Junior High School Library</option>
                                                <option <?php if ($library_location == 'Pre-School Library') echo 'selected'; ?>>Pre-School Library</option>
                                                <option <?php if ($library_location == 'Senior High School Library') echo 'selected'; ?>>Senior High School Library</option>
                             
                                            </select>
                        
                               
                        </div>



                    

                        <div class="input-field1">
                      
                                <label>Cover Image file</label>
                                <input type="file" name="f1">
                                <a href="<?php echo $imagepath; ?>" target="_blank">View current file</a>
                            
                        </div>

                        <div class="input-field2">
                                        <label>Entered by</label>
                                        <input type="text" placeholder="Entered by" name="entered_by" value="<?php echo $entered_by; ?>">

                        </div>

                        <div class="input-field2">
                                        <label>Updated by</label>
                                        <input type="text" placeholder="Updated by" name="updated_by" value="<?php echo $updated_by; ?>">
                        </div>



                        <div class="input-field2">
                                        <label>Date Entered</label>
                                        <input type="date" name="date_entered" value="<?php echo $date_entered; ?>">
                        </div>

                        <div class="input-field2">
                                        <label>Date Updated</label>
                                        <input type="date" name="date_updated" value="<?php echo $date_updated; ?>">
                        </div>



                        <div class="input-field2">
                                        <label>Quantity</label>
                                        <input type="number" placeholder="Quantity" name="quantity" value="<?php echo $quantity; ?>">

                        </div>

                        <div class="input-field2">
                                        <label>Available</label>
                                        <input type="number" placeholder="Available" name="available" value="<?php echo $available; ?>">

                        </div>



                        <div class="input-field2">
                                <label>Location</label>
                                <select name="location">
                                <option <?php if ($location == '') echo 'selected'; ?>></option>
                                    <option <?php if ($location == 'General Circulation') echo 'selected'; ?>>General Circulation</option>
                                    <option <?php if ($location == 'Teachers Reference') echo 'selected'; ?>>Teachers Reference</option>
                                    <option <?php if ($location == 'Filipiniana') echo 'selected'; ?>>Filipiniana</option>
                                    <option <?php if ($location == 'Circulation') echo 'selected'; ?>>Circulation</option>
                                    <option <?php if ($location == 'Reference') echo 'selected'; ?>>Reference</option>
                                    <option <?php if ($location == 'Special Collection') echo 'selected'; ?>>Special Collection</option>
                                    <option <?php if ($location == 'Biography') echo 'selected'; ?>>Biography</option>
                                    <option <?php if ($location == 'Reserve') echo 'selected'; ?>>Reserve</option>
                                    <option <?php if ($location == 'Thesis') echo 'selected'; ?>>Thesis</option>
                                    <option <?php if ($location == 'Scholastic') echo 'selected'; ?>>Scholastic</option>
                                    <option <?php if ($location == 'Fiction') echo 'selected'; ?>>Fiction</option>
                                    <option <?php if ($location == 'Special Collection') echo 'selected'; ?>>Special Collection</option>
                                </select>
                        </div>

                        <div class="input-field2">
                                <label>Resource Type</label>
                                <select name="resource_type">
                                <option <?php if ($resource_type == '') echo 'selected'; ?>></option>
                                    <option <?php if ($resource_type == 'Book') echo 'selected'; ?>>Book</option>
                                    <option <?php if ($resource_type == 'Thesis') echo 'selected'; ?>>Thesis</option>
                                    <option <?php if ($resource_type == 'Map') echo 'selected'; ?>>Map</option>
                                </select>
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>

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

<script>
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
</body>
</html>




