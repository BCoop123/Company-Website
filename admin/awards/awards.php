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
                <td><a href="./detail.php?award=' . urlencode($file[0]) . '">' . $file[0] . '</a></td>
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
function deleteAwardFromCSV($csvFileName, $awardIndex) {
    // Check if the CSV file exists
    if (file_exists($csvFileName)) {
        // Read the CSV file into an array
        $csvData = file($csvFileName);

        // Check if the award index is within the valid range
        if ($awardIndex >= 0 && $awardIndex < count($csvData)) {
            // Remove the line at the specified index
            unset($csvData[$awardIndex]);

            // Re-index the array to remove gaps
            $csvData = array_values($csvData);

            // Write the updated data back to the CSV file
            file_put_contents($csvFileName, implode('', $csvData));

            // Return true to indicate successful deletion
            return true;
        } else {
            // Invalid award index
            return false;
        }
    } else {
        // CSV file does not exist
        return false;
    }
}
function getAwardDetails($csv_path, $awardName) {
    $awardDetails = null;

    if (is_file($csv_path) && pathinfo($csv_path, PATHINFO_EXTENSION) === 'csv') {        
        if (($handle = fopen($csv_path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($data[0] === $awardName) { // Check if the first column matches the award name
                    $awardDetails = $data;
                    break;
                }
            }
            fclose($handle);
        }
    }

    return $awardDetails;
}
?>
