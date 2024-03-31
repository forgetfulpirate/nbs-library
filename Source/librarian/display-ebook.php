
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'd-ebook';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>
            
    
            <main class="content px-3 py-2">
            
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table text-right table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>
                                        <th class="col">Books image</th>
                                        <th scope="col">Accession Number</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Place of Publication</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Copyright</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Link</th>
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from ebook");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; ?><img src="<?php echo $row["book_image"]; ?> " height="100" width="80" alt=""> <?php echo "</td>";
                                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                            echo "<td>"; echo $row["program"]; echo "</td>";
                                            echo "<td>"; echo $row["title"]; echo "</td>";
                                            echo "<td>"; echo $row["author"]; echo "</td>";
                                            echo "<td>"; echo $row["place_of_publication"]; echo "</td>";
                                            echo "<td>"; echo $row["ISBN"]; echo "</td>";
                                            echo "<td>"; echo $row["copyright"]; echo "</td>";
                                            echo "<td>"; echo $row["publisher"]; echo "</td>";
                                            echo "<td>"; ?><a href="<?php echo $row["link"]; ?>" target="_blank"><?php echo $row["link"]; ?></a><?php echo "</td>";
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
	
    
