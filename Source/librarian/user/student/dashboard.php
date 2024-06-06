<?php 
        session_start();
        if (!isset($_SESSION["student"])) {
            ?>
                <script type="text/javascript">
                    window.location="login.php";
                </script>
            <?php
        }

    $page = 'home';
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
</style>
<?php

// Check if search term and keyword are provided
$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : 'all';
$searchQuerySubmitted = !empty($search);
// Calculate pagination

if ($searchQuerySubmitted) {
$entriesPerPage = 50;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $entriesPerPage;
   // Check if search query is submitted

// Prepare SQL query to fetch books with optional search filter and limit
$sqlCount = "SELECT COUNT(*) as count FROM book_module";
if (!empty($search)) {
    $search = mysqli_real_escape_string($link, $search); // Escape the search input
    $sqlCount .= " WHERE";
    switch ($keyword) {
        case 'title':
            $sqlCount .= " title_proper LIKE '%$search%'";
            break;
        // case 'accession':
        //     $sqlCount .= " accession_number LIKE '%$search%'";
        //     break;
        case 'author':
            $sqlCount .= " main_creator LIKE '%$search%'";
            break;
        case 'call_number':
            $sqlCount .= " call_number_info LIKE '%$search%'";
            break;
        case 'isbn':
            $sqlCount .= " ISBN LIKE '%$search%'";
            break;
        default:
            $sqlCount .= " title_proper LIKE '%$search%' OR main_creator LIKE '%$search%' OR call_number_info LIKE '%$search%' OR ISBN LIKE '%$search%'";
            break;
    }
}
$resultCount = mysqli_query($link, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalBooks = $rowCount['count'];

// Calculate total pages
$totalPages = ceil($totalBooks / $entriesPerPage);

// Update SQL query to include pagination
$sql = "SELECT * FROM book_module";
if (!empty($search)) {
    $sql .= " WHERE";
    switch ($keyword) {
        case 'title':
            $sql .= " title_proper LIKE '%$search%'";
            break;
        // case 'accession':
        //     $sql .= " accession_number LIKE '%$search%'";
        //     break;
        case 'author':
            $sql .= " main_creator LIKE '%$search%'";
            break;
        case 'call_number':
            $sql .= " call_number_info LIKE '%$search%'";
            break;
        case 'isbn':
            $sql .= " ISBN LIKE '%$search%'";
            break;
        default:
            $sql .= " title_proper LIKE '%$search%' OR main_creator LIKE '%$search%' OR call_number_info LIKE '%$search%' OR ISBN LIKE '%$search%'";
            break;
    }
}
$sql .= " LIMIT $entriesPerPage OFFSET $offset";

// Execute the query
$res = mysqli_query($link, $sql);
}

?>

<main class="content px-3 py-2">  
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Search Book
                <p id="time"></p>
                <p id="date"></p>
            </h4>
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
    <li id="li"><a href="?search=9789712726736&keyword=isbn" style="color:inherit; position: relative;">1234567890 (Search by ISBN)</a></li>
</ul>
    </div>
</div>


    <!-- Display the count of search results -->
    <?php if (!empty($search)) { ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <p>You searched <?php echo $totalBooks; ?> results.</p>
        </div>
    </div>
    <?php } ?>
    
    <?php if ($searchQuerySubmitted) { ?>
    <!-- Pagination -->
    <div class="row mt-3">
        <div class="col-md-12">
            
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
            </nav>
        </div>
    </div>
   
    <div class="row mt-3">
    <?php
        // Display books
        while ($row = mysqli_fetch_array($res)) {
            // Determine availability message
            $availabilityMessage = ($row["available"] > 0) ? "Available for loan" : "Not available for loan";
            $highlightedTitle = str_ireplace($search, "<span class='highlight'>$search</span>", $row["title_proper"]);
            $highlightedCall_Number = str_ireplace($search, "<span class='highlight'>$search</span>", $row["call_number_info"]);
            $highlightedMain_Creator = str_ireplace($search, "<span class='highlight'>$search</span>", $row["main_creator"]);
            $highlightedISBN = str_ireplace($search, "<span class='highlight'>$search</span>", $row["ISBN"]);
            

    
    ?>
    <div class="col-md-12 mb-3 d-flex flex-wrap"> <!-- Added d-flex flex-wrap -->
        <div class="card d-flex flex-row w-100"> <!-- Added w-100 to ensure the card takes full width -->
            <div class="card-body">
            <a href="display-book-info.php?id=<?php echo $row["accession_number"];?> "><h3 class="card-title" style="color:#248fc5; margin-left:50px; margin-top: 20px"><?php echo $highlightedTitle;?></h3></a>
                
                <br>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">by <span style='font-weight:bold'><?php echo $highlightedMain_Creator  ?></span></p>
                <!-- <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">Accession Number: <span style="color:#707070"><?php echo $row["accession_number"]; ?></span></p> -->
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px;">Publisher: <span style="color:#707070"><?php echo $row["publisher"]; ?></span></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px; margin-bottom:5px">Place of Publication: <?php echo $row["place_of_publication"]; ?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px">ISBN: <?php echo $highlightedISBN;?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Call Number: <?php echo $highlightedCall_Number?></p>
                <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px">Availability: <span style="font-weight:bold"><?php echo $availabilityMessage; ?></span></p>
            </div>
            <img src="../../<?php echo $row["book_image"]; ?>" class="card-img-right" alt="No Cover Available" style="height:100px; width:100px;">
        </div>
    </div>
    <?php
        }
    ?>
</div>
<?php } ?>
</main>
<?php 
		include 'inc/footer.php';
	 ?>


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