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
    
            // Fetch book details based on ID
            $query = "SELECT * FROM book_module WHERE accession_number = $accession_number";
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
    <title>NBS Library</title>
    <link rel="stylesheet" href="inc/css/progress.css">
</head>
<body>
    
            <div class="container">
                <header>Add Book Module</header>

                <form action="#" method="post" enctype="multipart/form-data">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> BOOK CATALOGUE MODULE</span>
                        <div class="fields">
                            <div class="input-field1">
                                <label>Title Proper</label>
                                <input type="text" placeholder="Title Proper" name="title_proper" required="" value="<?php echo $row['title_proper']; ?>">
                            </div>

                            <div class="input-field1">
                                <label>Responsibility</label>
                                <input type="text" placeholder="Responsibility" name="responsibility" required="" value="<?php echo $responsibility; ?>">
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

                        <button type="button" class="nextBtn">
                            <span class="btnText">Next</span>
                        </button>
                                                        
                    </div>
                </div>

                <!-- END FIRST FORM -->

 

                <!-- SECOND FORM -->

                <div class="form second">

                        <div class="details ID">
                        <span class="title"> PUBLICATION</span>
                        <div class="fields">

                            <div class="input-field1">
                                <label>Place of Publication</label>
                                <input type="text" placeholder="Place of Publication" name="place_of_publication" value="<?php echo $place_of_publication; ?>">

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

                            <div class="input-field1">
                                <label>Suplementary content</label>
                                <input type="text" placeholder="Supplementary Content" name="supp_content" value="<?php echo $supp_content; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Identifier/ISBN</label>
                                <input type="text" placeholder="Identifier/ISBN" name="ISBN" value="<?php echo $ISBN; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Content Type</label>
                                <input type="text" placeholder="Content Type" name="content_type" value="<?php echo $content_type; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Media Type</label>
                                <input type="text" placeholder="Media Type" name="media_type" value="<?php echo $media_type; ?>">

                            </div>

                            <div class="input-field1">
                                <label>Carrier Type</label>
                                <input type="text" placeholder="Carrier Type" name="carrier_type" value="<?php echo $carrier_type; ?>">

                            </div>

                            <div class="input-field1">
                                <label>URL</label>
                                <input type="file" name="file">
                                <a href="<?php echo $filepath; ?>" target="_blank">View current file</a>
                            </div>

                            
                        </div>

                                <div class="buttons">
                                    <div class="backBtn">
                                        <span class="btnText">Back</span>
                                    </div>

                                    <button type="button" class="nextBtn">
                            <span class="btnText">Next</span>
                        </button>
                                </div>
                        </div>

                       
            </div> 
            <!--  SECOND FORM END  -->

            <!-- 3RD  FORM -->

            <div class="form third">

                    <div class="details ID">
                    <span class="title"> SUBJECT ENTRY</span>
                    <div class="fields">

                        <div class="input-field">
                                    <label>Subject</label>
                                    <select name="subject_type">
                                        <option <?php if ($subject_type == 'Tropical') echo 'selected'; ?>>Tropical</option>
                                        <option <?php if ($subject_type == 'Personal') echo 'selected'; ?>>Personal</option>
                                        <option <?php if ($subject_type == 'Corporate') echo 'selected'; ?>>Corporate</option>
                                        <option <?php if ($subject_type == 'Geographical') echo 'selected'; ?>>Geographical</option>
                                    </select>
                        </div>
                    
                        <div class="input-field1">
                                    <label>Subject Info</label>
                        
                                    <textarea name="subject_info" >
                                    <?php echo htmlspecialchars($subject_info, ENT_QUOTES, 'UTF-8'); ?>
                                    </textarea>
                        </div>
                        

                    </div>
                            <div class="buttons">
                                <div class="backBtn">
                                    <span class="btnText">Back</span>
                                </div>

                                <button type="button" class="nextBtn">
                            <span class="btnText">Next</span>
                        </button>
                            </div>
                    </div>

            </div>
            <!-- 3rd form end -->

              <!-- FOURTH  FORM -->

              <div class="form fourth">

                <div class="details ID">
                <span class="title"> LOCAL INFORMATION</span>
                <div class="fields">

                        <div class="input-field2">
                                        <label>Call Number</label>
                                        <select name="call_number_type">
                                            <option <?php if ($call_number_type == 'Tropical') echo 'selected'; ?>>Tropical</option>
                                            <option <?php if ($call_number_type == 'Personal') echo 'selected'; ?>>Personal</option>
                                            <option <?php if ($call_number_type == 'Corporate') echo 'selected'; ?>>Corporate</option>
                                            <option <?php if ($call_number_type == 'Geographical') echo 'selected'; ?>>Geographical</option>
                                            <option <?php if ($call_number_type == 'None') echo 'selected'; ?>>None</option>
                                        </select>
                        </div>

                        <div class="input-field2">
                                        <label>Call Number</label>
                                        <input type="text" placeholder="Call Number" name="call_number_info" value="<?php echo $call_number_info; ?>">

                                    
                        </div>

                        <div class="input-field1">
                                <label>Accession Number</label>
                                <input type="text" placeholder="Accession Number" name="accession_number" value="<?php echo $accession_number; ?>" readonly>

                        </div>

                        <div class="input-field1">
                                <label>Language</label>
                                <input type="text" placeholder="Language" name="language" value="<?php echo $language; ?>">
                        </div>

                        <div class="input-field1">
                                <label>Library/Location</label>
                                <input type="text" placeholder="Library/Location" name="library_location" value="<?php echo $library_location; ?>">
                        </div>

                        
                        <div class="input-field1">
                                <label>Electronic Access</label>
                                <input type="text" placeholder="Electronic Access" name="electronic_access" value="<?php echo $electronic_access; ?>">
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
                                    <option <?php if ($location == 'General Circulation') echo 'selected'; ?>>General Circulation</option>
                                    <option <?php if ($location == 'Teachers Reference') echo 'selected'; ?>>Teachers Reference</option>
                                    <option <?php if ($location == 'Filipiniana') echo 'selected'; ?>>Filipiniana</option>
                                    <option <?php if ($location == 'Circulation') echo 'selected'; ?>>Circulation</option>
                                    <option <?php if ($location == 'Reference') echo 'selected'; ?>>Reference</option>
                                    <option <?php if ($location == 'Special Collection') echo 'selected'; ?>>Special Collection</option>
                                    <option <?php if ($location == 'Biography') echo 'selected'; ?>>Biography</option>
                                    <option <?php if ($location == 'Reserve') echo 'selected'; ?>>Reserve</option>
                                    <option <?php if ($location == 'Scholastic') echo 'selected'; ?>>Scholastic</option>
                                    <option <?php if ($location == 'Fiction') echo 'selected'; ?>>Fiction</option>
                                    <option <?php if ($location == 'Special Collection') echo 'selected'; ?>>Special Collection</option>
                                </select>
                            </div>



                </div>
                        <div class="buttons">
                            <div class="backBtn">
                                <span class="btnText">Back</span>
                            </div>

                            <button type="button" class="nextBtn">
                            <span class="btnText">Next</span>
                        </button>
                        </div>
                </div>

                </div>
                <!-- fORTH form end -->

                            <!-- Fifth  FORM -->

            <div class="form fifth">

                    <div class="details ID">
                    <span class="title"> SUBJECT ENTRY</span>
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
                            <div class="buttons">
                                <div class="backBtn">
                                    <span class="btnText">Back</span>
                                </div>

                                <button name="submit">
                                    <span >Edit Book</span>
                                </button>
                            </div>
                    </div>

            </div>
            <!-- FIFTH form end -->
         
            </form>
            
            </div>

            <?php
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
                
                    // Handle image upload
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
                        echo "<script>alert('Book updated successfully');</script>";
                    } else {
                        echo "<script>alert('Failed to update book');</script>";
                        echo "<p>Error updating book. Please try again.</p>";
                    }
                }
                
            ?>





    
    <?php 
		include 'inc/footer.php';
	 ?>
			
 <script src="inc/js/progress.js"></script>

</body>
</html>
