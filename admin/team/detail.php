<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <?php
            // Check if a file is specified in the URL
            if (isset($_GET['file'])) {
                $teamName = $_GET['file'];
                $teamDetails = getTeamDetails($teamName);

                if ($teamDetails) {
                    echo '<h2>' . $teamDetails['name'] . '</h2>';
                    echo '<h4>Title: ' . $teamDetails['title'] . '</h4>';
                    echo '<p>' . $teamDetails['details'] . '</p>';
                } else {
                    echo 'Team member not found.';
                }
            } else {
                echo 'No team member specified.';
            }
        ?>

        <br><a href="./index.php">Back to Team Page</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
function getTeamDetails($teamName) {
    $jsonFile = "../../data/team/team.json";

    if (file_exists($jsonFile)) {
        $teamData = json_decode(file_get_contents($jsonFile), true);

        foreach ($teamData as $member) {
            if ($member['name'] === $teamName) {
                return $member;
            }
        }
    } else {
        echo "Team file not found.";
    }

    return null;
}
?>
