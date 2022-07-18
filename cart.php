<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["cart"])) {
        //if shopping cart is not set create a new empty shopping cart
        $cart = new ShoppingCart();
    } else {
        //read shopping cart from session
        $cart = $_SESSION["cart"];
    }

    $title = "Sports Warehouse - Cart";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();

    // Save shopping cart back into session
    $_SESSION["cart"] = $cart;

    $cartItems = $cart->getItems();
    
    //remove item from shopping cart
    if (isset($_POST["remove"])) {
        //check product id was supplied and cart exists in session
        if (!empty($_POST["productId"]) && isset($_SESSION["cart"])) {
            $productId = $_POST["productId"];
            //create a new cart item so it can be removed from the shopping cart
            //the only value that is important is the product Id
            $cartItem = new CartItem("", "", "", 0, 0, $productId);
            //read shopping cart from session
            $cart = $_SESSION["cart"];
            //remove item from shopping cart
            $cart->removeItem($cartItem);
            //save shopping cart back into session
            $_SESSION["cart"] = $cart;
        }
    }

    ob_start();

    include "templates/cartPage.html.php";
    
    $output = ob_get_clean();

    include "templates/layout.html.php";