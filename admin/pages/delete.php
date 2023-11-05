<?php
<<<<<<< Updated upstream
// Get the parameters from the URL
$txtFileName = isset($_GET['file']) ? $_GET['file'] : '';
=======
require_once('./pages.php');
>>>>>>> Stashed changes

// Check if the parameters are valid
if (!empty($txtFileName)) {
    // Read the first few words from the text file
    $firstWords = getFirstWordsFromFile($txtFileName);

<<<<<<< Updated upstream
    // Display the confirmation dialog
    echo '<html>';
    echo '<head>';
    echo '<title>Delete Page Content Confirmation</title>';
    echo '</head>';
    echo '<body>';
    echo '<div style="width: 300px; margin: 50px auto; text-align: center; background-color: #3498db; padding: 20px; color: #fff;">';
    echo '<h2>Delete Page Content</h2>';
    echo '<p>Are you sure you want to delete the content of the text file "' . $txtFileName . '"?</p>';
    echo '<p>First few words: ' . $firstWords . '</p>';
    echo '<form method="post">';
    echo '<input type="submit" name="confirm" value="Yes" style="background-color: #e74c3c; color: #fff; padding: 10px 20px; border: none; cursor: pointer;"> ';
    echo '<input type="submit" name="cancel" value="No" style="background-color: #2ecc71; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">';
    echo '</form>';
    echo '</div>';
    echo '</body>';
    echo '</html>';

    // Check if the user clicked the "Yes" button
    if (isset($_POST['confirm'])) {
        // Call a function to delete the contents of the text file
        deleteTxtFileContents($txtFileName);

        // Redirect to the specified page
        header('Location: ../pages');
        exit();
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the specified page
        header('Location: ../pages');
        exit();
=======
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $dir_path = '../../data/pages';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
        if (Pages::deleteFile($dir_path . "/" . $fileName)) {
            header("Location: index.php?message=deleted");
            exit();
        } else {
            $message = "Failed to delete the page.";
        }
>>>>>>> Stashed changes
    }
} else {
    echo 'Invalid parameters.';
}
?>
