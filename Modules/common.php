<?php

function getTitle() {
    global $title, $titleSuffix;
    return $title . $titleSuffix;
}

/**
 * Compares the keys of an Object and an Array to see if the Array contains the keys of the Object.
 * @param object $object the object you want to compare the array with
 * @param array $content the array you want to compare the object with
 * @return array|false returns either false or an array with the legitimate content
 */
function validateObjectWithArray(object $object, array $content):array|false {
    $contentValid = true;
    $classProperties = get_object_vars($object);

    foreach ($classProperties as $key => $item) {//Grabs the required keys
        $keyIsEqual = false;

        foreach ($content as $contentKey => $contentItem) {//Checks if required keys exist in the given content
            if ($key === $contentKey) {//Key is found & break current loop
                $keyIsEqual = true;
                break;
            }
        }

        if (!$keyIsEqual) {//If key is not found, do not let content pass
            $contentValid = false;
        }
    }

    if ($contentValid) {//If all required keys are present, return true
        return $content;
    }

    return false;
}
