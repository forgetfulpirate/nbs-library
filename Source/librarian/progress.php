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
<body>
    
            <div class="container">
                <header>Add Book Module</header>

                <form action="#">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> BOOK CATALOGUE MODULE</span>
                        <div class="fields">
                            <div class="input-field1">
                                <label>Title Proper</label>
                                <input type="text" placeholder="Title Proper" >
                            </div>

                            <div class="input-field1">
                                <label>Responsibility</label>
                                <input type="text" placeholder="Responsibility" >
                            </div>

                            <div class="input-field1">
                                <label>Preffered Title</label>
                                <input type="text" placeholder="Preffered Title" >
                            </div>

                            <div class="input-field1">
                                <label>Parallel Title</label>
                                <input type="text" placeholder="Parallel Title" >
                            </div>

                            <div class="input-field1">
                                <label>Main Creator</label>
                                <input type="text" placeholder="Main Creator" >
                            </div>

                            <div class="input-field1">
                                <label>Added Entry Creator</label>
                                <input type="text" placeholder="Added Entry Creator" >
                            </div>

                            <div class="input-field1">
                                <label>Contributors</label>
                                <input type="text" placeholder="Contributors" >
                            </div>

                            <div class="input-field1">
                                <label>Added Entry Corporate</label>
                                <input type="text" placeholder="Added Entry Corporate">
                            </div>

                            
                        </div>

                        

                               

                                    <button class="nextBtn">
                                        <span class="btnText">Next</span>
                                    </button>
                                
                    </div>
                </div>

 

                <!-- SECOND FORM -->

                <div class="form second">

                        <div class="details ID">
                        <span class="title"> PUBLICATION</span>
                        <div class="fields">

                            <div class="input-field1">
                                <label>Place of Publication</label>
                                <input type="text" placeholder="Place of Publication" >
                            </div>

                            <div class="input-field1">
                                <label>Publisher</label>
                                <input type="text" placeholder="Publisher" >
                            </div>
                            <div class="input-field">
                                <label>Date of Publication</label>
                                <input type="date" placeholder="Date of Publication" >
                            </div>

                            <div class="input-field">
                                <label> Edition</label>
                                <input type="text" placeholder="Edition">
                            </div>

                            <div class="input-field">
                                <label> Extend of Text</label>
                                <input type="text" placeholder="Extend of Text" >

                            </div>

                            <div class="input-field">
                                <label> Dimension </label>
                                <input type="text" placeholder="Dimension" >

                            </div>

                            <div class="input-field">
                                <label> Illustration</label>
                                <input type="text" placeholder="Illustration">

                            </div>

                            <div class="input-field">
                                <label> Acc. Materials</label>
                                <input type="text" placeholder="Acc. Materials" >

                            </div>

                            <div class="input-field1">
                                <label>Series</label>
                                <input type="text" placeholder="Series">
                            </div>

                            <div class="input-field1">
                                <label>Suplementary content</label>
                                <input type="text" placeholder="Suplementary content" >
                            </div>

                            <div class="input-field1">
                                <label>Identifier/ISBN</label>
                                <input type="text" placeholder="Identifier/ISBN" >
                            </div>

                            <div class="input-field1">
                                <label>Content Type</label>
                                <input type="text" placeholder="Content Type" >
                            </div>

                            <div class="input-field1">
                                <label>Media Type</label>
                                <input type="text" placeholder="Media Type" >
                            </div>

                            <div class="input-field1">
                                <label>Carrier Type</label>
                                <input type="text" placeholder="Carrier Type" >
                            </div>

                            <div class="input-field1">
                                <label>URL</label>
                                <input type="text" placeholder="URL" >
                            </div>

                            
                        </div>

                                <div class="buttons">
                                    <div class="backBtn">
                                        <span class="btnText">Back</span>
                                    </div>

                                    <button class="nextBtn">
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
                                    <select placeholder="Title Proper" >
                                        <option>Tropical</option>
                                        <option>Personal</option>
                                        <option>Corporate</option>
                                        <option>Geographical</option>
                                    </select>
                        </div>
                    
                        <div class="input-field1">
                                    <label>Subject Info</label>
                        
                                    <textarea placeholder="Title Proper" >
                                    </textarea>
                        </div>
                        

                    </div>
                            <div class="buttons">
                                <div class="backBtn">
                                    <span class="btnText">Back</span>
                                </div>

                                <button class="nextBtn">
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
                                        <select placeholder="Title Proper" >
                                            <option>Tropical</option>
                                            <option>Personal</option>
                                            <option>Corporate</option>
                                            <option>Geographical</option>
                                            <option>None</option>
                                        </select>
                        </div>

                        <div class="input-field2">
                                        <label>Call Number</label>
                                        <input type="text" placeholder="Call Number" >
                                    
                        </div>

                        <div class="input-field1">
                                <label>Accession Number</label>
                                <input type="text" placeholder="Accession Number" >
                        </div>

                        <div class="input-field1">
                                <label>Language</label>
                                <input type="text" placeholder="Language" >
                        </div>

                        <div class="input-field1">
                                <label>Library/Location</label>
                                <input type="text" placeholder="Library/Location" >
                        </div>

                        <div class="input-field1">
                      
                                <label>Cover Image file</label>
                                <input type="file" >
                            
                        </div>

                        <div class="input-field2">
                                        <label>Entered by</label>
                                        <input type="text" placeholder="Entered by" >
                        </div>

                        <div class="input-field2">
                                        <label>Updated by</label>
                                        <input type="text" placeholder="Updated by" >
                        </div>

                        <div class="input-field2">
                                        <label>Date Entered</label>
                                        <input type="date"  >
                        </div>

                        <div class="input-field2">
                                        <label>Date Updated</label>
                                        <input type="date"  >
                        </div>

                        <div class="input-field2">
                                        <label>Quantity</label>
                                        <input type="number" placeholder="Quantity" >
                        </div>

                        <div class="input-field2">
                                        <label>Available</label>
                                        <input type="number" placeholder="Available" >
                        </div>

                        <div class="input-field2">
                                <label>Location</label>
                                <select placeholder="Title Proper" >
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
                        <div class="buttons">
                            <div class="backBtn">
                                <span class="btnText">Back</span>
                            </div>

                            <button class="nextBtn">
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
                        
                                    <textarea placeholder="Title Proper" >
                                    </textarea>
                        </div>

                        <div class="input-field1">
                                    <label>Abstract</label>
                        
                                    <textarea placeholder="Title Proper" >
                                    </textarea>
                        </div>

                        <div class="input-field1">
                                    <label>Review</label>
                        
                                    <textarea placeholder="Title Proper" >
                                    </textarea>
                        </div>


                        

                    </div>
                            <div class="buttons">
                                <div class="backBtn">
                                    <span class="btnText">Back</span>
                                </div>

                                <button name="submit">
                                    <span >Add Book</span>
                                </button>
                            </div>
                    </div>

            </div>
            <!-- 3rd form end -->
         
            </form>
            
            </div>
       


    
    <?php 
		include 'inc/footer.php';
	 ?>
			
 <script src="inc/js/progress.js"></script>

</body>
</html>
