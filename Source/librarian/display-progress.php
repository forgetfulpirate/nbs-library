
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 't-book';
    include 'inc/connection.php';
    include 'inc/header.php';

    $message = "";

    if(isset($_GET['message'])) {
        $message = $_GET['message'];
    }

 ?>
 
            
            
            <main class="content px-3 py-2">
            
            
            <div class="card border-0">
                
                  
                 
                        <div class="card-body" >
                            <table class="table table-hover text-center" id="dtBasicExample">
                                
                                <thead>
                                    <tr >
                              
                                    <th class="col">Books image</th>
                                    <th class="col">Accession Number</th>
                                    <th class="col">Book name</th>
                                    <th class="col">Place of Publication</th>
                                    <th class="col">Publisher</th>
                                    <th class="col">Books quantity</th>
                                    <th class="col">Books availability</th>
                                    <th class="col">View</th>
                                    <th class="col">Edit</th>
                                    <th class="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $res = mysqli_query($link, "select * from book_module");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                                    echo "<td>"; ?><img src="<?php echo $row["book_image"]; ?> " height="100" width="80" alt=""> <?php echo "</td>";
                                    echo "<td>";                            
                                    echo $row["accession_number"];
                                    echo "</td>";
                                    echo "<td>";                            
                                    echo $row["title_proper"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["place_of_publication"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["publisher"];
                                    echo "</td>";
                   
                                    echo "<td>";
                                    echo $row["quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["available"];
                                    echo "</td>";
                                    echo "<td>";
                                    ?>
                                    <a href="display-book-info.php?id=<?php echo $row["id"];?> " class="btn btn-primary"  id="edit">View</a><?php
                                    
                                    echo "</td>";
                                     echo "<td>";
                                    ?>
                          
                                    <span style="marigin-right=20px;"><a href="edit-book-module.php?id=<?php echo $row["id"]; ?>"  class="btn btn-primary" id="edit">Edit</a></span><?php
                                    
                                    echo "</td>";   echo "</td>";
                                    echo "<td>";
                                   ?>
                                   <a href="delete-book.php?id=<?php echo $row["id"];?> " class="btn btn-primary"  id="edit1">Delete</a><?php
                                   
                                   echo "</td>";
                                    
                                    
                                    echo "</tr>";
                                }
                                 ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                
                

        
                    </main>

             



   


    



    <script>
        $(document).ready(function () {
            
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
                buttons:['copy','csv','excel','pdf', 'print'],
                "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]]
            }); 
        });
    </script>	

<?php 
		include 'inc/footer.php';
	 ?>





