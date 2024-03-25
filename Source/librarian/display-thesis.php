
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
                              
                                        <th scope="col">Accession Number</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Pages</th>
                                        <th scope="col">Place of Publication</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Call Number</th>
                                        <th scope="col">remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from theses");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                            echo "<td>"; echo $row["title"]; echo "</td>";
                                            echo "<td>"; echo $row["author"]; echo "</td>";
                                            echo "<td>"; echo $row["pages"]; echo "</td>";
                                            echo "<td>"; echo $row["place_of_publication"]; echo "</td>";
                                            echo "<td>"; echo $row["date"]; echo "</td>";
                                            echo "<td>"; echo $row["course"]; echo "</td>";
                                            echo "<td>"; echo $row["call_number"]; echo "</td>";
                                            echo "<td>"; echo $row["remarks"]; echo "</td>";
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
