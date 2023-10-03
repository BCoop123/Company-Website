<?php
// Include necessary functions and variables
require_once('./team.php');

$teamFile = "../../data/team/team.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $name = $_POST["name"];
    $title = $_POST["title"];
    $details = $_POST["details"];

    if (addOrUpdateTeamMember($teamFile, $id, $name, $title, $details)) {
        header("Location: detail.php?id=" . urlencode($id) . "&message=updated");
        exit();
    } else {
        echo "Error updating team member.";
    }
}

// Retrieve the team member's current information for editing
$memberToEdit = null;
if (isset($_GET["id"])) {
    $idToEdit = $_GET["id"];
    $existingData = file_get_contents($teamFile);
    $team = json_decode($existingData, true);

    if (is_array($team) && isset($team[$idToEdit])) {
        $memberToEdit = $team[$idToEdit];
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
        <form method="post" action="edit.php?id=<?= $_GET["id"] ?>">
            <div class="form-group">
                <label for="member_name">Member Name:</label>
                <input type="text" class="form-control" id="member_name" name="name" required
                    value="<?php echo isset($memberToEdit) ? $memberToEdit['name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="member_title">Member Title:</label>
                <input type="text" class="form-control" id="member_title" name="title" required
                    value="<?php echo isset($memberToEdit) ? $memberToEdit['title'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="member_details">Member Details:</label>
                <textarea class="form-control" id="member_details" name="details" rows="4"
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
