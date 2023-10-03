<?php
// Include necessary functions and variables
require_once('./team.php');

// Define the path to the team JSON file
$teamFile = "../../data/team/team.json";

$message = "";

if (isset($_GET['id'])) {
    $memberID = $_GET['id'];

    // Check if the form is submitted to delete the team member
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
        if (deleteTeamMember($teamFile, $memberID)) {
            header("Location: index.php?message=deleted");
            exit();
        } else {
            $message = "Failed to delete the team member.";
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Team Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1>Confirm Deletion</h1>
        <p>Are you sure you want to delete this team member?</p>
        
        <?php
        if ($message) {
            echo "<div class='alert alert-danger'>$message</div>";
        }
        ?>

        <form method="post" action="delete.php?id=<?= $memberID ?>">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>