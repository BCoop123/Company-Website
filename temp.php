<?php
    require_once('./lib/read_plaintxt.php');
    require_once('./lib/read_json.php');
    require_once('./lib/read_csv.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Function Tester</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>PHP Function Tester</h2>
    <?php
        $plainText = readPlainTextData('./data/data.txt');
        $jsonData = readJsonData('./data/data.json');
        $CSVData = readCSVData('./data/data.csv');

        //printf($CSVData);
        print_r($CSVData,)


        //echo $plainText;
        //print_r($jsonData);
        //echo $jsonData['books'][0]['id'];
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>