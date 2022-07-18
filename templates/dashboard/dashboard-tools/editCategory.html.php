<section class="dashboard__edit-category container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Edit Category</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__category-details-wrapper">
        <form action="<?= $urls["dashboard"]; ?>?tool=edit-category&category-id=<?= $category->getCategoryID(); ?>" method="POST" class="dashboard__edit-category-form" id="edit-category-form" novalidate>
            <div class="dashboard__tool dashboard__edit-category-wrapper">
                <p class="h2 h2--primary rounded--left-only">Edit Category Details</p>
                <div>
                    <label for="category-id">Category ID</label>
                    <input type="text" name="category-id" id="category-id" value="<?= $category->getCategoryID(); ?>" disabled>
                    <div>
                        <label for="category-name">Category Name</label>
                        <input type="text" name="category-name" id="category-name" <?= $form->setErrorClass("category-name"); ?> value="<?= $category->getCategoryName(); ?>" required>
                        <span class="error-message"><?= $newCategoryName ?></span>
                    </div>
                    <input type="submit" class="rounded" name="edit-category" value="Edit Category" required>
                </div>
            </div>
            <div class="dashboard__tool dashboard__items-in-category">
                <p class="h2 h2--primary rounded--left-only">Item in Category</p>
                <div>
                    <table class="dashboard__category-table table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Item ID</th>
                                <th scope="col">Item Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($itemsInCategory as $item): 
                            $itemId = $item["itemId"]; 
                            $itemName = $item["itemName"];
                            ?>
                                <tr>
                                    <th scope="row"><?= $itemId; ?></th>
                                    <td><?= $itemName; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</section>