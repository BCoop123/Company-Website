<?php
$dir_path = "../../data/pages";
$headings = ["Page", "Contents"];
require_once('./pages.php')

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        .button-margin {
            margin-bottom: 0.5in;
        }
    </style>
</head>

<body>

    <div class="text-center mt-4">
        <a href="create.php" class="btn btn-primary button-margin">Create New</a>
    </div>

<body>

    <?php
        createTable($headings, getPageInfo($dir_path))
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>