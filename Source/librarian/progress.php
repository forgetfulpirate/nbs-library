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
                <header>Title Proper</header>

                <form action="#">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> BOOK CATALOGUE MODULE</span>
                        <div class="fields">
                            <div class="input-field1">
                                <label>Title Proper</label>
                                <input type="text" placeholder="Title Proper" required="">
                            </div>

                            <div class="input-field1">
                                <label>Responsibility</label>
                                <input type="text" placeholder="Responsibility" required="">
                            </div>

                            <div class="input-field1">
                                <label>Preffered Title</label>
                                <input type="text" placeholder="Preffered Title" required="">
                            </div>

                            <div class="input-field1">
                                <label>Parallel Title</label>
                                <input type="text" placeholder="Parallel Title required="">
                            </div>

                            <div class="input-field1">
                                <label>Main Creator</label>
                                <input type="text" placeholder="Main Creator" required="">
                            </div>

                            <div class="input-field1">
                                <label>Added Entry Creator</label>
                                <input type="text" placeholder="Added Entry Creator" required="">
                            </div>

                            <div class="input-field1">
                                <label>Contributors</label>
                                <input type="text" placeholder="Contributors" required="">
                            </div>

                            <div class="input-field1">
                                <label>Added Entry Corporate</label>
                                <input type="text" placeholder="Added Entry Corporate" required="">
                            </div>

                            
                        </div>

                        

                               

                                    <button class="nextBtn">
                                        <span class="btnText">Next</span>
                                    </button>
                                
                    </div>
                </div>

 

                <!-- NEXT FORM -->

                <div class="form second">

                        <div class="details ID">
                        <span class="title"> PUBLICATION</span>
                        <div class="fields">

                            <div class="input-field1">
                                <label>Place of Publication</label>
                                <input type="text" placeholder="Place of Publication" required="">
                            </div>

                            <div class="input-field1">
                                <label>Publisher</label>
                                <input type="text" placeholder="Publisher" required="">
                            </div>
                            <div class="input-field">
                                <label>Date of Publication</label>
                                <input type="date" placeholder="Date of Publication" required="">
                            </div>

                            <div class="input-field">
                                <label> Edition</label>
                                <input type="text" placeholder="Edition" required="">
                            </div>

                            <div class="input-field">
                                <label> Extend of Text</label>
                                <input type="text" placeholder="Extend of Text" required="">

                            </div>

                            <div class="input-field">
                                <label> Dimension </label>
                                <input type="text" placeholder="Dimension" required="">

                            </div>

                            <div class="input-field">
                                <label> Illustration</label>
                                <input type="text" placeholder="Illustration" required="">

                            </div>

                            <div class="input-field">
                                <label> Acc. Materials</label>
                                <input type="text" placeholder="Acc. Materials" required="">

                            </div>

                            <div class="input-field1">
                                <label>Series</label>
                                <input type="text" placeholder="Series" required="">
                            </div>

                            <div class="input-field1">
                                <label>Suplementary content</label>
                                <input type="text" placeholder="Suplementary content" required="">
                            </div>

                            <div class="input-field1">
                                <label>Identifier/ISBN</label>
                                <input type="text" placeholder="Identifier/ISBN" required="">
                            </div>

                            <div class="input-field1">
                                <label>Content Type</label>
                                <input type="text" placeholder="Content Type" required="">
                            </div>

                            <div class="input-field1">
                                <label>Media Type</label>
                                <input type="text" placeholder="Media Type" required="">
                            </div>

                            <div class="input-field1">
                                <label>Carrier Type</label>
                                <input type="text" placeholder="Carrier Type" required="">
                            </div>

                            <div class="input-field1">
                                <label>URL</label>
                                <input type="text" placeholder="URL" required="">
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
                
            </form>
            
            </div>
       


    
    <?php 
		include 'inc/footer.php';
	 ?>
			
 <script src="inc/js/progress.js"></script>

</body>
</html>
