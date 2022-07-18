<section class="dashboard__add-category container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Add Category</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__category-details-wrapper">
        <div class="dashboard__tool dashboard__add-category-wrapper">
            <p class="h2 h2--primary rounded--left-only">Add Category Details</p>
            <form action="<?= $urls["dashboard"]; ?>?tool=add-category" method="POST" class="dashboard__add-category-form" id="add-category-form" novalidate>
                <label for="category-id">Category ID</label>
                <input type="text" name="category-id" id="category-id" value="<?= $category->getNextCategoryId(); ?>" disabled>
                <div>
                    <label for="category-name">Category Name</label>
                    <input type="text" name="category-name" id="category-name" <?= $form->setErrorClass("category-name"); ?> placeholder="Category Name" required>
                    <span class="error-message"><?= $newCategoryName ?></span>
                </div>
                <input type="submit" class="rounded" name="add-category" value="Add Category" required>
            </form>
        </div>
    </div>
</section>