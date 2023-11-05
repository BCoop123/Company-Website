<?php

//================================================================================
// Utility Class for Awards
//================================================================================

class Awards {

    //display awards
    public static function displayAwards($dir_path) {
        //get array of awards
        $awards = self::readAwards($dir_path);
        $headings = ["Award", "Description"];

        //Create the table
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
        foreach ($awards as $key => $award) {
            $award->printAward();
        };
        echo '
                </tbody>
            </table>
        </div>
        ';
    }

    //================================================================================
    // Create
    //================================================================================

    public static function createAward($awardsFile, $name, $description) {
        // Open the CSV file for writing (append mode)
        $file = fopen($awardsFile, "a");

        // Check if the file was opened successfully
        if ($file) {
            // Prepare the data as a CSV line
            $newAward = '"' . $name . '","' . $description . '"';
            
            // Write the new award data to the file
            fwrite($file, $newAward . PHP_EOL);

            // Close the file
            fclose($file);

            return true; // Return true on success
        } else {
            return false; // Return false on failure
        }
    }

    //================================================================================
    // Read
    //================================================================================

    public static function readAwards($dir_path) {
        $awardsArray = [];

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
                        while (($award = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $awardsArray[] = new Award($award[0], $award[1]);
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
        return $awardsArray;
    }

        //read an award with a certian name
        public static function readAward($dir_path, $awardName) {
            $awardDetails = null;
    
            if (is_file($dir_path) && pathinfo($dir_path, PATHINFO_EXTENSION) === 'csv') {        
                if (($handle = fopen($dir_path, "r")) !== FALSE) {
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

    //================================================================================
    // Update
    //================================================================================

    public static function updateAward($awardsFile, $awardName, $updatedAwardName, $updatedAwardDescription) {
        self::deleteAward($awardsFile, $awardName);
        self::createAward($awardsFile, $updatedAwardName, $updatedAwardDescription);
        return True;
    }

    //================================================================================
    // Delete
    //================================================================================

    public static function deleteAward($csvFileName, $awardName) {
        // Check if the CSV file exists
        if (file_exists($csvFileName)) {
            // Read the CSV file into an array
            $csvData = file($csvFileName);
            $newCsvData = [];

            foreach ($csvData as $line) {
                // Split the CSV line into columns
                $columns = str_getcsv($line);
                
                // Check if the first column matches the award name
                if (trim($columns[0], '"') !== $awardName) {
                    $newCsvData[] = $line;  // Store lines that don't match the award name
                }
            }

            // Write the updated data back to the CSV file
            file_put_contents($csvFileName, implode('', $newCsvData));

            // Return true if the new data is shorter than the original data, meaning an award was deleted
            return count($newCsvData) < count($csvData);
        } else {
            // CSV file does not exist
            return false;
        }
    }
}

//================================================================================
// Class for Award
//================================================================================

class Award {
    //specify private variables
    private $awardName;
    private $awardDesc;

    //constructor
    public function __construct($awardName, $awardDesc) {
        $this -> setName($awardName);
        $this -> setDesc($awardDesc);
    }

    public function setName($name) {
        $this -> awardName = $name;
    }

    public function setDesc($desc) {
        $this -> awardDesc = $desc;
    }

    public function printAward() {
        echo '
        <tr>
            <td><a href="./detail.php?award=' . urlencode($this->awardName) . '">' . $this->awardName . '</a></td>
            <td>' . $this->awardDesc . '</td>
        </tr>
        ';
    }
}
?>
