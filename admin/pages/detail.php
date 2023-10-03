<?php
$dir_path = "../../data/pages";
require_once('./pages.php');

// Check if the 'file' parameter is set in the URL
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $pageContent = getPageContent($dir_path, $fileName);

    if (!$pageContent) {
        echo "Page not found.";
        exit;
    }
} else {
    echo "No page specified.";
    exit;
}

// Check if the 'delete' parameter is set in the URL
if (isset($_GET['delete'])) {
    $deleteFileName = $_GET['delete'];

    // Construct the full path to the file to be deleted
    $deleteFilePath = $dir_path . "/" . $deleteFileName;

    // Check if the file exists and is a file (not a directory)
    if (is_file($deleteFilePath)) {
        // Display a confirmation form
        echo '<html>';
        echo '<head>';
        echo '<title>Delete Page Content Confirmation</title>';
        echo '</head>';
        echo '<body>';
        echo '<div style="width: 300px; margin: 50px auto; text-align: center; background-color: #3498db; padding: 20px; color: #fff;">';
        echo '<h2>Delete Page Content</h2>';
        echo '<p>Are you sure you want to delete the content of the text file "' . $deleteFileName . '"?</p>';
        echo '<form method="post">';
        echo '<input type="submit" name="confirm" value="Yes" style="background-color: #e74c3c; color: #fff; padding: 10px 20px; border: none; cursor: pointer;"> ';
        echo '<input type="submit" name="cancel" value="No" style="background-color: #2ecc71; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">';
        echo '</form>';
        echo '</div>';
        echo '</body>';
        echo '</html>';

        // Check if the user clicked the "Yes" button
        if (isset($_POST['confirm'])) {
            // Attempt to delete the file
            if (unlink($deleteFilePath)) {
                echo "File '" . $deleteFileName . "' has been deleted.";
            } else {
                echo "Failed to delete file '" . $deleteFileName . "'.";
            }
        } elseif (isset($_POST['cancel'])) {
            // Redirect to the specified page
            header('Location: ../pages');
            exit();
        }
    } else {
        echo "File '" . $deleteFileName . "' not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fileName; ?> Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="text-center mt-4">
        <a href="edit.php?file=<?= $_GET["file"] ?>" class="btn btn-primary button-margin">Edit</a>
    </div>
    <div class="text-center mt-4">
        <a href="detail.php?file=<?= $_GET["file"] ?>&delete=<?= $_GET["file"] ?>" class="btn btn-danger button-margin">Delete</a>
    </div>
    <div class="container">
        <h1><?php echo $fileName; ?> Details</h1>
        <div>
            <h2>Page Contents:</h2>
            <pre><?php echo htmlspecialchars($pageContent); ?></pre>
        </div>
        <a href="index.php">Back to Pages</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

