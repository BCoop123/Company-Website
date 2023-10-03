<?php
require_once('./products.php');

// Check if the 'name' parameter is set in the URL
if (isset($_GET['name'])) {
    $productName = $_GET['name'];
    $productInfo = getProductDetails($productName);

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
    <title><?php echo $productName; ?> Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="text-center mt-4">
        <a href="edit.php?name=<?= urlencode($productName) ?>" class="btn btn-primary button-margin">Edit</a>
    </div>
    <div class="text-center mt-4">
        <!-- Assuming you will use 'name' to identify the product for deletion too -->
        <a href="delete.php?name=<?= urlencode($productName) ?>" class="btn btn-danger button-margin">Delete</a>
    </div>
    <div class="container">
        <h1><?php echo $productName; ?> Details</h1>
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
                    <td><?php echo $productInfo['name']; ?></td>
                    <td><?php echo $productInfo['description']; ?></td>
                    <td><?php echo $productInfo['applications']["Educational Suites"]; ?></td>
                    <td><?php echo $productInfo['applications']["Adventure Modules"]; ?></td>
                    <td><?php echo $productInfo['applications']["Therapeutic Landscapes"]; ?></td>
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
