<?php 
    session_start();

    $page = 'a-books';
    include 'inc/header.php';
    include 'inc/connection.php';
?>



<?php
    // Check if search term is provided
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Calculate pagination
    $entriesPerPage = 50;
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($currentPage - 1) * $entriesPerPage;

    // Prepare SQL query to fetch books with optional search filter and limit
    $sqlCount = "SELECT COUNT(*) as count FROM book";
    if (!empty($search)) {
        $sqlCount .= " WHERE title_of_book LIKE '%$search%' OR author LIKE '%$search%' OR program LIKE '%$search%' OR accession_number LIKE '%$search%'";
    }
    $resultCount = mysqli_query($link, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalBooks = $rowCount['count'];

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
?>



<main class="content px-3 py-2">  
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Book
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
                </tr>
            </table>
        </form>
    </div>
    

<!-- Pagination -->
<div class="row mt-3">
    <div class="col-md-12">
    <div class="pagination-container">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                    // First page
                    if ($currentPage > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?page=1" . (!empty($search) ? "&search=$search" : "") . "'>&laquo; First </a></li>";
                    }

                    // Previous page
                    if ($currentPage > 1) {
                        $prevPage = $currentPage - 1;
                        echo "<li class='page-item'><a class='page-link' href='?page=$prevPage" . (!empty($search) ? "&search=$search" : "") . "'> Previous</a></li>";
                    }

                    // Page numbers
                    $startPage = max(1, $currentPage - 5);
                    $endPage = min($totalPages, $startPage + 9);
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        echo "<li class='page-item " . ($currentPage == $i ? "active" : "") . "'><a class='page-link' href='?page=$i" . (!empty($search) ? "&search=$search" : "") . "'>$i</a></li>";
                    }

                    // Next page
                    if ($currentPage < $totalPages) {
                        $nextPage = $currentPage + 1;
                        echo "<li class='page-item'><a class='page-link' href='?page=$nextPage" . (!empty($search) ? "&search=$search" : "") . "'>Next</a></li>";
                    }

                    // Last page
                    if ($currentPage < $totalPages) {
                        echo "<li class='page-item'><a class='page-link' href='?page=$totalPages" . (!empty($search) ? "&search=$search" : "") . "'>Last &raquo; </a></li>";
                    }
                ?>
            </ul>
                </div>
        </nav>
    </div>

    
</div>



<div class="row mt-3">
    <?php
        // Display books
        while ($row = mysqli_fetch_array($res)) {
            // Determine availability message
            $availabilityMessage = ($row["books_availability"] > 0) ? "Available for loan" : "Not available for loan";
    ?>
    <div class="col-md-12 mb-3">
        <div class="card d-flex flex-row">
            <div class="card-body">
                <h3 class="card-title" style="color:#248fc5; margin-left:50px; margin-top: 20px"><?php echo $row["title_of_book"];?></h3>
                <br>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">by <span style='font-weight:bold'><?php echo $row["author"]; ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">Accession Number: <span style="color:#707070"><?php echo $row["accession_number"]; ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">Program: <?php echo $row["program"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px;">Publisher: <span style="color:#707070"><?php echo $row["publisher"]; ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px; margin-bottom:5px">Place of Publication: <?php echo $row["place_of_publication"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">ISBN: <?php echo $row["ISBN"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Call Number: <?php echo $row["call_number"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Available: <span style="font-weight:bold"><?php echo $availabilityMessage; ?></span></p>
            </div>
            <img src="../../<?php echo $row["book_image"]; ?>" class="card-img-right" alt="No Cover Available">
        </div>
    </div>
    <?php
        }
    ?>
</div>
    
</main>

<script>
    function submitForm() {
        document.getElementById("searchForm").submit();
    }

    document.querySelectorAll('.sort-option').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault(); // Prevent default link behavior
            let sortValue = item.getAttribute('data-sort'); // Get the sort value
            // Append sort value to the current URL and submit the form
            let currentURL = window.location.href;
            if (currentURL.includes('?')) {
                currentURL += `&sort=${sortValue}`;
            } else {
                currentURL += `?sort=${sortValue}`;
            }
            window.location.href = currentURL;
        });
    });
</script>
