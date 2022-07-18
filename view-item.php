<?php

use function PHPSTORM_META\type;

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
    
    // Set current item
    $isValid = false;
    if (is_numeric($_GET["id"])) {
        $currentItem = $item->getItem($_GET["id"]);
        
        if ($currentItem != -1) {
            $currentItemCategory = $category->getCategory($item->getCategoryId());
            $isValid = true;
        }
    }

    // If item was added to cart
    if (isset($_POST["buy"])) {
        // Check product id and qty are not empty
        if (!empty($_POST["productId"]) && !empty($_POST["quantity"])) {
            $productId = $_POST["productId"];
            $quantity = $_POST["quantity"];

            if ($quantity < 1) {
                $quantity = 1;
            }

            // Get the item details
            $item->getItem($productId);
            // Create a new cart item so it can be added to the shopping cart
            $cartItem = new CartItem(
                $item->getItemName(),
                $item->getDescription(),
                $item->getPhoto(),
                $quantity,
                $item->getSalePrice() == 0 || $item->getSalePrice() == null ? $item->getPrice() : $item->getSalePrice(),
                $item->getItemID()
            );
            // Check if shopping cart exists
            if (!isset($_SESSION["cart"])) {
                // If shopping cart is not set create a new empty shopping cart
                $cart = new ShoppingCart();
            } else {
                // Read shopping cart from session
                $cart = $_SESSION["cart"];
            }
            // Add item to shopping cart
            $cart->addItem($cartItem);
            // Save shopping cart back into session
            $_SESSION["cart"] = $cart;
        }
    }

    $title = "Sports Warehouse - View Item";
    $urls = include "settings/urls.php";

    ob_start();

    if (!$isValid) {
        include "templates/itemNotValid.html.php";   
    } else {
        include "templates/displayItemDetails.html.php";
    }

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>