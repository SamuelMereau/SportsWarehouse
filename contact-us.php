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

    $title = "Sports Warehouse - Contact Us";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();

    $form = new FormValidation();

    ob_start();

    // Check submit button was pressed
    if (isset($_POST["submitBtn"])) {
        // Validate first and last name
        $firstNameMessage = $form->checkEmpty("first-name");
        $lastNameMessage = $form->checkEmpty("last-name");

        // Validate first and last name is in the allowed format
        if ($firstNameMessage == "") {
            $firstNameMessage = $form->checkName("first-name", true); 
        }
        if ($lastNameMessage == "") {
            $lastNameMessage = $form->checkName("last-name", true); 
        }

        // Validate email address
        $emailMessage = $form->checkEmail("email-addr", true);

        // Validate question
        $questionMessage = $form->checkEmpty("question");

        if ($form->valid == true) {
            include "templates/displayFormSent.html.php";
        } else {
            include "templates/displayContactForm.html.php";
        }
    } else {
        $form->valid = true;
        $firstNameMessage = "";
        $lastNameMessage = "";
        $emailMessage = "";
        $questionMessage = "";
        include "templates/displayContactForm.html.php";
    }

    $output = ob_get_clean();
    
    include "templates/layout.html.php";
?>