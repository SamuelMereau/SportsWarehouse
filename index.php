<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";

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

    $title = "Sports Warehouse - Home";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();

    ob_start();

    include "templates/displaySlideshow.html.php";
    include "templates/displayFeaturedProducts.html.php";
    include "templates/displayPartnerships.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>