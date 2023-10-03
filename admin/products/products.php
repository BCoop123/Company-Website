<?php
// Creates a table that contains file names and contents of a folder
function createTable($headings, $products) {
    echo '
    <div class="container-fluid">
        <!-- Bootstrap table -->
        <table class="table" style="width: 90%; margin: auto;">
            <thead>
                <tr>
    ';
    foreach ($headings as $heading) {
        echo '<th>' . $heading . '</th>';
    }
    echo '
                </tr>
            </thead>
            <tbody>
    ';
    foreach ($products as $product) {
        echo '
            <tr>
                <td><a href="./detail.php?name=' . urlencode($product[0]) . '">' . $product[0] . '</a></td>
                <td>' . $product[1] . '</td>
                <td>' . $product[2]["Educational Suites"] . '</td>
                <td>' . $product[2]["Adventure Modules"] . '</td>
                <td>' . $product[2]["Therapeutic Landscapes"] . '</td>
            </tr>
        ';
    }
    echo '
            </tbody>
        </table>
    </div>
    ';
}

function getProductInfo($dir_path) {
    $productsArray = [];

    // Open the directory
    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            // Check if it's a file and not a directory
            if (is_file($file_path)) {        
                // Fetch and decode the contents of the file
                $contents = file_get_contents($file_path);
                $products = json_decode($contents, true); // true for associative array

                if (is_array($products) && !empty($products)) {
                    foreach ($products as $product) {
                        $productsArray[] = [
                            $product["name"],
                            $product["description"],
                            $product["applications"]
                        ];
                    }
                }
            }
        }

        // Close the directory handle
        closedir($dir_handle);
    } else {
        echo "Failed to open directory!";
    }
    return $productsArray;
}
function getProductDetails($productName) {
    $jsonFile = "../../data/products/products.json";

    if (file_exists($jsonFile)) {
        $productsData = json_decode(file_get_contents($jsonFile), true);

        foreach ($productsData as $product) {
            if ($product['name'] === $productName) {
                return $product;
            }
        }
    } else {
        echo "Products file not found.";
    }

    return null;
}

function editProduct($productName, $newData) {
    $jsonFile = "../../data/products/products.json";

    if (file_exists($jsonFile)) {
        $productsData = json_decode(file_get_contents($jsonFile), true);

        // Search for the product by name
        foreach ($productsData as $index => $product) {
            if ($product['name'] === $productName) {
                // Overwrite the product data
                $productsData[$index] = $newData;

                // Save the updated data back to the file
                return file_put_contents($jsonFile, json_encode($productsData, JSON_PRETTY_PRINT)) !== false;
            }
        }
    } else {
        echo "Products file not found.";
        return false;
    }
}

function deleteProduct($productName) {
    $jsonFile = "../../data/products/products.json";

    if (file_exists($jsonFile)) {
        $productsData = json_decode(file_get_contents($jsonFile), true);

        // Search for the product by name
        foreach ($productsData as $index => $product) {
            if ($product['name'] === $productName) {
                // Remove the product from the array
                array_splice($productsData, $index, 1);

                // Save the updated data back to the file
                return file_put_contents($jsonFile, json_encode($productsData, JSON_PRETTY_PRINT)) !== false;
            }
        }
    } else {
        echo "Products file not found.";
        return false;
    }
}
?>