<?php
// Include necessary functions and variables
require_once('./team.php');

// Define the path to the team JSON file
$teamFile = "../../data/team/team.json";

// Function to add a new team member to the JSON file
function addNewTeamMember($teamFile, $name, $title, $details) {
    // Read existing JSON data from the file
    $existingData = file_get_contents($teamFile);
    $team = json_decode($existingData, true); // true for associative array

    if (!is_array($team)) {
        $team = []; // Initialize as an empty array if the file is empty or invalid
    }

    // Check if the team member already exists in the array
    foreach ($team as $key => $member) {
        if ($member["name"] === $name) {
            // Update the team member's information
            $team[$key]["title"] = $title;
            $team[$key]["details"] = $details;

            // Encode the updated array as JSON
            $jsonContent = json_encode($team, JSON_PRETTY_PRINT);

            // Write the updated JSON data back to the file
            if (file_put_contents($teamFile, $jsonContent) !== false) {
                return true; // Return true on success
            }
            return false; // Return false on failure
        }
    }

    // If the team member doesn't exist, add them as a new member
    $newMember = [
        "name" => $name,
        "title" => $title,
        "details" => $details
    ];
    $team[] = $newMember;

    // Encode the updated array as JSON
    $jsonContent = json_encode($team, JSON_PRETTY_PRINT);

    // Write the updated JSON data back to the file
    if (file_put_contents($teamFile, $jsonContent) !== false) {
        return true; // Return true on success
    }
    return false; // Return false on failure
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $memberName = $_POST["member_name"];
    $memberTitle = $_POST["member_title"];
    $memberDetails = $_POST["member_details"];
    // Add or edit the team member in the JSON file
    if (addNewTeamMember($teamFile, $memberName, $memberTitle, $memberDetails)) {
        // Redirect to the edit page for the team member
        header("Location: edit.php?name=" . urlencode($memberName));
        exit();
    } else {
        echo "Failed to add/edit the team member in the database.";
    }
}

// Retrieve the team member's current information for editing
$memberToEdit = null;
if (isset($_GET["name"])) {
    $memberNameToEdit = $_GET["name"];
    $existingData = file_get_contents($teamFile);
    $team = json_decode($existingData, true);

    if (is_array($team)) {
        foreach ($team as $member) {
            if ($member["name"] === $memberNameToEdit) {
                $memberToEdit = $member;
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create/Edit Team Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1><?php echo isset($memberToEdit) ? 'Edit Team Member' : 'Create New Team Member'; ?></h1>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="member_name">Member Name:</label>
                <input type="text" class="form-control" id="member_name" name="member_name" required
                    value="<?php echo isset($memberToEdit) ? $memberToEdit['name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="member_title">Member Title:</label>
                <input type="text" class="form-control" id="member_title" name="member_title" required
                    value="<?php echo isset($memberToEdit) ? $memberToEdit['title'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="member_details">Member Details:</label>
                <textarea class="form-control" id="member_details" name="member_details" rows="4"
                    required><?php echo isset($memberToEdit) ? $memberToEdit['details'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
