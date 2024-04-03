<?php 
    session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'ebooks';
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
                            <option value="50" <?php if(isset($_GET['entries']) && $_GET['entries'] == 50) echo 'selected'; ?>>50</option>
                        </select>
                        <label for="entries">entries per page</label>
                    </td>
                </tr>
            </table>
        </form>
    </div>
  
    
        <div class="row mt-3">
        <?php
    // Check if search term is provided
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Check if number of entries per page is provided
    $entries = isset($_GET['entries']) ? intval($_GET['entries']) : 10; // Default to 10 entries per page

    // Prepare SQL query to fetch books with optional search filter and limit
    $sql = "SELECT * FROM ebook";
    if (!empty($search)) {
        $sql .= " WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR program LIKE '%$search%' OR accession_number LIKE '%$search%'";
    }
    $sql .= " LIMIT $entries";

    // Execute the query
    $res = mysqli_query($link, $sql);

    // Display books
    while ($row = mysqli_fetch_array($res)) {
        echo '<div class="col-md-12 mb-3">';
        echo '<div class="card d-flex flex-row">';
        echo '<img src="../../'.$row["book_image"] . '" class="card-img-center" width=200 alt="No Cover Available">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["title"] . '</h5>';
        echo '<p class="card-text">Accession Number: ' . $row["accession_number"] . '</p>';
        echo '<p class="card-text">Program: ' . $row["program"] . '</p>';
        echo '<p class="card-text">Author: ' . $row["author"] . '</p>';
        echo '<p class="card-text">Place of Publication: ' . $row["place_of_publication"] . '</p>';
        echo '<p class="card-text">ISBN: ' . $row["ISBN"] . '</p>';
        echo '<p class="card-text">Copyright: ' . $row["copyright"] . '</p>';
        echo '<p class="card-text">Publisher: ' . $row["publisher"] . '</p>';
        echo '<a href="' . $row["link"] . '" class="btn btn-primary mt-auto" target="_blank">Read</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
    ?>
        </div>
    </div>
</main>

<script>
    function submitForm() {
        document.getElementById("searchForm").submit();
    }
</script>
