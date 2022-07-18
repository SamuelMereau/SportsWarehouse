<section class="dashboard__view-categories container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">View All Categories</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
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
</section>