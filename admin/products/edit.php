<?php
require_once('./products.php');  // Assume you've named your functions file as 'products.php'

$productFile = "../../data/products/products.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $originalName = $_GET["name"];
    $newName = $_POST["product_name"];
    $newDescription = $_POST["product_description"];
    $newApplications = [
        "Educational Suites" => $_POST["educational_suites"],
        "Adventure Modules" => $_POST["adventure_modules"],
        "Therapeutic Landscapes" => $_POST["therapeutic_landscapes"]
    ];

    $newData = [
        "name" => $newName,
        "description" => $newDescription,
        "applications" => $newApplications
    ];

    if (editProduct($originalName, $newData)) {
        header("Location: detail.php?name=" . urlencode($newName));
        exit();
    } else {
        echo "Error updating product.";
    }
}

$productToEdit = getProductDetails($_GET["name"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h1>Edit Product</h1>
    <form method="post" action="edit.php?name=<?= urlencode($_GET["name"]) ?>">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required
                   value="<?= $productToEdit['name'] ?>">
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" id="product_description" name="product_description" rows="4"
                      required><?= $productToEdit['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="educational_suites">Educational Suites:</label>
            <input type="text" class="form-control" id="educational_suites" name="educational_suites" required
                   value="<?= $productToEdit['applications']['Educational Suites'] ?>">
        </div>
        <div class="form-group">
            <label for="adventure_modules">Adventure Modules:</label>
            <input type="text" class="form-control" id="adventure_modules" name="adventure_modules" required
                   value="<?= $productToEdit['applications']['Adventure Modules'] ?>">
        </div>
        <div class="form-group">
            <label for="therapeutic_landscapes">Therapeutic Landscapes:</label>
            <input type="text" class="form-control" id="therapeutic_landscapes" name="therapeutic_landscapes" required
                   value="<?= $productToEdit['applications']['Therapeutic Landscapes'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>