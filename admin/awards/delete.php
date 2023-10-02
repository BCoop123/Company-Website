<?php
include('awards.php');
// Get the parameters from the URL
$awardIndex = isset($_GET['index']) ? intval($_GET['index']) : -1;
$csvFileName = isset($_GET['file']) ? $_GET['file'] : '';
$awardName = isset($_GET['awardName']) ? $_GET['awardName'] : '';

// Check if the parameters are valid
if ($awardIndex >= 0 && !empty($csvFileName) && !empty($awardName)) {
    // Display the confirmation dialog
    echo '<html>';
    echo '<head>';
    echo '<title>Delete Award Confirmation</title>';
    echo '</head>';
    echo '<body>';
    echo '<div style="width: 300px; margin: 50px auto; text-align: center; background-color: #3498db; padding: 20px; color: #fff;">';
    echo '<h2>Delete Award</h2>';
    echo '<p>Are you sure you want to delete the award "' . $awardName . '" at index ' . $awardIndex . ' from the CSV file "' . $csvFileName . '"?</p>';
    echo '<form method="post">';
    echo '<input type="submit" name="confirm" value="Yes" style="background-color: #e74c3c; color: #fff; padding: 10px 20px; border: none; cursor: pointer;"> ';
    echo '<input type="submit" name="cancel" value="No" style="background-color: #2ecc71; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">';
    echo '</form>';
    echo '</div>';
    echo '</body>';
    echo '</html>';

    // Check if the user clicked the "Yes" button
    if (isset($_POST['confirm'])) {
        // Call your delete award function here with $csvFileName and $awardIndex
        deleteAwardFromCSV($csvFileName, $awardIndex);

        // Redirect to the specified page
        header('Location: ../awards');
        exit();
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the specified page
        header('Location: ../awards');
        exit();
    }
} else {
    echo 'Invalid parameters.';
}
?>