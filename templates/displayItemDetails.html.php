<section class="item-details container">
    <div class="item-details__item">
        <div class="item-details__item-image">
            <img src="<?= './img/product-images/' . $item->getPhoto(); ?>" alt="<?= $item->getItemName(); ?>">
        </div>
        <div class="item-details__item-content">
            <div class="item-details__item-name">
                <h2 class="item-details__item-header"><?= $item->getItemName() ?></h2>
            </div>
            <div class="item-details__item-type">
                <?php if($item->itemIsFeatured()): ?>
                    <div class="item-details__featured-status">
                       <p><span class="item-details__featured-star"><i class="fa-solid fa-star"></i></span><span class="item-details__featured-text">Featured</span></p>
                    </div>
                <?php endif; ?>
                <div class="item-details__item-category">
                    <p>Category: <?= $category->getCategoryName(); ?></p>
                </div>
            </div>
            <div class="item-details__item-price">
                <?php if($item->getSalePrice() != 0): ?>
                <p class="item-details__price-text">$<?= $item->getSalePrice(); ?><span class="item-details__old-price gallery__price--strikethrough">$<?= $item->getPrice(); ?></span></p>
                <?php else: ?>
                    <p class="item-details__price-text">$<?= $item->getPrice(); ?></p>
                <?php endif; ?>
            </div>
            <div class="item-details__item-description">
                <p class="item-details__description-text"><?= $item->getDescription(); ?></p>
            </div>
            <form action="<?= $urls["item"]."?id=".$item->getItemId(); ?>" class="item-details__add-to-cart" method="POST">
                <button class="item-details__add-to-cart-btn rounded" type="submit" name="buy" value="add">Add to Cart</button>
                <div class="item-details__item-quantity">
                    <label class="item-details__item-quantity-label" for="quantity">Quantity</label>
                    <input class="item-details__item-quantity-input rounded" type="number" name="quantity" min="1" value="1">
                    <input type="hidden" value="<?= $item->getItemID(); ?>" name="productId">
                </div>
            </form>
            <?php if (isset($_POST["buy"]) && !empty($_POST["productId"]) && !empty($_POST["quantity"])): ?>
                <div class="item-details__cart-confirmation rounded">
                    <p class="item-details__cart-confirmation-text"><?= $item->getItemName(); ?> (x<?= $quantity ?>) was added to your cart! <a href="<?= $urls["cart"] ?>">View your cart</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>