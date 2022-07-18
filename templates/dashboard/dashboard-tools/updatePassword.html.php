<section class="dashboard__update-password container">
    <div class="dashboard__heading-with-link">
        <h2 class="dashboard__heading">Update Password</h2>
        <a href="<?= $urls["dashboard"]; ?>">Return to Dashboard</a>
    </div>
    <div class="dashboard__update-password-wrapper">
        <form action="<?= $urls["dashboard"] ?>?tool=update-password" method="POST" id="update-password-form" class="dashboard__update-password-form" novalidate>
            <div class="dashboard__input-wrapper">
                <div class="dashboard__old-password-wrapper">
                    <label for="old-password">Old Password</label>
                    <input type="password" name="old-password" id="old-password" placeholder="Old Password" <?= $form->setErrorClass("old-password"); ?> autofocus required>
                    <span class="error-message"><?= $oldPassword ?></span>
                </div>
                <div class="dashboard__arrow-wrapper">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="dashboard__new-password-wrapper">
                    <div class="dashboard__new-password">
                        <label for="new-password">New Password</label>
                        <input type="password" name="new-password" id="new-password" placeholder="New Password" <?= $form->setErrorClass("new-password"); ?> required>
                        <span class="error-message"><?= $newPassword ?></span>
                    </div>
                    <div class="dashboard__new-password-confirm">
                        <label for="confirm-new-password">Confirm New Password</label>
                        <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="New Password" <?= $form->setErrorClass("confirm-new-password"); ?> required>
                        <span class="error-message"><?= $newPasswordConfirm ?></span>
                    </div>
                </div>
            </div>
            <div class="dashboard__confirm-wrapper">
                <input type="submit" class="rounded" value="Confirm" name="confirm" id="confirm">
            </div>
            <?php if(isset($error)): ?>
                <p class="error-message error-message--login-incorrect"><?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>
</section>