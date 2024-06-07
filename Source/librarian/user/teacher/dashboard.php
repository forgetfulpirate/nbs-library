<?php 
        session_start();
        if (!isset($_SESSION["teacher"])) {
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
// Custom function to highlight search terms case-insensitively
function highlightTerms($text, $terms) {
    // Combine search terms into a single regex pattern
    $pattern = '/(' . implode('|', array_map('preg_quote', $terms)) . ')/i';

    // Use preg_replace_callback to handle matches and keep HTML intact
    return preg_replace_callback($pattern, function($matches) {
        return '<span class="highlight">' . $matches[0] . '</span>';
    }, $text);
}


// Check if search term and keyword are provided
$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : 'all';
$searchQuerySubmitted = !empty($search);

if ($searchQuerySubmitted && trim($search) === '') {
    $searchQuerySubmitted = false; // Set search query submitted to false
    $errorMessage = "Please input a search term."; // Set an error message
}

// Check if search term is empty
if ($searchQuerySubmitted && trim($search) === '') {
    $searchQuerySubmitted = false; // Set search query submitted to false
}

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
                case 'call_number && call_number_type':
                    $searchConditions[] = "call_number_info LIKE '%$term%'";
                    $searchConditions[] = "call_number_type LIKE '%$term%'";
                    break;
                case 'isbn':
                    $searchConditions[] = "ISBN LIKE '%$term%'";
                    break;
                case 'responsibility':
                    $searchConditions[] = "responsibility LIKE '%$term%'";
                    break;
                case 'call_number_type':
                    $searchConditions[] = "call_number_type LIKE '%$term%'";
                     break;
                default:
                    $searchConditions[] = "(title_proper LIKE '%$term%' OR main_creator LIKE '%$term%' OR call_number_info LIKE '%$term%' OR ISBN LIKE '%$term%' OR responsibility LIKE '%$term%' OR call_number_type LIKE '%$term%')";
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
                    <h4>Search Book</h4>
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
                        <option value="author" <?php if ($keyword == 'author') echo 'selected'; ?>>Author</option>
                        <option value="call_number" <?php if ($keyword == 'call_number') echo 'selected'; ?>>Call Number</option>
                        <option value="isbn" <?php if ($keyword == 'isbn') echo 'selected'; ?>>ISBN</option>
                    </select>
                </div>
                <div class="form-group mx-2">
                <input type="text" class="form-control" style="width: 400px; max-width:300px;" placeholder="Search for books" name="search" value="<?php echo htmlspecialchars($search); ?>" required>
                <div style="color:red;">
                                <?php if (isset($errorMessage)): ?>
                                            <?php echo $errorMessage; ?>
                                <?php endif; ?>
                                </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            
        </div>

    </div>



    <!-- <div class="row mt-3">
        <div class="col-md-11 d-flex justify-content-center">
            <h5>Example Searches:</h5>
            <ul id="ul">
                <li id="li"><a href="?search=Rizal" style="color:inherit; position: relative;">Rizal (Search by all keyword)</a></li>
                <li id="li"><a href="?search=Ambeth&keyword=author" style="color:inherit; position: relative;">Ambeth (Search by Author)</a></li>
                <li id="li"><a href="?search=9789712726736&keyword=isbn" style="color:inherit; position: relative;">9789712726736 (Search by ISBN)</a></li>
            </ul>
        </div>
    </div> -->



    <!-- Display the count of search results -->
    <?php if ($searchQuerySubmitted) { ?>
    <!-- Display the count of search results -->
    <div class="row mt-3">
        <div class="col-md-12">
            <?php if ($totalBooks > 0) { ?>
                <p style="font-weight:bold; font-size:large">You searched <?php echo $totalBooks; ?> results.</p>
            <?php } else { ?>
                <p style="font-weight:bold; font-size:large">No results found.</p>
            <?php } ?>
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
                        // Previous page
                        if ($currentPage > 1) {
                            echo "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage - 1) . (!empty($search) ? "&search=$search" : "") . "'>Previous</a></li>";
                        }

                        // Page numbers
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<li class='page-item " . ($currentPage == $i ? "active" : "") . "'><a class='page-link' href='?page=$i" . (!empty($search) ? "&search=$search" : "") . "'>$i</a></li>";
                        }

                        // Next page
                        if ($currentPage < $totalPages) {
                            echo "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage + 1) . (!empty($search) ? "&search=$search" : "") . "'>Next</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
    <div class="row mt-3">
        <?php while ($row = mysqli_fetch_array($res)) {
    // Determine availability message
    $availabilityMessage = ($row["available"] > 0) ? "Available for loan" : "Not available for loan";
    $resource_type = $row["resource_type"];

    // Initialize highlighted fields
    $highlightedTitle = $row["title_proper"];
    $highlightedCall_Number = $row["call_number_info"];
    $highlightedMain_Creator = $row["main_creator"];
    $highlightedISBN = $row["ISBN"];
    $highlightedResponsibility = $row["responsibility"];
    $highlightedCall_number_type = $row["call_number_type"];
    $publisher = $row["publisher"];
    

    // Highlight search terms
    $highlightedTitle = highlightTerms($highlightedTitle, $searchTerms);
    $highlightedCall_Number = highlightTerms($highlightedCall_Number, $searchTerms);
    $highlightedMain_Creator = highlightTerms($highlightedMain_Creator, $searchTerms);
    $highlightedISBN = highlightTerms($highlightedISBN, $searchTerms);
    $highlightedResponsibility = highlightTerms($highlightedResponsibility, $searchTerms);
    $highlightedCall_number_type = highlightTerms($highlightedCall_number_type, $searchTerms);
    $publisher = highlightTerms($publisher, $searchTerms);

    // Display status based on resource type and availability
   // Display status based on resource type and availability
if ($resource_type === "Thesis") {
    // For thesis type, check availability for room use only
    $availabilityMessage = ($row["available"] > 0) ? "Available (for room use only)" : "Not available";
} else {
    // For other resource types, use the general availability message
    $availabilityMessage = ($row["available"] > 0) ? "Available" : "Not available";
}

// Set availability message color
$status_color = ($row["available"] > 0) ? '#218838' : 'red';

    // Set availability message color
    $status_color = ($row["available"] > 0) ? '#218838' : 'red';

            // Output the book information with highlighted search terms
        ?>
        <div class="col-md-12 mb-3 d-flex flex-wrap">
            <div class="card d-flex flex-row w-100">
                <div class="card-body">
                    <a href="display-book-info.php?accession_number=<?php echo $row["accession_number"];?> ">
                    <?php if(!empty($highlightedTitle) || !empty($responsibility)): ?>
                        <h3 class="card-title" style="color:#248fc5; margin-left:50px; margin-top: 20px"><?php echo $highlightedTitle . (!empty($highlightedResponsibility) ? " / " . $highlightedResponsibility : "");?></h3>
                        <?php endif; ?>
                    </a>
                    <br>
                    <?php if(!empty($highlightedMain_Creator)): ?>
                    <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:10px">by <span style='font-weight:bold'><?php echo $highlightedMain_Creator  ?></span></p>
                    <?php endif; ?>

                    <!-- <?php if(!empty($publisher)): ?>
                    <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px; font-weight:bold;">Publisher:<span style="font-weight:bold;"><?php echo $row["publisher"]; ?></span></p>
                    <?php endif; ?>

                    <?php if(!empty($place_of_publication)): ?>
                    <p class="card-text" style="letter-spacing:1px; margin-left:20px; margin-bottom:5px font-weight:bold;">Place of Publication: <?php echo $publisher ?></p>
                    <?php endif; ?> -->

                    <?php if(!empty($highlightedISBN)): ?>
                    <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px; font-weight:bold;">ISBN: <span style='font-weight:100;'><?php echo $highlightedISBN;?></span></p>
                    <?php endif; ?>

                    <?php if(!empty($highlightedCall_Number)): ?>
                        <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:5px; font-weight:bold" >Call Number: <span style='font-weight:100;'><?php echo $highlightedCall_number_type; echo " "; echo $highlightedCall_Number?><span></p>
                    <?php endif; ?>

                    <?php if(!empty($resource_type)): ?>
                    <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px; font-weight:bold;">Resources Type: <span style="font-weight:100;"><?php echo $resource_type; ?></span></p>
                    <?php endif; ?>

                    <?php
                        // Set availability message based on resource type
                        if (!empty($resource_type)) {
                            switch ($resource_type) {
                                case "Thesis":
                                    $availabilityMessage = ($row["available"] > 0) ? "Available (room use only)" : "Not available";
                                    break;
                                default:
                                    $availabilityMessage = ($row["available"] > 0) ? "Available" : "Not available";
                                    break;
                            }
                        }
                        ?>
                        <?php if (!empty($availabilityMessage)): ?>
                            <p class="card-text" style="letter-spacing:1px; margin-left:20px ; margin-bottom:20px; font-weight:bold;">
                                Availability: <span style="font-weight:bold; color:<?php echo $status_color; ?>"><?php echo $availabilityMessage; ?></span>
                            </p>
                        <?php endif; ?>


                </div>
                <img src="../../<?php echo $row["book_image"]; ?>" class="card-img-right" alt="No Cover Available" style="height:150px; width:100px;">
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
                </nav>
            </div>
        </div>
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
            currentURL += '&sort'=${sortValue};
            } else {
            currentURL += '?sort'=${sortValue};
            }
            window.location.href = currentURL;
            });
            });
            </script>