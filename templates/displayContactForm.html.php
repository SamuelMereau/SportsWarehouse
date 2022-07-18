<section id="contact-form-wrapper" class="container">
    <h2 class="h1">Contact Us</h2>
    <p class="info">If you have any questions, we would love to hear from you, please complete the following information.</p>
    <form class="contact-form" id="contact-form" method="post" novalidate>
        <div class="row">
            <div class="col">
                <label for="first-name" class="form-label">First Name *</label>
                <input type="text"
                    <?= $form->setErrorClass("first-name"); ?> 
                    name="first-name" 
                    id="first-name" 
                    placeholder="John" 
                    aria-describedby="first-name-feedback" 
                    value="<?= $form -> setValue('first-name')?>" 
                    required />
                <span class="error-message"><?= $firstNameMessage ?></span>
            </div>
            <div class="col">
                <label for="last-name" class="form-label">Last Name *</label>
                <input type="text" 
                    <?= $form -> setErrorClass('last-name') ?> 
                    name="last-name" 
                    id="last-name" 
                    placeholder="Smith" 
                    aria-describedby="last-name-feedback" 
                    value="<?= $form -> setValue('last-name')?>" 
                    required />
                <span class="error-message"><?= $lastNameMessage ?></span>
            </div>
        </div>
        <div>
            <label for="contact-number" class="form-label">Contact Number</label>
            <input type="tel" 
                name="contact-number" 
                <?= $form -> setErrorClass('contact-number') ?> 
                id="contact-number" 
                placeholder="+61 (02) 1234-5678"
                value="<?= $form -> setValue('contact-number')?>" />
        </div>
        <div>
            <label for="email-addr" class="form-label">Email Address *</label>
            <input type="email" 
                <?= $form -> setErrorClass('email-addr') ?> 
                name="email-addr" 
                id="email-addr" 
                placeholder="john@smith.com" 
                aria-describedby="email-addr-feedback" 
                value="<?= $form -> setValue('email-addr')?>" 
                required />
            <span class="error-message"><?= $emailMessage ?></span>
        </div>
        <div>
            <label for="question" class="form-label">Question *</label>
            <textarea name="question" 
                    <?= $form -> setErrorClass('question') ?> 
                    id="question" 
                    cols="30" 
                    rows="10" 
                    placeholder="Your question here..." 
                    aria-describedby="question-feedback" 
                    required><?= $form -> setValue('question')?></textarea>
            <span class="error-message"><?= $questionMessage ?></span>
        </div>
        <input type="submit" name="submitBtn" id="submitBtn" class="btn btn-primary submit-btn rounded" value="Submit" />
    </form>
</section>
<!-- Import form validation -->
<script src="./js/min/contact-form.min.js"></script>