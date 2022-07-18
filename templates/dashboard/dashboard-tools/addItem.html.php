<section class="dashboard__edit-item container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Add Item</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__item-details-wrapper">
        <div>
            <form action="<?= $urls["dashboard"]; ?>?tool=add-item" method="POST" enctype="multipart/form-data" class="dashboard__edit-item-form" id="add-item-form" novalidate>
                <div class="dashboard__tool">
                    <p class="h2 h2--primary rounded--left-only">Add Item Details</p>
                    <div>
                        <label for="item-id">Item ID</label>
                        <input type="text" name="item-id" id="item-id" value="<?= $item->getNextItemId(); ?>" disabled>
                    </div>
                    <div>
                        <label for="item-name">Item Name</label>
                        <input type="text" name="item-name" id="item-name" <?= $form->setErrorClass("item-name"); ?> placeholder="Item Name" value="<?= $form->setValue("item-name"); ?>" required>
                        <span class="error-message"><?= $newItemName ?></span>
                    </div>
                    <div class="dashboard__image-select">
                        <label for="item-photo">Item Photo</label>
                        <div class="dashboard__image-options-wrapper">
                            <div class="dashboard__item-photo-wrapper">
                                <img src="./img/product-images/placeholder.svg" alt="Image to add to item" id="image-preview">
                            </div>
                            <div class="dashboard__image-options">
                                <label for="upload-item-photo" id="upload-item-photo-label" class="dashboard__file-upload rounded disabled">
                                    Upload Image
                                    <input type="file" name="upload-item-photo" id="upload-item-photo" <?= $form->setErrorClass("upload-item-photo"); ?> accept=".jpg, .jpeg, .png., .gif" disabled title="You need to enable JavaScript to upload an image">
                                    <input type="hidden" name="old-photo" value="placeholder.svg">
                                </label>
                            </div>
                        </div>
                        <?php if($fileError): ?>
                            <span class="error"><?= $fileErrorMessage ?></span>
                        <?php endif; ?>
                        <span class="error-message"><?= $uploadItemPhoto ?></span>
                    </div>
                    <div>
                        <label for="item-price">Price <span class="small">(Do not add a dollar sign)</span></label>
                        <input type="text" name="item-price" id="item-price" <?= $form->setErrorClass("item-price"); ?> placeholder="Price (e.g 10.00)" value="<?= $form->setValue("item-price"); ?>" required>
                        <span class="error-message"><?= $newItemPrice ?></span>
                    </div>
                    <div>
                        <label for="item-sale-price">Sale Price <span class="small">(Set to 0 for no sale)</span></label>
                        <input type="text" name="item-sale-price" id="item-sale-price" <?= $form->setErrorClass("item-sale-price"); ?> value="<?= $form->setValue("item-sale-price") ?? "0"; ?>" placeholder="Set to 0 for no sale price">
                    </div>
                    <div>
                        <label for="item-sale-price">Description</label>
                        <textarea type="text" name="item-description" id="item-description" <?= $form->setErrorClass("item-description"); ?> cols="30" rows="10" placeholder="Description" ><?= $form->setValue("item-description"); ?></textarea>
                        <span class="error-message"><?= $newItemDescription ?></span>
                    </div>
                    <div class="dashboard__featured-option">
                        <label for="item-is-featured">Featured</label>
                        <input type="checkbox" name="item-is-featured" id="item-is-featured" <?= $form->setErrorClass("item-is-featured"); ?> value="featured" <?= $form->setChecked("item-is-featured", "featured"); ?>>
                    </div>
                </div>
                <div class="dashboard__tool dashboard__part-of-category">
                    <p class="h2 h2--primary rounded--left-only">Add to Category</p>
                    <label for="category-options">Category</label>
                    <select name="category-options" id="category-options" <?= $form->setErrorClass("category-options"); ?>>
                        <option value="" <?= $form->setSelected("category-options", "") ?> disabled selected hidden>Select a Category</option>
                        <?php foreach($categoryRows as $category): 
                            $categoryId = $category["categoryId"];
                            $categoryName = $category["categoryName"];
                        ?>
                            <option value="<?= $categoryId; ?>" <?= $form->setSelected("category-options", "$categoryName") ?>><?= $categoryName ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message"><?= $newItemCategory ?></span>
                </div>
                <input type="submit" class="rounded" name="add-item" value="Add Item">
            </form>
        </div>
    </div>
</section>
<!-- Import file upload helper -->
<script src="./js/min/upload-image.min.js"></script>