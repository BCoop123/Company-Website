<?php
function readCSVData($filename) {
    if (file_exists($filename)) {
        $CSVList = array();
        $f = fopen($filename, "r");
        while ($record = fgetcsv($f)) {
            array_push($CSVList, $record);
        }
        fclose($f);
        return $CSVList;
    }
    else return '404 File Not Found';
}
?>

<!--
 
-->