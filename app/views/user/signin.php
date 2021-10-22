
    <main>
        <div class="container content">
            <div class="auth-container">
            <h2>Wumbo Bakery</h2>
                <div class="form content">
                    <form action="<?= BASEURL ?>/user/signin" method="post">
                        <input class="input-field input-text" type="text" placeholder="Username" name="username">
                        <input class="input-field input-text" type="password" placeholder="Password" name="password">
                        <input type="submit" name="signin" value="Sign In">
                    </form>
                    
                    <?php if (isset($data['error'])) : ?>
                    <p class="error" style="">Username or password incorrect</p>
                    <?php endif; ?>
                </div>
                <p class="other">Didn't have any account? <a href="<?= BASEURL ?>/user/signup">Sign Up</a></p>
            </div>
        </div>
    </main>

