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
                                <td><a href="./detail.php?id=' . $key . '">' . $file[0] . '</a></td>
                                <td>' . $file[1] . '</td>
                                <td>' . $file[2] . '</td>
                            </tr>
                        ';
                    };
    echo '
            </tbody>
        </table>
    </div>
    ';
}

function getTeamInfo($dir_path) {
    $teamArray = [];

    // Open the directory
    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            // Check if it's a file and not a directory
            if (is_file($file_path)) {        
                // Fetch and decode the contents of the file
                $contents = file_get_contents($file_path);
                $team = json_decode($contents, true); // true for associative array

                if (is_array($team) && !empty($team)) {
                    foreach ($team as $member) {
                        $teamArray[] = [
                            $member["name"],
                            $member["title"],
                            $member["details"]
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
    return $teamArray;
}

// Function to add a new team member to the JSON file
function addNewTeamMember($teamFile, $name, $title, $details) {
    // Read existing JSON data from the file
    $existingData = file_get_contents($teamFile);
    $team = json_decode($existingData, true); // true for associative array

    if (!is_array($team)) {
        $team = []; // Initialize as an empty array if the file is empty or invalid
    }

    // Check if the team member already exists in the array
    foreach ($team as $key => $member) {
        if ($member["name"] === $name) {
            // Update the team member's information
            $team[$key]["title"] = $title;
            $team[$key]["details"] = $details;

            // Encode the updated array as JSON
            $jsonContent = json_encode($team, JSON_PRETTY_PRINT);

            // Write the updated JSON data back to the file
            if (file_put_contents($teamFile, $jsonContent) !== false) {
                return true; // Return true on success
            }
            return false; // Return false on failure
        }
    }

    // If the team member doesn't exist, add them as a new member
    $newMember = [
        "name" => $name,
        "title" => $title,
        "details" => $details
    ];
    $team[] = $newMember;

    // Encode the updated array as JSON
    $jsonContent = json_encode($team, JSON_PRETTY_PRINT);

    // Write the updated JSON data back to the file
    if (file_put_contents($teamFile, $jsonContent) !== false) {
        return true; // Return true on success
    }
    return false; // Return false on failure
}

// Function to edit an existing team member in the JSON file
function editTeamMember($teamFile, $name, $title, $details) {
    // Read existing JSON data from the file
    $existingData = file_get_contents($teamFile);
    $team = json_decode($existingData, true); // true for associative array

    if (!is_array($team)) {
        return false; // If the file is empty or invalid, exit early
    }

    $found = false; // Flag to check if member was found and updated
    // Check if the team member exists in the array
    foreach ($team as $key => $member) {
        if ($member["name"] === $name) {
            // Update the team member's information
            $team[$key]["title"] = $title;
            $team[$key]["details"] = $details;
            $found = true;
            break; // Exit the loop as we've found and updated the member
        }
    }

    if (!$found) {
        return false; // Team member not found
    }

    // Encode the updated array as JSON
    $jsonContent = json_encode($team, JSON_PRETTY_PRINT);

    // Write the updated JSON data back to the file
    return (file_put_contents($teamFile, $jsonContent) !== false);
}

function addOrUpdateTeamMember($teamFile, $key, $name, $title, $details) {
    $team = json_decode(file_get_contents($teamFile), true);
    
    $team[$key] = [
        "name" => $name,
        "title" => $title,
        "details" => $details
    ];

    return file_put_contents($teamFile, json_encode($team, JSON_PRETTY_PRINT)) !== false;
}

function deleteTeamMember($teamFile, $key) {
    $team = json_decode(file_get_contents($teamFile), true);

    if (isset($team[$key])) {
        unset($team[$key]);
        return file_put_contents($teamFile, json_encode($team, JSON_PRETTY_PRINT)) !== false;
    }

    // If we reached here, the key wasn't found
    return false;
}

?>