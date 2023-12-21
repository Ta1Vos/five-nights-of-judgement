<?php
/**
 *  Returns an array filled with files and/or directories found in the given directory.
 * @param string $directoryLink Required | The link that leads to the directory you wish to fetch files from.
 * @param bool $excludeDirectories Optional | Choose whether you'd like to include or exclude DIRECTORIES fetched, setting this to true will NOT fetch DIRECTORIES. Default is false.
 * @param bool $excludeFiles Optional | Choose whether you'd like to include or exclude FILES fetched, setting this to true will NOT fetch FILES. Default is false.
 * @return bool|array returns either false or an array, false if the array/directory is empty. The array is returned if it contains content.
 */
function fetchFilesFromDirectory(string $directoryLink, bool $excludeDirectories = false, bool $excludeFiles = false): false|array
{
    $files = scandir($directoryLink);

    if (!$files) {
        return false;
    }
    //Only runs if directories have to be excluded from array
    if ($excludeDirectories) {
        foreach ($files as $key => &$file) {
            if (is_dir($file)) {
                unset($files[$key]);//Removes directories out of the array
            }
        }
    }
    //Only runs if files have to be excluded from array
    if ($excludeFiles) {
        foreach ($files as $key => &$file) {
            if (is_file($file)) {
                unset($files[$key]);//Removes files out of the array
            }
        }
    }

    //Checks if an array has been created by the directory scan, otherwise goes to return false
    if (is_array($files)) {
        if (isset($files[0])) {
            if (trim($files[0]) == "." || trim($files[1] == "..")) {//Removes special directories called "." and ".." in case they are present
                $files = array_slice($files, 2);
            }
        }

        $files = array_values($files); //Organizes array

        if (count($files) > 0) {//Checks if content has been found and is present in array
            return $files;
        }
    }

    return false;
}

/**
 * Scan through a directory to find the given filename.
 * @param string $searchFromDirectoryPath Required | The path to the directory where you would like to start the scan.
 * @param string $fileName Required | The name you're willing to search.
 * @return false|string Returns false if file has not been found or if something fails. Returns the string with the updated directory path if the file has been found.
 */
function scanForFileName(string $searchFromDirectoryPath, string $fileName): false|string
{
    $directories = fetchFilesFromDirectory($searchFromDirectoryPath, false, true);

    if ($directories) {
        //Scans for directories within the directory, then searches within that one
        foreach ($directories as $childDirectory) {
            $directoryLink = $searchFromDirectoryPath . "/" . $childDirectory;

            //CHECKS IF DIRECTORY CONTAINS DIRECTORIES, OTHERWISE CONTINUES THE FILE CHECK
            if (is_dir($directoryLink)) {
                //In the case a directory has been found, the function will go to search through that one too, until the end of a directory has been reached.
                $childDirectoryResult = scanForFileName($directoryLink, $fileName);
                //Only returns the file path if it has been found in a child directory.
                if ($childDirectoryResult) {
                    return $childDirectoryResult;
                }
            }
        }
    }
    //Fetches all the files within the current directory to see whether it contains the one that is being searched for.
    $files = fetchFilesFromDirectory($searchFromDirectoryPath, true);

    //ONLY CONTINUES IF THERE ARE FILES
    if ($files) {
        //Loops through the directory's files to see if any of them are equal to the one that is being searched.
        foreach ($files as $file) {
            if ($file == $fileName) {
                //Returns the current directory we're in, which contains the right file
                return $searchFromDirectoryPath . "/$file";
            }
        }
    }

    //Returns false if no file has been found.
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
function echoArrayContents(array $array, string $contentAtStart = "", string $contentAtEnd = "")
{
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

/**
 * Performs a given echo if $conditionalValue is equal to $secondConditionalValue
 * @param mixed $conditionalValue Required | The first condition you're checking
 * @param mixed $secondConditionalValue Required | The second condition you're checking
 * @param string $echo Required | The echo that occurs if the condition is <b>true</b>
 * @param string|null $elseEcho Optional | The echo that occurs if the condition is <b>false</b>
 * @return null
 */
function echoUnderCondition(mixed $conditionalValue, mixed $secondConditionalValue, string $echo, string $elseEcho = null) {
    if ($conditionalValue == $secondConditionalValue) {
        echo $echo;
    } else if (isset($elseEcho)) {
        echo $elseEcho;
    }
    return null;
}

/**
 * Delete an image from the img folder.
 * @param string $pathToImg Required | The path that leads to the image that has to be deleted.
 * @return bool
 */
function deleteImage(string $pathToImg):bool
{
    if (file_exists($pathToImg)) {
        //Extra check which makes sure only files in the map "img" can be deleted.
        if (str_contains($pathToImg, "img")) {
            return unlink($pathToImg);
        }
    }

    return false;
}