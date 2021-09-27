<?php  
require_once 'controllers/usercontrols.php';
require_once 'controllers/productcontrollers.php';

if($_SERVER['REQUEST_METHOD'] == "GET") {
    $uri = basename($_SERVER['REQUEST_URI']);
    switch($uri) {
        case "logout":
            logout();
            break;
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_POST['action'];

    switch($action) {
        case "register":
            register($_POST);
            break;
        case "login":
            login($_POST);
            break;
        case "add_food":
            add_food($_POST);
            break;
        case "add_drink":
            add_drink($_POST);
            break;
        case "removeD":
            remove_drink($_POST);
            break;
        case "removeF":
            remove_food($_POST);
            break;
        case "edit_food":
            edit_food($_POST);
            break;
        case "edit_drink":
            edit_drink($_POST);
            break;
        case "book_table":
            book_table($_POST);
            break;
        case "order":
            order($_POST);
            break;
        case "records":
            records($_POST);
            break;
    }
}
?>