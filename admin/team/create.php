<?php
// Include necessary functions and variables
require_once('./team.php');

// Define the path to the team JSON file
$teamFile = "../../data/team/team.json";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $memberName = $_POST["member_name"];
    $memberTitle = $_POST["member_title"];
    $memberDetails = $_POST["member_details"];
    
    // Generate a new ID for the team member
    $teamData = json_decode(file_get_contents($teamFile), true);
    $newID = end(array_keys($teamData)) + 1;

    // Add the new team member to the JSON file
    if (addOrUpdateTeamMember($teamFile, $newID, $memberName, $memberTitle, $memberDetails)) {
        // Redirect to the detail page for the new team member
        header("Location: detail.php?id=" . $newID);
        exit();
    } else {
        echo "Failed to add the new team member to the database.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Team Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Create New Team Member</h1>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="member_name">Member Name:</label>
                <input type="text" class="form-control" id="member_name" name="member_name" required>
            </div>
            <div class="form-group">
                <label for="member_title">Member Title:</label>
                <input type="text" class="form-control" id="member_title" name="member_title" required>
            </div>
            <div class="form-group">
                <label for="member_details">Member Details:</label>
                <textarea class="form-control" id="member_details" name="member_details" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
