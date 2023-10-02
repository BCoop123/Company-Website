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
                            </tr>
                        ';
                    };
    echo '
            </tbody>
        </table>
    </div>
    ';
}

function getAwardInfo($dir_path) {
    $productsArray = [];

    // Open the directory
    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            // Check if it's a CSV file and not a directory
            if (is_file($file_path) && pathinfo($file_path, PATHINFO_EXTENSION) === 'csv') {        
                
                // Open the CSV file for reading
                if (($handle = fopen($file_path, "r")) !== FALSE) {

                    // Read each line of CSV and store the data
                    while (($product = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $productsArray[] = [
                            $product[0],
                            $product[1]
                        ];
                    }
                    fclose($handle);
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

?>