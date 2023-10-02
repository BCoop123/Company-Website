<?php
// Include necessary functions and variables
require_once('./pages.php');

// Define the path to the pages TXT files directory
$pagesDir = "../../data/pages";

// Function to add a new page to the TXT files
function addNewPage($pagesDir, $filename, $contents) {
    // Check if both the filename and contents are not empty
    if (!empty($filename) && !empty($contents)) {
        // Combine the directory path and filename
        $file_path = $pagesDir . "/" . $filename;

        // Write the contents to the file
        if (file_put_contents($file_path, $contents) !== false) {
            return true; // Return true on success
        }
    }
    return false; // Return false on failure or empty input
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $pageFilename = $_POST["page_filename"];
    $pageContents = $_POST["page_contents"];
    // Add the new page to the TXT files
    if (addNewPage($pagesDir, $pageFilename, $pageContents)) {
        // Redirect to the edit page for the newly created page
        header("Location: edit.php?file=" . urlencode($pageFilename));
        exit();
    } else {
        echo "Failed to add the page to the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Create New Page</h1>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="page_filename">Page Filename:</label>
                <input type="text" class="form-control" id="page_filename" name="page_filename" required>
            </div>
            <div class="form-group">
                <label for="page_contents">Page Contents:</label>
                <textarea class="form-control" id="page_contents" name="page_contents" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
