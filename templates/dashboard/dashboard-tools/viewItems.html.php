<section class="dashboard__view-items container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">View All Items</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__tool-table-wrapper">
        <table class="dashboard__item-table table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Item ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Image</th>
                    <th scope="col" class="remove-on-mobile">Price</th>
                    <th scope="col" class="remove-on-mobile">Sale Price</th>
                    <th scope="col" class="remove-on-mobile">Featured</th>
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
                    $featured = $item["featured"];
                ?>
                <tr>
                    <th scope="row"><?= $itemId; ?></th>
                    <td><?= $itemName; ?></td>
                    <td><img src="<?= $photo; ?>" alt="<?= $itemName; ?>" class="dashboard__item-image"></td>
                    <td class="remove-on-mobile">$<?= $price; ?></td>
                    <td class="remove-on-mobile"><?= $salePrice == 0 ? 'N/A' : '$'.$salePrice; ?></td>
                    <td class="remove-on-mobile"><?= $featured == 0 ? 'No' : 'Yes'; ?></td>
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
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
