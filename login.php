<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";
    require_once "classes/Authentication.php";

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

    $title = "Sports Warehouse - Login";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();

    if(isset($_POST["loginSubmit"]))
    {
        if(!empty($_POST["username"]) && !empty($_POST["password"]))
        {
            $loginSuccess = Authentication::login($_POST["username"], $_POST["password"]);

            if (!$loginSuccess)
            {
                $message = "Username or password incorrect";
                $error = true; 
            }
        }
    }

    ob_start();

    include "templates/displayLoginForm.html.php";

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>