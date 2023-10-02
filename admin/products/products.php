<?php
// Creates a table that contains file names and contents of a folder
function createTable($headings, $files) {
    echo '
    <div class="container-fluid">
        <!-- Bootstrap table -->
        <table class="table" style="width: 90%; margin: auto;">
            <thead>
                <tr>
    ';
                    foreach ($headings as $key => $heading) {
                        echo '
                            <th>' . $heading . '</th>
                        ';
                    };
    echo '
                </tr>
            </thead>
            <tbody>
    ';
                    foreach ($files as $key => $file) {
                        echo '
                            <tr>
                                <td><a href="./detail.php?file=' . $file[0] . '">' . $file[0] . '</a></td>
                                <td>' . $file[1] . '</td>
                                <td>' . $file[2]["Educational Suites"] . '</td>
                                <td>' . $file[2]["Adventure Modules"] . '</td>
                                <td>' . $file[2]["Therapeutic Landscapes"] . '</td>
                            </tr>
                        ';
                    };
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
?>


