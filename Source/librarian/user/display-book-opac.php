<?php 
    session_start();
  
    $page = 'a-books';
    include 'inc/header.php';
    include 'inc/connection.php';
?>
  <style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }  
    #ul #li a:hover {
    text-decoration: underline;

}
<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }  
    #ul #li a:hover {
    text-decoration: underline;

}
</style>
<?php
// Check if search term and keyword are provided
// Check if search term and keyword are provided
$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : 'all';
$searchQuerySubmitted = !empty($search);

// Calculate pagination
if ($searchQuerySubmitted) {
    $entriesPerPage = 5;
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($currentPage - 1) * $entriesPerPage;

    // Prepare SQL query to fetch books with optional search filter and limit
    $sqlCount = "SELECT COUNT(*) as count FROM book_module";
    $sql = "SELECT * FROM book_module";
    $searchConditions = []; // Array to hold individual search conditions

    if (!empty($search)) {
        $searchTerms = explode(" ", $search); // Split the search string into an array of terms

        foreach ($searchTerms as $term) {
            $term = mysqli_real_escape_string($link, $term); // Escape the search term
            switch ($keyword) {
                case 'title':
                    $searchConditions[] = "title_proper LIKE '%$term%'";
                    break;
                case 'author':
                    $searchConditions[] = "main_creator LIKE '%$term%'";
                    break;
                case 'call_number':
                    $searchConditions[] = "call_number_info LIKE '%$term%'";
                    break;
                case 'isbn':
                    $searchConditions[] = "ISBN LIKE '%$term%'";
                    break;
                default:
                    $searchConditions[] = "(title_proper LIKE '%$term%' OR main_creator LIKE '%$term%' OR call_number_info LIKE '%$term%' OR ISBN LIKE '%$term%')";
                    break;
            }
        }
    }

    // Join search conditions using AND operator
    $searchConditionString = implode(" AND ", $searchConditions);

    if (!empty($searchConditionString)) {
        $sqlCount .= " WHERE $searchConditionString";
        $sql .= " WHERE $searchConditionString";
    }

    // Calculate total books
    $resultCount = mysqli_query($link, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalBooks = $rowCount['count'];

    // Calculate total pages
    $totalPages = ceil($totalBooks / $entriesPerPage);

    // Update SQL query to include pagination
    $sql .= " LIMIT $entriesPerPage OFFSET $offset";

    // Execute the query
    $res = mysqli_query($link, $sql);
}
?>


<main class="content px-3 py-2">  
    <div class="gap-30"></div>
    <div class="container-fluid">
    <div class="row mt-3">
            <div class="col-md-9 d-flex justify-content-center">
                <div class="mb-3">
                    <h4>Search Book
                    </h4>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row mt-3">
    <div class="col-md-12 d-flex justify-content-center">
        <form id="searchForm" method="GET" action="" class="d-flex flex-wrap justify-content-center">
            <div class="form-group">
                <select class="form-control" name="keyword" style="width:150px;">
                    <option value="all" <?php if ($keyword == 'all') echo 'selected'; ?>>Keyword</option>
                    <option value="title" <?php if ($keyword == 'title') echo 'selected'; ?>>Title</option>
                    <!-- <option value="accession" <?php if ($keyword == 'accession') echo 'selected'; ?>>Accession No</option> -->
                    <option value="author" <?php if ($keyword == 'author') echo 'selected'; ?>>Author</option>
                    <option value="call_number" <?php if ($keyword == 'call_number') echo 'selected'; ?>>Call Number</option>
                    <option value="isbn" <?php if ($keyword == 'isbn') echo 'selected'; ?>>ISBN</option>
                </select>
            </div>
            <div class="form-group mx-2">
                <input type="text" class="form-control" style="width: 400px; max-width:300px;" placeholder="Search for books" name="search" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="row mt-3">
<div class="col-md-11 d-flex justify-content-center">
        <h5>Example Searches:</h5>
        <ul id="ul">
    <li id="li"><a href="?search=Rizal" style="color:inherit; position: relative;">Rizal (Search by all keyword)</a></li>
    <li id="li"><a href="?search=Ambeth&keyword=author" style="color:inherit; position: relative;">Ambeth (Search by Author)</a></li>
    <li id="li"><a href="?search=9789712726736&keyword=isbn" style="color:inherit; position: relative;">9789712726736 (Search by ISBN)</a></li>
</ul>
    </div>
</div>


    <!-- Display the count of search results -->
    <?php if (!empty($search)) { ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <p style="font-weight:bold; font-size:large">You searched <?php echo $totalBooks; ?> results.</p>
        </div>
    </div>
    <?php } ?>
    
    <?php if ($searchQuerySubmitted) { ?>
    <!-- Pagination -->
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

    $searchTerm = htmlspecialchars($search);
        // Display books
    // Display books
while ($row = mysqli_fetch_array($res)) {
    // Determine availability message
    $availabilityMessage = ($row["available"] > 0) ? "Available for loan" : "Not available for loan";

    // Initialize highlighted fields
    $highlightedTitle = $row["title_proper"];
    $highlightedCall_Number = $row["call_number_info"];
    $highlightedMain_Creator = $row["main_creator"];
    $highlightedISBN = $row["ISBN"];

    // Loop through each search term and highlight them individually
   // Loop through each search term and highlight them individually
// Loop through each search term and highlight them individually
foreach ($searchTerms as $term) {
    $highlightedTitle = str_ireplace($term, "<span class='highlight'>$term</span>", $highlightedTitle);
    $highlightedCall_Number = str_ireplace($term, "<span class='highlight'>$term</span>", $highlightedCall_Number);
    $highlightedMain_Creator = str_ireplace($term, "<span class='highlight'>$term</span>", $highlightedMain_Creator);
    $highlightedISBN = str_ireplace($term, "<span class='highlight'>$term</span>", $highlightedISBN);
}


    // Output the book information with highlighted search terms
    ?>
    <div class="col-md-12 mb-3 d-flex flex-wrap">
        <div class="card d-flex flex-row w-100">
            <div class="card-body">
                <a href="display-book-info.php?accession_number=<?php echo $row["accession_number"];?> ">
                    <h3 class="card-title" style="color:#248fc5; margin-left:50px; margin-top: 20px"><?php echo $highlightedTitle;?></h3>
                </a>
                <br>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">by <span style='font-weight:bold'><?php echo $highlightedMain_Creator  ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px;">Publisher: <span style="color:#707070"><?php echo $row["publisher"]; ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px; margin-bottom:5px">Place of Publication: <?php echo $row["place_of_publication"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">ISBN: <?php echo $highlightedISBN;?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Call Number: <?php echo $highlightedCall_Number?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Availability: <span style="font-weight:bold"><?php echo $availabilityMessage; ?></span></p>
            </div>
            <img src="../<?php echo $row["book_image"]; ?>" class="card-img-right" alt="No Cover Available" style="height:150px; width:100px;">
        </div>
    </div>
<?php } ?>
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
<?php } ?>


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