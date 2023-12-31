<?php
// Include necessary functions and variables
require_once('./awards.php');

// Define the path to the awards CSV file
$awardsFile = "../../data/awards/awards.csv";
$message = "";

// Check if an award name is specified
if (!isset($_GET['award'])) {
    header("Location: index.php");
    exit();
}

$awardName = $_GET['award'];
$awardDetails = Awards::readAward($awardsFile, $awardName);

if (!$awardDetails) {
    echo "Award not found.";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $updatedAwardName = $_POST["award_name"];
    $updatedAwardDescription = $_POST["award_description"];
    
    // Update the award in the CSV file
    if (Awards::updateAward($awardsFile, $awardName, $updatedAwardName, $updatedAwardDescription)) {
        // Redirect to the detail page for the updated award
        header("Location: detail.php?award=" . urlencode($updatedAwardName));
        exit();
    } else {
        $message = "Failed to update the award.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Award</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Edit Award</h1>
        
        <?php
        if ($message) {
            echo "<div class='alert alert-danger'>$message</div>";
        }
        ?>
        
        <form method="post" action="edit.php?award=<?= urlencode($awardName) ?>">
            <div class="form-group">
                <label for="award_name">Award Name:</label>
                <input type="text" class="form-control" id="award_name" name="award_name" required value="<?= htmlspecialchars($awardDetails[0]) ?>">
            </div>
            <div class="form-group">
                <label for="award_description">Award Description:</label>
                <textarea class="form-control" id="award_description" name="award_description" rows="4" required><?= htmlspecialchars($awardDetails[1]) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
