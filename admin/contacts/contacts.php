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
                                <td><a href="./detail.php?file=' . $file[2] . '">' . $file[2] . '</a></td>
                                <td>' . $file[0] . '</td>
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

function getContactsInfo($dir_path) {
    $contactsArray = [];

    // Open the directory
    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            // Check if it's a file and not a directory
            if (is_file($file_path)) {        
                // Fetch and decode the contents of the file
                $contents = file_get_contents($file_path);
                $contacts = json_decode($contents, true); // true for associative array

                if (is_array($contacts) && !empty($contacts)) {
                    foreach ($contacts as $contact) {
                        $contactsArray[] = [
                            $contact["name"],
                            $contact["email"],
                            $contact["subject"]
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
    return $contactsArray;
}

function appendToJSONFile($filename, $data) {
    // Check if the file exists
    if (file_exists($filename)) {
        $current_data = json_decode(file_get_contents($filename), true);
    } else {
        $current_data = array();
    }

    // Append the new data
    $current_data[] = $data;

    // Save the updated data
    file_put_contents($filename, json_encode($current_data, JSON_PRETTY_PRINT));
}

// Ensure that the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $comments = $_POST['comments'] ?? '';

    $formData = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'comments' => $comments
    ];

    $filename = '../../data/contacts/contacts.json';

    appendToJSONFile($filename, $formData);

?>