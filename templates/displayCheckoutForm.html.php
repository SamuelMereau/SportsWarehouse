<section class="checkout container">
    <h2 class="checkout__heading h2 h2--primary rounded--left-only">Order Checkout</h2>
    <form action="<?= $urls["checkout"]; ?>" id="checkout-form" method="POST" novalidate>
        <fieldset class="checkout__fieldset checkout__fieldset--shipping">
            <legend class="checkout__heading checkout__subheading">Shipping Details</legend>
            <div class="checkout__name">
                <div class="checkout__label-wrapper">
                    <p class="checkout__label">Full Name: *</p>
                </div>
                <div class="checkout__input-wrapper">
                    <div class="checkout__name-inputs">
                        <div class="checkout__name-inputs--first-name">
                            <label for="first-name" hidden>First Name</label>
                            <input type="text" name="first-name" placeholder="First Name" <?= $form->setErrorClass("first-name"); ?> value="<?= $form->setValue("first-name"); ?>" required>
                            <span class="error-message"><?= $firstName ?></span>
                        </div>
                        <div class="checkout__name-inputs--last-name">
                            <label for="last-name" hidden>Last Name</label>
                            <input type="text" name="last-name" placeholder="Last Name" <?= $form->setErrorClass("last-name"); ?> value="<?= $form->setValue("last-name"); ?>" required>
                            <span class="error-message"><?= $lastName ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout__address">
                <div class="checkout__label-wrapper">
                    <p class="checkout__label">Address:</p>
                    <p class="checkout__note">Note: Only addresses in Australia are available.</p>
                </div>
                <div class="checkout__input-wrapper">
                    <div class="checkout__address-inputs">
                        <div class="checkout__address-inputs--street-address">
                            <label for="street-address" hidden>Street Address</label>
                            <input type="text" name="street-address" placeholder="Street Address *" <?= $form->setErrorClass("street-address"); ?> value="<?= $form->setValue("street-address"); ?>" required>
                            <span class="error-message"><?= $streetAddress ?></span>
                        </div>
                        <div class="checkout__address-inputs--street-address-2">
                            <label for="street-address-2" hidden>Street Address Line 2</label>
                            <input type="text" name="street-address-2" placeholder="Street Address Line 2" value="<?= $form->setValue("street-address-2"); ?>">
                        </div>
                        <div class="checkout__address-inputs--city">
                            <label for="city" hidden>City</label>
                            <input type="text" name="city" placeholder="City *" <?= $form->setErrorClass("city"); ?> value="<?= $form->setValue("city"); ?>" required>
                            <span class="error-message"><?= $city ?></span>
                        </div>
                        <div class="checkout__address-inputs--state">
                            <label for="state" hidden>State</label>
                            <select name="state" id="state" <?= $form->setErrorClass("state"); ?> required>
                                <option value="" <?= $form->setSelected("state", "") ?> disabled selected hidden>State *</option>
                                <option value="NSW" <?= $form->setSelected("state", "NSW") ?>>NSW</option>
                                <option value="ACT" <?= $form->setSelected("state", "ACT") ?>>ACT</option>
                                <option value="VIC" <?= $form->setSelected("state", "VIC") ?>>VIC</option>
                                <option value="QLD" <?= $form->setSelected("state", "QLD") ?>>QLD</option>
                                <option value="NT" <?= $form->setSelected("state", "NT") ?>>NT</option>
                                <option value="SA" <?= $form->setSelected("state", "SA") ?>>SA</option>
                                <option value="WA" <?= $form->setSelected("state", "WA") ?>>WA</option>
                                <option value="TAS" <?= $form->setSelected("state", "TAS") ?>>TAS</option>
                            </select>
                            <span class="error-message"><?= $state ?></span>
                        </div>
                        <div class="checkout__address-inputs--postcode">
                            <label for="postcode" hidden>Postal / ZIP Code</label>
                            <input type="text" name="postcode" placeholder="Postal / ZIP Code *" <?= $form->setErrorClass("postcode"); ?> value="<?= $form->setValue("postcode"); ?>" maxlength="4" required>
                            <span class="error-message"><?= $postCode ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout__contact-number">
                <div class="checkout__label-wrapper">
                    <p class="checkout__label">Contact Number: *</p>
                </div>
                <div class="checkout__input-wrapper">
                    <div class="checkout__contact-number-inputs">
                        <label for="contact-number" hidden>Contact Number</label>
                        <input type="text" name="contact-number" placeholder="Contact Number" <?= $form->setErrorClass("contact-number"); ?> value="<?= $form->setValue("contact-number"); ?>" required>
                        <span class="error-message"><?= $contactNumber ?></span>
                    </div>
                </div>
            </div>
            <div class="checkout__email-address">
                <div class="checkout__label-wrapper">
                    <p class="checkout__label">Email Address: *</p>
                </div>
                <div class="checkout__input-wrapper">
                    <div class="checkout__email-address-inputs">
                        <label for="email-address" hidden>Email Address</label>
                        <input type="text" name="email-address" placeholder="Email Address" <?= $form->setErrorClass("email-address"); ?> value="<?= $form->setValue("email-address"); ?>" required>
                        <span class="error-message"><?= $emailAddress ?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="checkout__fieldset checkout__fieldset--payment">
            <legend class="checkout__heading checkout__subheading">Payment Details</legend>
            <div class="checkout__name-on-card">
                <p class="checkout__label">Name on Card: *</p>
                <label for="name-on-card" hidden>Name on Card</label>
                <input type="text" name="name-on-card" placeholder="Name" <?= $form->setErrorClass("name-on-card"); ?> value="<?= $form->setValue("name-on-card"); ?>" required>
                <span class="error-message"><?= $nameOnCard ?></span>
            </div>
            <div class="checkout__card-number">
                <p class="checkout__label">Card Number (no spaces or dashes): *</p>
                <div class="checkout__card-number-input">
                    <div class="checkout__card-icon-wrapper">
                        <img src="./img/card-providers/default.png" alt="Card Provider Icon" class="checkout__card-icon" id="checkout__card-icon">
                    </div>
                    <label for="card-number" hidden>Card Number (no spaces or dashes)</label>
                    <input type="text" name="card-number" placeholder="Card Number" maxlength="16" <?= $form->setErrorClass("card-number"); ?> id="checkout__card-number-input" value="<?= $form->setValue("card-number"); ?>" required>
                </div>
                <span class="error-message"><?= $cardNumber ?></span>
                <div class="checkout__card-icon-strip">
                    <img src="./img/card-providers/mastercard.png" alt="Mastercard Card Provider Icon">
                    <img src="./img/card-providers/visa.png" alt="Visa Card Provider Icon">
                    <img src="./img/card-providers/amex.png" alt="AMEX Card Provider Icon">
                </div>
            </div>
            <div></div>
            <div class="checkout__card-small-numbers">
                <div class="checkout__card-expiration">
                    <p class="checkout__label">Expiration: *</p>
                    <div class="checkout__card-expiration-inputs">
                        <div>
                            <label for="card-expiration-month" hidden>Card Expiration Month</label>
                            <input type="text" name="card-expiration-month" placeholder="MM" maxlength="2" <?= $form->setErrorClass("card-expiration-month"); ?> value="<?= $form->setValue("card-expiration-month"); ?>" required>
                            <span class="error-message"><?= $cardExpirationMonth ?></span>
                        </div>
                        <p class="dividing-line">/</p>
                        <div>
                            <label for="card-expiration-year" hidden>Card Expiration Year</label>
                            <input type="text" name="card-expiration-year" placeholder="YY" maxlength="2" <?= $form->setErrorClass("card-expiration-year"); ?> value="<?= $form->setValue("card-expiration-year"); ?>" required>
                            <span class="error-message"><?= $cardExpirationYear ?></span>
                        </div>
                    </div>
                </div>
                <div class="checkout__card-cvc">
                <p class="checkout__label">CVC / CVV: *</p>
                    <div class="checkout__card-cvc-inputs">
                        <label for="card-cvc" hidden>CVC / CVV</label>
                        <input type="text" name="card-cvc" placeholder="123" maxlength="3" <?= $form->setErrorClass("card-cvc"); ?> value="<?= $form->setValue("card-cvc"); ?>" required>
                        <span class="error-message"><?= $cardCVC ?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <input type="submit" name="submit" value="Confirm Payment of $<?= sprintf('%01.2f', $cart->calculateTotal()); ?>" class="checkout__confirm-payment btn btn-primary rounded">
    </form>
</section>
<!-- Import JS -->
<script src="./js/min/checkout-card-type.min.js"></script>
<script src="./js/min/checkout-validation.min.js"></script>