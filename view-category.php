<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";
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

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();
    
    // Set current category
    $isValid = false;
    if (is_numeric($_GET["id"])) {
        $currentCategory = $category->getCategory($_GET["id"]);

        if ($currentCategory != -1) {
            $isValid = true;
        }
    }

    $title = "Sports Warehouse - View Category";
    $urls = include "settings/urls.php";

    if ($isValid) {
        $itemRows = $item->getItemsByCategoryId($_GET["id"]);
    }

    ob_start();

    if (!$isValid) {
        include "templates/categoryNotValid.html.php";   
    } else {
        include "templates/displayItemsInCategory.html.php";
    }

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>