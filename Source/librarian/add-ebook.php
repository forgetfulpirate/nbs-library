<?php 
		 session_start();
		if (!isset($_SESSION["username"])) {
            ?>
                <script type="text/javascript">
                    window.location="login.php";
                </script>
            <?php
        }
        $page = 'a-e-book';
        include 'inc/header.php';
        include 'inc/connection.php';
	 ?>
			
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					  <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Add E-Book  
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>
				
				<div class="bstore">
					<form action="" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    Accession Number
                                   <input type="text" class="form-control" name="accession_number" placeholder="Accession Number" required=""> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    E-Book image
                                    <input type="file" class="form-control" name="f1" required="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Program
                                   <input type="text" class="form-control" name="program" placeholder="Program" required=""> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    Title
                                   <input type="text" class="form-control" name="title" placeholder="title" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Author
                                   <input type="text" class="form-control" name="author" placeholder="Author" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Place of Publication
                                   <input type="text" class="form-control" name="place_of_publication" placeholder=" Place of Publication" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    ISBN
                                   <input type="text" class="form-control" name="ISBN" placeholder="ISBN" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Copyright
                                   <input type="text" class="form-control" name="copyright" placeholder="Copyright" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Publisher
                                   <input type="text" class="form-control" name="publisher" placeholder="Publisher" required=""> 
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Link
                                   <input type="text" class="form-control" name="link" placeholder="Link" required=""> 
                                </td>
                            </tr>
                        </table>
                        <div class="submit mt-20">
                        	<input type="submit" name="submit" class="btn btn-info submit" value="Add Book">
                        </div>
                	</form>
                    <br>
				</div>				
			</div>					
		</div>
	</div>

        <?php

            if (isset($_POST["submit"])) {

                $image_name=$_FILES['f1']['name'];
   
                $temp = explode(".", $image_name);
            
                $newfilename = round(microtime(true)) . '.' . end($temp);

                $imagepath="books-image/".$newfilename;
      
                move_uploaded_file($_FILES["f1"]["tmp_name"],$imagepath);
    

      
                mysqli_query($link, "INSERT INTO ebook (accession_number, book_image, program, title, author, place_of_publication, ISBN, copyright, publisher, link) VALUES ('$_POST[accession_number]', '$imagepath', '$_POST[program]', '$_POST[title]', '$_POST[author]', '$_POST[place_of_publication]', '$_POST[ISBN]', '$_POST[copyright]', '$_POST[publisher]', '$_POST[link]')");

            }
        ?>
			
