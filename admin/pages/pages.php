<?php

class Pages {
    // Function to get the file names and file contents of a directory
    public static function getPageInfo($dir_path) {
        $files = [];

        $dir_handle = opendir($dir_path);

        if ($dir_handle) {
            while (false !== ($filename = readdir($dir_handle))) {
                $file_path = $dir_path . "/" . $filename;

                if (is_file($file_path)) {
                    $contents = file_get_contents($file_path);
                    $files[] = new Page($filename, $contents);
                }
            }

            closedir($dir_handle);
        } else {
            echo "Failed to open directory!";
        }
        return $files;
    }

    // Function to get the contents of a specific page
    public static function getPageContent($dir_path, $fileName) {
        $file_path = $dir_path . "/" . $fileName;

        if (is_file($file_path)) {
            $pageContent = file_get_contents($file_path);
            return $pageContent;
        } else {
            return null;
        }
    }

    // Function to add a new page to the TXT files
    public static function addNewPage($pagesDir, $filename, $contents) {
        if (!empty($filename) && !empty($contents)) {
            $file_path = $pagesDir . "/" . $filename;

            if (file_put_contents($file_path, $contents) !== false) {
                return true;
            }
        }
        return false;
    }

    // Function to delete a page file
    public static function deleteFile($txtFileName) {
        if (file_exists($txtFileName)) {
            return unlink($txtFileName);
        }
        return false;
    }
}

// Function to create a table for displaying pages
function createTable($headings, $files) {
    echo '
    <div class="container-fluid">
        <table class="table" style="width: 90%; margin: auto;">
            <thead>
                <tr>
    ';
    foreach ($headings as $key => $heading) {
        echo '
            <th>' . $heading . '</th>
        ';
    }
    echo '
                </tr>
            </thead>
            <tbody>
    ';
    foreach ($files as $key => $file) {
        $file->printPage();
    }
    echo '
            </tbody>
        </table>
    </div>
    ';
}

// Function to delete the contents of a text file
function deleteTxtFileContents($txtFileName) {
    $file = fopen($txtFileName, 'w');
    fclose($file);
}

// Function to get the first few words from a text file
function getFirstWordsFromFile($txtFileName, $numWords = 10) {
    $content = file_get_contents($txtFileName);
    $words = preg_split('/\s+/', $content, $numWords + 1);
    return implode(' ', array_slice($words, 0, $numWords));
}

// Function to edit a page file
function editFile($dir_path, $txtFileName) {
    $files = [];

    $dir_handle = opendir($dir_path);

    if ($dir_handle) {
        while (false !== ($filename = readdir($dir_handle))) {
            $file_path = $dir_path . "/" . $filename;

            if (is_file($file_path) and $filename === $txtFileName) {
                $contents = file_get_contents($file_path);
                print($contents);
            }
        }

        closedir($dir_handle);
    } else {
        echo "Failed to open directory!";
    }
    return $files;
}

function getPageContent($dir_path, $fileName) {
    // Construct the full path to the file
    $file_path = $dir_path . "/" . $fileName;

    // Check if the file exists and is a file (not a directory)
    if (is_file($file_path)) {
        // Fetch the contents of the file
        $pageContent = file_get_contents($file_path);
        return $pageContent;
    } else {
        return null;  // File doesn't exist or is not a valid page
    }
}

// Function to add a new page to the TXT files
function addNewPage($pagesDir, $filename, $contents) {
    // Check if both the filename and contents are not empty
    if (!empty($filename) && !empty($contents)) {
        // Combine the directory path and filename
        $file_path = $pagesDir . "/" . $filename;

        // Write the contents to the file
        if (file_put_contents($file_path, $contents) !== false) {
            return true; // Return true on success
        }
    }
    return false; // Return false on failure or empty input
}

function deleteFile($txtFileName) {
    // Check if the file exists before trying to delete
    if (file_exists($txtFileName)) {
        return unlink($txtFileName); // Returns true if file deletion is successful, false otherwise
    }
    return false; // Return false if file doesn't exist
}

class Page {
    // Specify private variables
    private $pageName;
    private $pageContent;

    // Constructor
    public function __construct($pageName, $pageContent) {
        $this->setName($pageName);
        $this->setContent($pageContent);
    }

    public function setName($name) {
        $this->pageName = $name;
    }

    public function setContent($content) {
        $this->pageContent = $content;
    }

    public function printPage() {
        echo '
        <tr>
            <td><a href="./detail.php?file=' . urlencode($this->pageName) . '">' . $this->pageName . '</a></td>
            <td>' . $this->pageContent . '</td>
        </tr>
        ';
    }

}


?>
