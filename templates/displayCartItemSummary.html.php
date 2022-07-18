<section id="cart-summary" class="cart-summary">
    <h2 class="cart-summary__heading">Purchase</h2>
    <?php if (isset($_SESSION["cart"])) :
        $cart = $_SESSION["cart"];
        $cartItems = $cart->getItems();
    ?>
        <table class="cart-summary__table">
            <?php foreach ($cartItems as $item):
                $productName = $item->getItemName();
                $price = sprintf('%01.2f', $item->getPrice());
                $productId = $item->getItemId();
                $qty = $item->getQuantity();
            ?>
                <tr class="cart-summary__row">
                    <td class="cart-summary__col cart-summary__col--primary"><a href="<?= $urls["item"]."?id=$productId" ?>"><?= $productName ?></a></td>
                    <td class="cart-summary__col cart-summary__col--price"><span class="qty">(x<?= $qty ?>)</span> $<?= sprintf('%01.2f', $price * $qty) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p class="cart-summary__total"><span>Total: </span><span>$<?= sprintf('%01.2f', $cart->calculateTotal())?></span></p>
        <p class="cart-summary__check-out"><a class="btn-primary rounded text-white" <?= $cartItems ? 'href="'.$urls["checkout"].'"' : "" ?>>Check Out</a></p>
    <?php endif; ?>
</section>