<section class="dashboard__delete-category container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Delete Category</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__category-details-wrapper">
        <?php if($categoryHasItems): ?>
            <div class="dashboard__tool dashboard__delete-category-wrapper">
                <p class="h2 h2--primary rounded--left-only">Cannot delete category</p>
                <p class="dashboard__delete-warning">You cannot delete a category with items in them. Please delete or change the categories of all items in this category.</p>
                <div class="dashboard__delete-options">
                    <a href="<?= $urls["dashboard"]; ?>" class="filled rounded" name="go-back" id="go-back" autofocus>Return to Dashboard</a>
                </div>
            </div>
        <?php else: ?>
            <div class="dashboard__tool dashboard__delete-category-wrapper">
                <p class="h2 h2--primary rounded--left-only">Are you sure?</p>
                <form action="<?= $urls["dashboard"]; ?>?tool=delete-category&category-id=<?= $category->getCategoryID(); ?>" method="POST" class="dashboard__delete-category-form" id="delete-category-form" novalidate>
                <p class="dashboard__delete-warning">This will permanently remove the category '<?= $category->getCategoryName(); ?>' from the website. Are you sure you want to proceed?</p>
                <div class="dashboard__delete-options">
                    <input type="submit" name="delete-category" class="outline--error rounded" id="delete-category" value="I understand the risks, please delete the category">
                    <a href="<?= $urls["dashboard"]; ?>" class="filled rounded" name="go-back" id="go-back" autofocus>Return to Dashboard</a>
                </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>