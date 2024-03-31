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
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="">
            <table class="table">
                <tr>
                    <td>
                        <input type="text" class="form-control" placeholder="Search for books" name="search">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </td>
                </tr>
            </table>
        </form>
        
        <div class="row mt-3">
            <?php
            // Check if search term is provided
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            
            // Prepare SQL query to fetch books with optional search filter
            $sql = "SELECT * FROM ebook";
            if (!empty($search)) {
                $sql .= " WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR program LIKE '%$search%' OR accession_number LIKE '%$search%'";
            }
            
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
