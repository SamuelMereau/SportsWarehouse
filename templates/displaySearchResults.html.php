<section id="search-items-wrapper" class="container">
    <h2 class="h2 h2--primary rounded--left-only">Results for "<?= $search ?>"</h2>
    <div id="item-gallery" class="gallery">
        <?php foreach ($foundItems as $row):
            $itemId = $row["itemId"];
            $itemName = $row["itemName"];
            $photo = "./img/product-images/" . $row["photo"];
            $price = sprintf("%01.2f", $row["price"]);
            $salePrice = sprintf("%01.2f", $row["salePrice"]);
        ?>
            <article class="gallery__item">
                <div class="gallery__product-img">
                    <a href="<?= $urls["item"] . '?id=' . $itemId ?>" class="gallery__product-img-anchor">
                        <img src="<?= $photo ?>" alt="<?= $itemName ?>">
                    </a>
                </div>
                <div class="gallery__price-wrapper">
                    <?php if($salePrice != 0): ?>
                        <p class="gallery__price gallery__price--sale">$<?= $salePrice ?>
                        <span class="gallery__price--old">Was <span class="gallery__price--strikethrough">$<?= $price?></span></span></p>
                    <?php else: ?>
                        <p class="gallery__price gallery__price--sale">$<?= $price ?>
                    <?php endif; ?>
                </div>
                <h3 class="product-desc gallery__product-desc gallery__product-name">
                    <a href="<?= $urls["item"] . '?id=' . $itemId ?>"><?= preg_replace("/".preg_quote($search)."/i", "<b>$0</b>", $itemName) ?></a>
                </h3>
            </article>
        <?php endforeach; ?>
    </div>
</section>