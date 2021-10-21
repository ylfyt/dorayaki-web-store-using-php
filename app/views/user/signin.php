
    <main>
        <div class="container">
            <h2>Welcome</h2>
            <div class="auth-container">
                <div class="form">
                    <form action="<?= BASEURL ?>/user/signin" method="post">
                        <input class="input-field" type="text" placeholder="Username" name="username">
                        <input class="input-field" type="password" placeholder="Password" name="password">
                        <input type="submit" name="signin" value="Sign In">
                    </form>
                    
                    <?php if (isset($data['error'])) : ?>
                    <p class="error" style="">Username or password incorrect</p>
                    <?php endif; ?>
                </div>
                <p class="other">Not have an account? <a href="<?= BASEURL ?>/user/signup">Sign Up</a></p>
            </div>
        </div>
    </main>

