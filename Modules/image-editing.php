<?php
/**
 *  Returns an array filled with files and/or directories found in the given directory.
 * @param string $directoryLink Required | The link that leads to the directory you wish to fetch files from.
 * @param bool $excludeDirectories Optional | Choose whether you'd like to include or exclude DIRECTORIES fetched, setting this to true will NOT fetch DIRECTORIES. Default is false.
 * @param bool $excludeFiles Optional | Choose whether you'd like to include or exclude FILES fetched, setting this to true will NOT fetch FILES. Default is false.
 * @return bool|array returns either false or an array, false if the array/directory is empty. The array is returned if it contains content.
 */
function fetchFilesFromDirectory(string $directoryLink, bool $excludeDirectories = false, bool $excludeFiles = false):false|array {
    $files = scandir($directoryLink);

    if (!$excludeDirectories) {
        foreach ($files as $key => $file) {
            if (is_dir($file)) {
                unset($files[$key]);//Removes directories out of the array
            }
        }
    } else if (!$excludeFiles) {
        foreach ($files as $key => $file) {
            if (is_file($file)) {
                unset($files[$key]);//Removes files out of the array
            }
        }
    }

    if (is_array($files)) {
        $files = array_values($files); //Organizes array

        if (count($files) > 0) {//Checks if content has been found
            return $files;
        }
    }

    return false;
}

/**
 * Echo all items in an array. Add optional text at the beginning and at the end of the echo.<br><br>
 * REPLACE DESIRED ITEM VALUES IN THE $contentAtStart AND END $contentAtEnd WITH '#replace' TO MAKE THAT GET REPLACED BY THE VALUE.
 * @param array $array Required | The array of which you wish to echo the items
 * @param string $contentAtStart Optional | The content you wish to add in front of the item echo.
 * @param string $contentAtEnd Optional | The content you wish to add at the end of the item echo.
 * @return null
 */
function echoArrayContents(array $array, string $contentAtStart = "", string $contentAtEnd = "") {
    foreach ($array as $item) {
        //Replaces "#replace" with the $item
        $startContent = str_replace("#replace", $item, $contentAtStart);
        $endContent = str_replace("#replace", $item, $contentAtEnd);
        //Echoes content
        echo $startContent;
        echo $item;
        echo $endContent;
    }

    return null;
}