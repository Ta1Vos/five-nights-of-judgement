<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role admin
if (!isMember()) {
    logout();
    header ("location:/home");
} else {

    /*$params[1] is the member role in case its being used.
     * $params[2] is the action (the page you are visiting).
     *$params[3] is parameter you give to the page.
     *the switch statement checks which page you want to go.
     */
    switch ($params[2]) {

        case 'products':
            break;
        case 'profile':
            break;
        case 'editprofile':
            break;
        case 'changepassword':
            break;

        case 'categories':
            break;

        case 'category':
            break;

        case 'product':
            break;

        case 'review':
            break;

        default://Default is always home
            break;
    }
}