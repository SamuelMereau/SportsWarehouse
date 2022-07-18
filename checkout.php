<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";
    require_once "classes/FormValidation.php";

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

    ob_start();
    
    if (!$cartItems) {
        header('Location:'.$urls["home"]);
        die();
    }
    
    // Form Validation
    $form = new FormValidation();
    
    if (isset($_POST["submit"])) {
        // Validate name
        $firstName = $form->checkEmpty("first-name");
        $lastName = $form->checkEmpty("last-name");

        // Validate address
        $streetAddress = $form->checkEmpty("street-address");
        $city = $form->checkEmpty("city");
        $state = $form->checkState("state", true);
        $postCode = $form->checkPostcode("postcode", true);

        // Validate contact number
        $contactNumber = $form->checkContactNumber("contact-number", true);

        // Validate email address
        $emailAddress = $form->checkEmail("email-address", true);

        // Validate name on card
        $nameOnCard = $form->checkEmpty("name-on-card");

        // Validate card number
        $cardNumber = $form->checkCardNumber("card-number", true);

        // Validate card expiration
        $cardExpirationMonth = $form->checkExpirationMonth("card-expiration-month", true);
        $cardExpirationYear = $form->checkExpirationYear("card-expiration-year", true);

        // Validate card CVC / CVV
        $cardCVC = $form->checkCVC("card-cvc", true);

        if ($form->valid == true) {
            $streetAddressLine2 = empty($_POST["street-address-2"]) ? "" : $_POST["street-address-2"].", ";
            $address = $_POST["street-address"].", ".$streetAddressLine2.$_POST["city"].", ".$_POST["state"].", ".$_POST["postcode"];
            // Save cart order
            $shoppingOrderId = $cart->saveCart(
                $address,
                $_POST["contact-number"],
                $_POST["card-number"],
                $_POST["card-cvc"],
                $_POST["email-address"],
                $_POST["card-expiration-month"]."/".$_POST["card-expiration-year"],
                $_POST["first-name"],
                $_POST["last-name"],
                $_POST["name-on-card"]
            );
            $cart->clearCart($shoppingOrderId);
            include "templates/displayThanks.html.php";
        } else {
            include "templates/displayCheckoutForm.html.php";
        }
    } else {
        // Display form without errors
        $form->valid = true;
        $firstName = "";
        $lastName = "";
        $streetAddress = "";
        $city = "";
        $state = "";
        $postCode = "";
        $contactNumber = "";
        $emailAddress = "";
        $nameOnCard = "";
        $cardNumber = "";
        $cardExpirationMonth = "";
        $cardExpirationYear = "";
        $cardCVC = "";
        include "templates/displayCheckoutForm.html.php";
    }

    $output = ob_get_clean();

    include "templates/layout.html.php";