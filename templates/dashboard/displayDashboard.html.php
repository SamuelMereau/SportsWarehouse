<section class="dashboard container">
    <h2 class="dashboard__heading"><?= $_SESSION["username"] ?>'s Dashboard</h2>
    <div class="dashboard__wrapper">
        <div class="dashboard__tool dashboard__tool--categories">
            <p class="h2 h2--primary rounded--left-only">Categories <span class="dashboard__view-expanded"><a href="<?= $urls["dashboard"]; ?>?tool=view-categories">view expanded</a></span></p>
            <div class="dashboard__tool-table-wrapper">
                <table class="dashboard__category-table table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Category ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categoryRows as $category): 
                            $categoryId = $category["categoryId"]; 
                            $categoryName = $category["categoryName"];  
                        ?>
                        <tr>
                            <th scope="row"><?= $categoryId; ?></th>
                            <td><?= $categoryName; ?></td>
                            <td>
                                <div class="dashboard__category-actions">
                                    <a class="dashboard__action" href="<?= $urls["dashboard"]; ?>?tool=edit-category&category-id=<?= $categoryId; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dashboard__action dashboard__action--remove" href="<?= $urls["dashboard"]; ?>?tool=delete-category&category-id=<?= $categoryId; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="dashboard__add-category">
                            <td>&nbsp;</td>
                            <td class="dashboard__add-category-cell"><a href="<?= $urls["dashboard"]?>?tool=add-category"><i class="fa-solid fa-plus"></i> Add Category</a></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dashboard__tool dashboard__tool--items">
            <p class="h2 h2--primary rounded--left-only">Items <span class="dashboard__view-expanded"><a href="<?= $urls["dashboard"]; ?>?tool=view-items">view expanded</a></span></p>
            <div class="dashboard__tool-table-wrapper">
                <table class="dashboard__item-table table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Image</th>
                            <th scope="col" class="remove-on-mobile">Price</th>
                            <th scope="col" class="remove-on-mobile">Sale Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($itemRows as $item): 
                            $itemId = $item["itemId"]; 
                            $itemName = $item["itemName"];
                            $photo = "./img/product-images/" . $item["photo"];
                            $price = sprintf("%01.2f", $item["price"]);
                            $salePrice = sprintf("%01.2f", $item["salePrice"]);
                        ?>
                        <tr>
                            <th scope="row"><?= $itemId; ?></th>
                            <td><?= $itemName; ?></td>
                            <td><img src="<?= $photo; ?>" alt="<?= $itemName; ?>" class="dashboard__item-image"></td>
                            <td class="remove-on-mobile">$<?= $price; ?></td>
                            <td class="remove-on-mobile"><?= $salePrice == 0 ? 'N/A' : '$'.$salePrice; ?></td>
                            <td>
                                <div class="dashboard__item-actions">
                                    <a class="dashboard__action" href="<?= $urls["dashboard"]; ?>?tool=edit-item&item-id=<?= $itemId; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dashboard__action dashboard__action--remove" href="<?= $urls["dashboard"]; ?>?tool=delete-item&item-id=<?= $itemId; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="dashboard__add-item">
                            <td>&nbsp;</td>
                            <td class="dashboard__add-item-cell"><a href="<?= $urls["dashboard"]; ?>?tool=add-item"><i class="fa-solid fa-plus"></i> Add Item</a></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dashboard__tool dashboard__tool--account-details">
            <p class="h2 h2--primary rounded--left-only">Account Details</p>
            <div class="dashboard__account-details">
                <div class="dashboard__account-username">
                    <p class="dashboard__account-label">Account Username</p>
                    <p class="dashboard__account-value"><?= $_SESSION["username"]; ?></p>
                </div>
                <div class="dashboard__account-password">
                    <p class="dashboard__account-label">Password</p>
                    <p class="dashboard__account-value"><a href="<?= $urls["dashboard"]; ?>?tool=update-password">Update Password</a></p>
                </div>
            </div>
            <?php if($updateSuccess): ?>
                <p class="success rounded">Password updated successfully</p>
            <?php endif; ?>
        </div>
        <div class="dashboard__tool dashboard__tool--theme">
            <p class="h2 h2--primary rounded--left-only">Theme</p>
            <div class="dashboard__theme">
                <div class="dashboard__theme-wrapper">
                    <form class="dashboard__theme-form" id="theme-form" method="POST">
                        <div class="dashboard__programmed-themes-wrapper">
                            <label for="programmed-theme" class="dashboard__theme-label">Programmed Themes</label>
                            <div class="dashboard__programmed-themes-options">
                                <div class="dashboard__programmed-themes dashboard__programmed-themes--light-theme">
                                    <p>Light Theme</p>
                                    <input type="radio" name="programmed-theme" id="light-theme" <?php if(isset($_COOKIE[$_SESSION["username"]."-dark-theme"])){echo $_COOKIE[$_SESSION["username"]."-dark-theme"] != "true" ? "checked" : "";} else {echo "checked";}?> required>
                                </div>
                                <div class="dashboard__programmed-themes dashboard__programmed-themes--dark-theme">
                                    <p>Dark Theme</p>
                                    <input type="radio" name="programmed-theme" id="dark-theme" <?= isset($_COOKIE[$_SESSION["username"]."-dark-theme"]) && $_COOKIE[$_SESSION["username"]."-dark-theme"] == "true" ? "checked" : ""; ?> required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="dashboard__change-theme rounded" value="Change Theme" disabled title="You need to enable JavaScript to use this" style="opacity: 0.5;">
                    </form>
                    <!-- Import Theme Changer -->
                    <script src="./js/min/theme.min.js"></script>
                </div>
            </div>
        </div>
        <?php if($_SESSION["username"] == "admin"): ?>
            <div class="dashboard__tool dashboard__tool--admin-tools">
                <p class="h2 h2--primary rounded--left-only">Admin Tools</p>
                <div class="dashboard__theme">
                    <div class="dashboard__theme-wrapper">
                        <form class="dashboard__theme-form" id="create-user-form" method="POST">
                            <div class="dashboard__programmed-themes-wrapper">
                                <label for="programmed-theme" class="dashboard__theme-label">Create User</label>
                                <div>
                                    <div>
                                        <p>Username</p>
                                        <input type="text" name="create-user-new-username" id="new-username" required>
                                    </div>
                                    <div>
                                        <p>Password</p>
                                        <input type="text" name="create-user-new-password" id="new-password" required>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="create-new-user" class="dashboard__change-theme rounded" value="Create User">
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- Fix form resubmit on refresh -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>