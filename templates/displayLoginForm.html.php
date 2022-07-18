<section class="login container">
    <div class="login__wrapper">
        <h2 class="login__heading">Login to Sports Warehouse</h2>
        <div class="login__form-wrapper">
            <form action="login.php" method="post" id="login-form" class="login__form" novalidate>
                <div class="login__item">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="rounded" name="username" placeholder="Username" required autofocus>
                    <span class="error-message"></span>
                </div>
                <div class="login__item">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="rounded" name="password" placeholder="Password" required>
                    <span class="error-message"></span>
                </div>
                <div class="login__item">
                    <input type="submit" name="loginSubmit" class="rounded" value="Login">
                </div>
            </form>
            <?php if(isset($error)): ?>
                <p class="error-message error-message--login-incorrect"><?= $message ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Import Login Validation -->
<script src="./js/min/login-validation.min.js"></script>