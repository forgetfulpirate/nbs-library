
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'tbook';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>

    
            <main class="content px-3 py-2">
            
            <div class="card border-0">
                
                  
                 
                        <div class="card-body">
                            <table class="table text-center table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>
                              
                                    <th class="col">Books image</th>
                                    <th class="col">Books name</th>
                                    <th class="col">Author name</th>
                                    <th class="col">Publication name</th>
                                    <th class="col">Purchase date</th>
                                    <th class="col">Books price</th>
                                    <th class="col">Books quantity</th>
                                    <th class="col">Books availability</th>
                                    <th class="col">Delete book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $res = mysqli_query($link, "select * from add_book");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                                    echo "<td>"; ?><img src="<?php echo $row["books_image"]; ?> " height="100" width="100" alt=""> <?php echo "</td>";
                                    echo "<td>";                            
                                    echo $row["books_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_author_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_publication_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_purchase_date"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_price"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_availability"];
                                    echo "</td>";
                                     echo "<td>";
                                    ?><a href="delete-book.php?id=<?php echo $row["id"]; ?> "><i class="fas fa-trash"></i></a><?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                 ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                </div>
            
            </main>

        

        </div>
    </div>
    


    



    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>		




