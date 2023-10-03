<?php
// Include necessary functions and variables
require_once('./products.php');

// Define the path to the products JSON file
$productsFile = "../../data/products/products.json";

// Function to add a new product to the JSON file
function addNewProduct($productsFile, $name, $description, $eduSuites, $advModules, $therapeuticLandscapes) {
    $existingData = file_get_contents($productsFile);
    $products = json_decode($existingData, true); // true for associative array

    if (!is_array($products)) {
        $products = []; // Initialize as an empty array if the file is empty or invalid
    }

    $newProduct = [
        "name" => $name,
        "description" => $description,
        "applications" => [
            "Educational Suites" => $eduSuites,
            "Adventure Modules" => $advModules,
            "Therapeutic Landscapes" => $therapeuticLandscapes
        ]
    ];

    $products[] = $newProduct;

    $jsonContent = json_encode($products, JSON_PRETTY_PRINT);
    if (file_put_contents($productsFile, $jsonContent) !== false) {
        return true; // Return true on success
    }
    return false; // Return false on failure
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $productDescription = $_POST["product_description"];
    $eduSuites = $_POST["edu_suites"];
    $advModules = $_POST["adv_modules"];
    $therapeuticLandscapes = $_POST["therapeutic_landscapes"];

    if (addNewProduct($productsFile, $productName, $productDescription, $eduSuites, $advModules, $therapeuticLandscapes)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to add the product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1><?php echo isset($productToEdit) ? 'Edit Product' : 'Create New Product'; ?></h1>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required
                    value="<?php echo isset($productToEdit) ? $productToEdit['name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="4"
                    required><?php echo isset($productToEdit) ? $productToEdit['description'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="edu_suites">Educational Suites:</label>
                <textarea class="form-control" id="edu_suites" name="edu_suites"
                    rows="4"><?php echo isset($productToEdit) ? $productToEdit['applications']['Educational Suites'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="adv_modules">Adventure Modules:</label>
                <textarea class="form-control" id="adv_modules" name="adv_modules"
                    rows="4"><?php echo isset($productToEdit) ? $productToEdit['applications']['Adventure Modules'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="therapeutic_landscapes">Therapeutic Landscapes:</label>
                <textarea class="form-control" id="therapeutic_landscapes" name="therapeutic_landscapes"
                    rows="4"><?php echo isset($productToEdit) ? $productToEdit['applications']['Therapeutic Landscapes'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
