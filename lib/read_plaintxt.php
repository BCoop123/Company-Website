<?php
    function readPlainTextData($filename) {
        if (file_exists($filename)) {
            $contents = file_get_contents($filename);
            return $contents;
        }
        else return '404 File Not Found';
    }
?>