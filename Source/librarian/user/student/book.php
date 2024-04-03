<?php 
    session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'a-books';
    include 'inc/header.php';
    include 'inc/connection.php';
?>
  
<main class="content px-3 py-2">  
  
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>E-Book 
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>
    <div class="card-body">
        <!-- Search Form -->
        <form id="searchForm" method="GET" action="">
            <table class="table">
                <tr>
                    <td>
                        <input type="text" class="form-control" placeholder="Search for books" name="search">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </td>
                    <td> 
                        <select id="entries" name="entries" onchange="submitForm()">
                            <option value="5" <?php if(isset($_GET['entries']) && $_GET['entries'] == 5) echo 'selected'; ?>>5</option>
                            <option value="10" <?php if(isset($_GET['entries']) && $_GET['entries'] == 10) echo 'selected'; ?>>10</option>
                            <option value="20" <?php if(isset($_GET['entries']) && $_GET['entries'] == 20) echo 'selected'; ?>>20</option>
                            <option value="50" <?php if(isset($_GET['entries']) && $_GET['entries'] == 50) echo 'selected'; else echo 'selected'; ?>>50</option>
                        </select>
                        <label for="entries">entries per page</label>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <div class="row mt-3">
        <?php
            // Calculate pagination
            $entriesPerPage = isset($_GET['entries']) ? intval($_GET['entries']) : 50;
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $offset = ($currentPage - 1) * $entriesPerPage;
        
            // Check if search term is provided
            $search = isset($_GET['search']) ? $_GET['search'] : '';
        
            // Prepare SQL query to fetch books with optional search filter and limit
            $sql = "SELECT COUNT(*) as count FROM book";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalBooks = $row['count'];
        
            // Calculate total pages
            $totalPages = ceil($totalBooks / $entriesPerPage);
        
            // Update SQL query to include pagination
            $sql = "SELECT * FROM book";
            if (!empty($search)) {
                $sql .= " WHERE title_of_book LIKE '%$search%' OR author LIKE '%$search%' OR program LIKE '%$search%' OR accession_number LIKE '%$search%'";
            }
            $sql .= " LIMIT $entriesPerPage OFFSET $offset";
        
            // Execute the query
            $res = mysqli_query($link, $sql);

            // Display books
            while ($row = mysqli_fetch_array($res)) {
                ?>
                
                <div class="col-md-12 mb-3">
                    <div class="card d-flex flex-row">
                        <div class="card-body">
                            <h3 class="card-title" style="color:#248fc5; margin-left:50px; margin-top: 20px" ><?php echo $row["title_of_book"];?></h3>
                            <br>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">by <span style='font-weight:bold'><?php echo $row["author"]; ?></span></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">Accession Number: <span style="color:#707070"><?php echo $row["accession_number"]; ?></span></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">Program: <?php echo $row["program"]; ?></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px;">Publisher: <span style="color:#707070"><?php echo $row["publisher"]; ?></span></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px; margin-bottom:5px">Place of Publication: <?php echo $row["place_of_publication"]; ?></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">ISBN: <?php echo $row["ISBN"]; ?></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Call Number: <?php echo $row["call_number"]; ?></p>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Available: <span style="font-weight:bold"><?php echo $row["books_availability"]; echo " ";; echo "copy"; ?></span></p>
                        </div>
                        <img src="../../<?php echo $row["book_image"]; ?>" class="card-img-right" alt="No Cover Available">
                    </div>
                </div>
             
                <?php
            }
        ?>
    </div>
    <!-- Pagination -->

 

</main>


<script>
    function submitForm() {
        document.getElementById("searchForm").submit();
    }
</script>
