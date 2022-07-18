<?php
    require_once "classes/ShoppingCart.php";
    require_once "classes/Item.php";
    require_once "classes/Category.php";
    require_once "classes/Authentication.php";
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

    $title = "Sports Warehouse - Dashboard";
    $urls = include "settings/urls.php";

    $item = new Item();
    $itemRows = $item->getItems();

    $category = new Category();
    $categoryRows = $category->getCategories();
    
    $form = new FormValidation();

    Authentication::protect();

    ob_start();

    $updateSuccess = "";

    if (isset($_GET["tool"])) {
        switch ($_GET["tool"]) {
            /*  
             *  --------------------
             *  UPDATE PASSWORD 
             *  --------------------
             */
            case "update-password":
                if (isset($_POST["confirm"])) {
                    $oldPassword = $form->checkEmpty("old-password");
                    $newPassword = $form->checkEmpty("new-password");
                    $newPasswordConfirm = $form->checkEmpty("confirm-new-password");

                    if ($oldPassword == "") {
                        $oldPassword = $form->checkPassword("old-password", $_SESSION["username"]);
                    }

                    if ($newPassword == "" && $newPasswordConfirm == "") {
                        $newPasswordConfirm = $form->checkPasswordEquality("new-password", "confirm-new-password");
                    }

                    if ($form->valid == true) {
                        $updateSuccess = Authentication::updatePassword($_SESSION["username"], $_POST["confirm-new-password"]);

                        if (!$updateSuccess) {
                            $message = "Could not change password due to an error";
                            $error = true;
                        }
                        include "templates/dashboard/displayDashboard.html.php";
                    } else {
                        include "templates/dashboard/dashboard-tools/updatePassword.html.php";
                    }
                } else {
                    $form->valid = true;
                    $oldPassword = "";
                    $newPassword = "";
                    $newPasswordConfirm = "";
                    include "templates/dashboard/dashboard-tools/updatePassword.html.php";
                }

                break;
            
            /*  
             *  --------------------
             *  VIEW CATEGORIES 
             *  --------------------
             */
            case "view-categories":
                include "templates/dashboard/dashboard-tools/viewCategories.html.php";
                break;
            
            /*  
             *  --------------------
             *  EDIT CATEGORY 
             *  --------------------
             */
            case "edit-category":
                $categoryToEdit = $category->getCategory($_GET["category-id"]);
                $itemsInCategory = $category->getItemsInCategory($_GET["category-id"]);

                if(isset($_POST["edit-category"])) {
                    $newCategoryName = $form->checkEmpty("category-name");

                    if($form->valid == true) {
                        $newName = $category->setCategoryName($_POST["category-name"], $category->getCategoryID());

                        if (!$newName) {
                            $message = "Could not edit category due to an error";
                            $error = true;
                        }

                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    } else {
                        include "templates/dashboard/dashboard-tools/editCategory.html.php";
                    }
                } else {
                    $form->valid = true;
                    $newCategoryName = "";
                    include "templates/dashboard/dashboard-tools/editCategory.html.php";
                }
                break;

            /*  
             *  --------------------
             *  DELETE CATEGORY
             *  --------------------
             */
            case "delete-category":
                if (!isset($_GET["category-id"])) {
                    header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                }

                $isValid = false;
                if (is_numeric($_GET["category-id"])) {
                    $categoryToDelete = $category->getCategory($_GET["category-id"]);
            
                    if ($categoryToDelete != -1) {
                        $isValid = true;
                    }
                }

                if(isset($_POST["delete-category"])) {
                    if ($isValid) {
                        $categoryDeleted = $category->deleteCategory($_GET["category-id"]);
    
                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    }
                }

                if ($isValid) {
                    $categoryHasItems = false;
                    if (count($category->getItemsInCategory($category->getCategoryID())) > 0) {
                        $categoryHasItems = true;
                    }
                    include "templates/dashboard/dashboard-tools/deleteCategory.html.php";
                } else {
                    header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                }
                break;

            /*  
             *  --------------------
             *  ADD CATEGORY 
             *  --------------------
             */    
            case "add-category":
                if(isset($_POST["add-category"])) {
                    $newCategoryName = $form->checkEmpty("category-name");

                    if($form->valid == true) {
                        $newCategory = $category->addCategory($_POST["category-name"]);

                        if (!$newCategory) {
                            $message = "Could not add category due to an error";
                            $error = true;
                        }

                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    } else {
                        include "templates/dashboard/dashboard-tools/addCategory.html.php";
                    }
                } else {
                    $form->valid = true;
                    $newCategoryName = "";
                    include "templates/dashboard/dashboard-tools/addCategory.html.php";
                }
                break;

            /*  
             *  --------------------
             *  VIEW ITEMS 
             *  --------------------
             */
            case "view-items":
                include "templates/dashboard/dashboard-tools/viewItems.html.php";
                break;

            /*  
             *  --------------------
             *  EDIT ITEM 
             *  --------------------
             */
            case "edit-item":
                if (!isset($_GET["item-id"])) {
                    header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                }

                $isValid = false;
                if (is_numeric($_GET["item-id"])) {
                    $itemToEdit = $item->getItem($_GET["item-id"]);
                    
                    if ($itemToEdit != -1) {
                        $isValid = true;
                        $partOfCategory = $category->getCategory($item->getCategoryId());
                    }
                }
                
                $targetDirectory = "./img/product-images/";

                $fileError = false;
                $fileErrorMessage = "";

                if(isset($_POST["edit-item"])) {
                    $newItemName = $form->checkEmpty("item-name");
                    $newItemPrice = $form->checkEmpty("item-price");
                    $newItemDescription = $form->checkEmpty("item-description");
                    
                    if($form->valid == true) {
                        $setNewItemName = $item->setItemName($_POST["item-name"], $item->getItemID());
                        $setNewItemPrice = $item->setPrice($_POST["item-price"], $item->getItemID());
                        $setNewItemSalePrice = $item->setSalePrice($_POST["item-sale-price"], $item->getItemID());
                        $setNewItemDescription = $item->setDescription($_POST["item-description"], $item->getItemID());
                        $setNewItemFeatured = $item->setFeatured($_POST["item-is-featured"], $item->getItemID());

                        if (isset($_POST["category-options"])) {
                            $setNewItemCategory = $item->setCategoryId($_POST["category-options"], $item->getItemID());
                        }

                        // Get Image
                        if ($_POST["server-should-remove-photo"] == "1") {
                            $item->setPhoto("placeholder.svg", $item->getItemID());
                        } else {
                            $photoPath = basename($_FILES["upload-item-photo"]["name"]);
                            $targetFile = $targetDirectory . $photoPath;
    
                            $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
    
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                                $fileErrorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                $fileError = true;
                            }
    
                            if ($_FILES["upload-item-photo"]["error"] == 1) {
                                $fileErrorMessage = "Maximum file size limit exceeded. Max of 2MB is allowed.";
                                $fileError = true;
                            }
    
                            if ($fileError == false) {
                                if (move_uploaded_file($_FILES["upload-item-photo"]["tmp_name"], $targetFile)) {
                                    // Delete old photo
                                    if(!empty($_POST["old-photo"])) {
                                        $file = $targetDirectory . $_POST["old-photo"];
                                        unlink($file);
                                    }
    
                                    $item->setPhoto($photoPath, $item->getItemID());
                                } else {
                                    $fileErrorMessage = "There was an error uploading your image. Please try again later.";
                                    $fileError = true;
                                }
                            }
                        }

                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    } else {
                        if ($isValid) {
                            include "templates/dashboard/dashboard-tools/editItem.html.php";
                        } else {
                            header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                        }
                    }
                } else {
                    $form->valid = true;
                    $newCategoryName = "";
                    $newItemPrice = "";
                    $newItemDescription = "";
                    if ($isValid) {
                        include "templates/dashboard/dashboard-tools/editItem.html.php";
                    } else {
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    }
                }
                break;

            /*  
             *  --------------------
             *  DELETE ITEM 
             *  --------------------
             */
            case "delete-item":
                if (!isset($_GET["item-id"])) {
                    header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                }

                $isValid = false;
                if (is_numeric($_GET["item-id"])) {
                    $itemToDelete = $item->getItem($_GET["item-id"]);
            
                    if ($itemToDelete != -1) {
                        $isValid = true;
                    }
                }

                if(isset($_POST["delete-item"])) {
                    if ($isValid) {
                        $itemDeleted = $item->deleteItem($_GET["item-id"]);
    
                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    }
                }

                if ($isValid) {
                    include "templates/dashboard/dashboard-tools/deleteItem.html.php";
                } else {
                    header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                }
                break;

            /*  
             *  --------------------
             *  ADD ITEM 
             *  --------------------
             */
            case "add-item":    
                $targetDirectory = "./img/product-images/";

                $fileError = false;
                $fileErrorMessage = "";

                if(isset($_POST["add-item"])) {
                    $newItemName = $form->checkEmpty("item-name");
                    $newItemPrice = $form->checkEmpty("item-price");
                    $newItemDescription = $form->checkEmpty("item-description");
                    $newItemCategory = $form->checkEmpty("category-options");

                    if($form->valid == true) {
                        // Get Image
                        $photoPath = basename($_FILES["upload-item-photo"]["name"]);
                        $targetFile = $targetDirectory . $photoPath;

                        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            $fileErrorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $fileError = true;
                        }

                        if ($_FILES["upload-item-photo"]["error"] == 1) {
                            $fileErrorMessage = "Maximum file size limit exceeded. Max of 2MB is allowed.";
                            $fileError = true;
                        }

                        if ($_FILES["upload-item-photo"]["size"] == 0) {
                            $photoPath = "placeholder.svg";
                            $item->addItem($_POST["item-name"], $photoPath, $_POST["item-price"], $_POST["item-sale-price"], $_POST["item-description"], isset($_POST["item-is-featured"]), $_POST["category-options"]);
                        } else if ($fileError == false) {
                            $item->addItem($_POST["item-name"], $photoPath, $_POST["item-price"], $_POST["item-sale-price"], $_POST["item-description"], isset($_POST["item-is-featured"]), $_POST["category-options"]);
                            if (move_uploaded_file($_FILES["upload-item-photo"]["tmp_name"], $targetFile)) {
                                $newItem = $item->getItem((int)$item->getNextItemId() - 1);
                                $item->setPhoto($photoPath, $item->getItemID());
                            } else {
                                $fileErrorMessage = "There was an error uploading your image. Please try again later.";
                                $fileError = true;
                            }
                        }
                        
                        // Hacky way to refresh the page to show changes
                        header('Location:'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    } else {
                        include "templates/dashboard/dashboard-tools/addItem.html.php";
                    }
                } else {
                    $form->valid = true;
                    $newCategoryName = "";
                    $newItemPrice = "";
                    $newItemDescription = "";
                    include "templates/dashboard/dashboard-tools/addItem.html.php";
                }
                break;
            /*  
             *  --------------------
             *  DEFAULT
             *  --------------------
             */
            default:
                include "templates/dashboard/displayDashboard.html.php";
                break;
        }
    } else {
        include "templates/dashboard/displayDashboard.html.php";
    }

    if ($_SESSION["username"] == "admin") {
        if (isset($_POST["create-new-user"])) {
            $createUsername = $form->checkEmpty("create-user-new-username");
            $createPassword = $form->checkEmpty("create-user-new-password");

            if ($form->valid == true) {
                $newUser = Authentication::createUser($_POST["create-user-new-username"], $_POST["create-user-new-password"]);
            }
        }
    }

    $output = ob_get_clean();

    include "templates/layout.html.php";
?>