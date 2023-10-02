<?php
$dir_path = "../../data/products";
require_once('./products.php');

// Check if the 'file' parameter is set in the URL
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $productInfo = getProductDetails($dir_path, $fileName);

    if (!$productInfo) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fileName; ?> Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1><?php echo $fileName; ?> Details</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Educational Suites</th>
                    <th>Adventure Modules</th>
                    <th>Therapeutic Landscapes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $productInfo[0]; ?></td>
                    <td><?php echo $productInfo[1]; ?></td>
                    <td><?php echo $productInfo[2]["Educational Suites"]; ?></td>
                    <td><?php echo $productInfo[2]["Adventure Modules"]; ?></td>
                    <td><?php echo $productInfo[2]["Therapeutic Landscapes"]; ?></td>
                </tr>
            </tbody>
        </table>
        <a href="index.php">Back to Products</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
