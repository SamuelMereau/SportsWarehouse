<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/DBAccess.php";
    require_once "classes/Category.php";
    require_once "classes/Item.php";
    require_once "classes/FormValidation.php";
    
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["cart"])) {
        // If shopping cart is not set create a new empty shopping cart
        $cart = new ShoppingCart();
    } else {
        // Read shopping cart from session
        $cart = $_SESSION["cart"];
    }

    $title = "Sports Warehouse - Search";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();
    
    ob_start();

    if (isset($_GET["search"]) && strlen($_GET["search"]) > 0) {
        $search = $_GET["search"];
        $foundItems = $item->getItemsByName($search);

        if (empty($foundItems)) {
            include "templates/searchNoResults.html.php";
        } else {
            include "templates/displaySearchResults.html.php";
        }

    } else {
        include "templates/searchNotValid.html.php";
    }

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>