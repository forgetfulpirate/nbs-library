<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    $page = 'e-book';
    include 'inc/header.php';
    include 'inc/connection.php';
?>
			
            <main class="content px-3 py-2">
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="mb-3">
                    <h4>Add E-Book</h4>
                </div>
            </div>

            <div class="bstore">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card mb-3">
                        <div class="card-body">
                            <input type="text" class="form-control mb-2" name="accession_number" placeholder="Accession Number" required="">
                            <input type="file" class="form-control mb-2" name="f1" required="">
                            <input type="text" class="form-control mb-2" name="program" placeholder="Program" required="">
                            <input type="text" class="form-control mb-2" name="title" placeholder="Title" required="">
                            <input type="text" class="form-control mb-2" name="author" placeholder="Author" required="">
                            <input type="text" class="form-control mb-2" name="place_of_publication" placeholder="Place of Publication" required="">
                            <input type="text" class="form-control mb-2" name="ISBN" placeholder="ISBN" required="">
                            <input type="text" class="form-control mb-2" name="copyright" placeholder="Copyright" required="">
                            <input type="text" class="form-control mb-2" name="publisher" placeholder="Publisher" required="">
                            <input type="text" class="form-control mb-2" name="link" placeholder="Link" required="">
                        </div>
                    </div>

                    <div class="submit mt-3">
                        <input type="submit" name="submit" class="btn btn-info submit" value="Add Book">
                    </div>
                </form>

                <?php
                    if (isset($_POST["submit"])) {
                        $image_name = $_FILES['f1']['name'];
                        $temp = explode(".", $image_name);
                        $newfilename = round(microtime(true)) . '.' . end($temp);
                        $imagepath = "books-image/" . $newfilename;
                        
                        if(move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath)) {
                            $query = mysqli_query($link, "INSERT INTO ebook (accession_number, book_image, program, title, author, place_of_publication, ISBN, copyright, publisher, link) VALUES ('$_POST[accession_number]', '$imagepath', '$_POST[program]', '$_POST[title]', '$_POST[author]', '$_POST[place_of_publication]', '$_POST[ISBN]', '$_POST[copyright]', '$_POST[publisher]', '$_POST[link]')");
                            
                            if ($query) {
                                echo '<div class="alert alert-success mt-3" role="alert">Book added successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger mt-3" role="alert">Error: Unable to add book.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Error: Unable to upload book image.</div>';
                        }
                    }
                ?>
            </div>				
        </div>					

</main>
<?php 
		include 'inc/footer.php';
	 ?>


