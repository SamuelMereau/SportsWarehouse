<section class="dashboard__edit-item container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Edit Item</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__item-details-wrapper">
        <div class="dashboard__tool dashboard__edit-item-wrapper">
            <p class="h2 h2--primary rounded--left-only">Edit Item Details</p>
            <form action="<?= $urls["dashboard"]; ?>?tool=edit-item&item-id=<?= $item->getItemId(); ?>" method="POST" enctype="multipart/form-data" class="dashboard__edit-item-form" id="edit-item-form" novalidate>
                <div>
                    <label for="item-id">Item ID</label>
                    <input type="text" name="item-id" id="item-id" value="<?= $item->getItemID(); ?>" disabled>
                </div>
                <div>
                    <label for="item-name">Item Name</label>
                    <input type="text" name="item-name" id="item-name" <?= $form->setErrorClass("item-name"); ?> value="<?= $item->getItemName(); ?>" required>
                    <span class="error-message"><?= $newItemName ?></span>
                </div>
                <div class="dashboard__image-select">
                    <label for="item-photo">Item Photo</label>
                    <div class="dashboard__image-options-wrapper">
                        <div class="dashboard__item-photo-wrapper">
                            <img src="./img/product-images/<?= $item->getPhoto(); ?>" alt="<?= $item->getItemName(); ?>" id="image-preview">
                        </div>
                        <div class="dashboard__image-options">
                            <label for="upload-item-photo" id="upload-item-photo-label" class="dashboard__file-upload rounded disabled">
                                Upload Image
                                <input type="file" name="upload-item-photo" id="upload-item-photo" <?= $form->setErrorClass("upload-item-photo"); ?> accept=".jpg, .jpeg, .png., .gif" disabled title="You need to enable JavaScript to upload an image">
                                <input type="hidden" name="old-photo" value="<?= $item->getPhoto(); ?>">
                            </label>
                            <input type="button" value="Remove Photo" class="filled--error rounded" id="remove-photo" disabled title="You need to enable JavaScript to remove an image">
                            <input type="hidden" id="server-should-remove-photo" name="server-should-remove-photo" value="0">
                        </div>
                    </div>
                    <?php if($fileError): ?>
                        <span class="error"><?= $fileErrorMessage ?></span>
                    <?php endif; ?>
                    <span class="error-message"><?= $uploadItemPhoto ?></span>
                </div>
                <div>
                    <label for="item-price">Price</label>
                    <input type="text" name="item-price" id="item-price" <?= $form->setErrorClass("item-price"); ?> value="<?= $item->getPrice(); ?>" required>
                    <span class="error-message"><?= $newItemPrice ?></span>
                </div>
                <div>
                    <label for="item-sale-price">Sale Price <span class="small">(Set to 0 for no sale)</span></label>
                    <input type="text" name="item-sale-price" id="item-sale-price" <?= $form->setErrorClass("item-sale-price"); ?> value="<?= $item->getSalePrice(); ?>" placeholder="Set to 0 for no sale price">
                </div>
                <div>
                    <label for="item-sale-price">Description</label>
                    <textarea type="text" name="item-description" id="item-description" <?= $form->setErrorClass("item-description"); ?> cols="30" rows="10" placeholder="Description" ><?= $item->getDescription(); ?></textarea>
                    <span class="error-message"><?= $newItemDescription ?></span>
                </div>
                <div class="dashboard__featured-option">
                    <label for="item-is-featured">Featured</label>
                    <input type="checkbox" name="item-is-featured" id="item-is-featured" <?= $form->setErrorClass("item-is-featured"); ?> value="featured" <?= $item->itemIsFeatured() ? "checked" : ""; ?>>
                </div>
                <input type="submit" class="rounded" name="edit-item" value="Edit Item">
            </div>
            <div class="dashboard__tool dashboard__part-of-category">
                <p class="h2 h2--primary rounded--left-only">Part of Category</p>
                <table class="dashboard__category-table table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Category ID</th>
                            <th scope="col">Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $category->getCategoryID(); ?></th>
                            <td><?= $category->getCategoryName(); ?></td>
                        </tr>
                    </tbody>
                </table>
                <label for="category-options">Change Category</label>
                <select name="category-options" id="category-options" <?= $form->setErrorClass("category-options"); ?>>
                    <option value="" <?= $form->setSelected("category-options", "") ?> disabled selected hidden>Do not change</option>
                    <?php foreach($categoryRows as $category): 
                        $categoryId = $category["categoryId"];
                        $categoryName = $category["categoryName"];
                        ?>
                        <option value="<?= $categoryId; ?>" <?= $form->setSelected("category-options", "$categoryName") ?>><?= $categoryName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
</section>
<!-- Import file upload helper -->
<script src="./js/min/upload-image.min.js"></script>