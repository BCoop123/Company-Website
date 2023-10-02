<?php
$contactsFilePath = "../../data/contacts/contacts.json";
require_once('./contacts.php');

// Check if the 'file' parameter is set in the URL
if (isset($_GET['file'])) {
    $contactFile = $_GET['file'];
    $contactDetails = getContactDetails($contactsFilePath, $contactFile);

    if (!$contactDetails) {
        echo $contactFile;
        exit;
    }
} else {
    echo "No contact specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $contactDetails['name']; ?> Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1><?php echo $contactDetails['name']; ?> Details</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $contactDetails['name']; ?></td>
                    <td><?php echo $contactDetails['email']; ?></td>
                    <td><?php echo $contactDetails['subject']; ?></td>
                    <td><?php echo $contactDetails['comments']; ?></td>
                </tr>
            </tbody>
        </table>
        <a href="index.php">Back to Contacts</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
