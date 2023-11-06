<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/home");
} else {
/* $params[2] is de action
   $params[3] is een getal die de delete action nodig heeft
*/
    switch ($params[2]) {

        case 'home':
            break;

        case 'products':
            break;

        case 'add':
            break;

        case 'delete':
            break;

        default:
            break;
    }
}