<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'abook';
    include 'inc/header.php';
    include 'inc/connection.php';

    // Check if ID is provided in the URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch book details based on ID
        $query = "SELECT * FROM add_book WHERE id = $id";
        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $booksname = $row['books_name'];
            $bauthorname = $row['books_author_name'];
            $bpubname = $row['books_publication_name'];
            $bpurcdate = $row['books_purchase_date'];
            $bprice = $row['books_price'];
            $bquantity = $row['books_quantity'];
            $bavailability = $row['books_availability'];
            $imagepath = $row['books_image'];
            $filepath = $row['books_file'];
        } else {
            echo "Book not found!";
            exit();
        }
        } else {
        echo "Book ID not provided!";
        exit();
        }

 

 
 ?>


<!-- Edit book form -->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left">
                        <p><span>Edit Book</span>Control panel</p>
                    </div>
                </div>
            </div>
            <div class="bstore">
                
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <table class="table table-bordered">
                        <tr>
                            
                            <td>
                   
                                <input type="text" class="form-control" name="booksname" placeholder="Books name" value="<?php echo $booksname; ?>" required=""> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Books image
                                <input type="file" class="form-control" name="f1">
                                <img src="<?php echo $imagepath; ?>" height="100" width="100" alt="Book Image">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Books file
                                <input type="file" class="form-control" name="file" >
                                <a href="<?php echo $filepath; ?>" target="_blank">View current file</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bauthorname" placeholder="Books author name" value="<?php echo $bauthorname; ?>" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bpubname" placeholder="Books publication name" value="<?php echo $bpubname; ?>" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bpurcdate" placeholder="Books purchase date" value="<?php echo $bpurcdate; ?>" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bprice" placeholder="Books price" value="<?php echo $bprice; ?>" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bquantity" placeholder="Books quantity" value="<?php echo $bquantity; ?>" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bavailability" placeholder="Books availability" value="<?php echo $bavailability; ?>" required="">
                            </td>
                        </tr>
                    </table>
                    <div class="submit mt-20">
                        <input type="submit" name="submit" class="btn btn-info submit" value="Update Book">
                    </div>
                </form>
            </div>              
        </div>                  
    </div>
</div>

<?php
    if (isset($_POST["submit"])) {
        $id = $_POST['id'];
        $booksname = $_POST['booksname'];
        $bauthorname = $_POST['bauthorname'];
        $bpubname = $_POST['bpubname'];
        $bpurcdate = $_POST['bpurcdate'];
        $bprice = $_POST['bprice'];
        $bquantity = $_POST['bquantity'];
        $bavailability = $_POST['bavailability'];

        // Handle image upload
        if($_FILES['f1']['name'] != "") {
            $image_name=$_FILES['f1']['name'];
            $temp = explode(".", $image_name);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imagepath="books-image/".$newfilename;
            move_uploaded_file($_FILES["f1"]["tmp_name"],$imagepath);
            $imagepath_update = ", books_image='$imagepath'";
        } else {
            $imagepath_update = "";
        }

        // Handle file upload
        if($_FILES['file']['name'] != "") {
            $file_name=$_FILES['file']['name'];
            $temp2 = explode(".", $file_name);
            $newfilename2 = round(microtime(true)) . '.' . end($temp2);
            $filepath="books-file/".$newfilename2;
            move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);
            $filepath_update = ", books_file='$filepath'";
        } else {
            $filepath_update = "";
        }

        // Update book details in database
        $query = "UPDATE add_book SET books_name='$booksname', books_author_name='$bauthorname', books_publication_name='$bpubname', books_purchase_date='$bpurcdate', books_price='$bprice', books_quantity='$bquantity', books_availability='$bavailability' $imagepath_update $filepath_update WHERE id=$id";
        $result = mysqli_query($link, $query);

        if($result) {
            echo "<script>alert('Book updated successfully');</script>";
            echo "<script>window.location='display-books.php';</script>";
        } else {
            echo "<script>alert('Failed to update book');</script>";
            echo "<p>Error updating book. Please try again.</p>";
        }
    }
?>

<?php include 'inc/footer.php'; ?>
