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
                                <td><a href="./edit.php?file=' . $file[0] . '">' . $file[0] . '</a></td>
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

// Gets the file names and file contents of a directory
function getPageInfo($dir_path) {
    $files = [];

    // Open the directory
    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            // Check if it's a file and not a directory
            if (is_file($file_path)) {        
                // Fetch and print the contents of the file
                $contents = file_get_contents($file_path);
                $files[] = [$filename, $contents];
            }
        }

        // Close the directory handle
        closedir($dir_handle);
    } else {
        echo "Failed to open directory!";
    }
    return $files;
}

?>