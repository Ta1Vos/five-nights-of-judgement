<?php
/**
 * Returns an array filled with files found in the given directory.
 * @param string $directoryLink Required | The link that leads to the directory you wish to fetch files from.
 * @param bool $excludeDirectories Optional | Choose whether you'd like to include or exclude directories fetched, setting this to true will NOT fetch directories. Standard is false.
 * @return bool|array returns either false or an array, false if the array/directory is empty. The array is returned if it contains content.
 */
function fetchFilesFromDirectory(string $directoryLink, bool $excludeDirectories = false):false|array {
    $files = scandir($directoryLink);

    if (!$excludeDirectories) {
        foreach ($files as $key => $file) {
            if (is_dir($file)) {
                unset($files[$key]);//Removes directories out of the array
            }
        }
    }

    $files = array_values($files); //Organizes array

    if (count($files) > 0) {//Checks if content has been found
        return $files;
    }

    return false;
}

function loadCategoryImages():bool {
    return false;
}