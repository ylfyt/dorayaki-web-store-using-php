

    <main>
        <div class="container">
            <h2>Sign Up</h2>
            <div class="auth-container">
                <div class="form">
                    <form action="<?= BASEURL ?>/user/signup" method="post">
                        <input id="username" class="input-field" type="text" placeholder="Username" name="username" onkeyup="validateUsername()">
                        <input id="email" class="input-field" type="email" placeholder="Email" name="email" onkeyup="validateEmail()">
                        <input class="input-field" type="password" placeholder="Password" name="password">
                        <input class="input-field" type="password" placeholder="Confirm Password" name="confirm-password">
                        <input type="submit" name="signup" value="Sign Up">
                    </form>
                    <?php if (isset($data['error'])) : ?>
                    <?php if ($data['error'] == 0) : ?>
                        <p class="error" style="">Something wrong</p>
                    <?php endif; ?>
                    <?php if ($data['error'] == -1) :?>
                        <p class="error" style="">Field cannot empty!!</p>
                    <?php endif; ?>    
                    <?php if ($data['error'] == -2) : ?>
                        <p class="error" style="">Password doesn't match</p>
                    <?php endif; ?>
                    <?php if ($data['error'] == -3) : ?>
                        <p class="error" style="">Username is already exists</p>
                    <?php endif; ?>
                    <?php if ($data['error'] > 0) : ?>
                        <p class="error" style="color:green;">Sign up is successfully</p>
                    <?php endif; ?>
                <?php endif; ?>
                    
                </div>
                <p class="other">Already have an account? <a href="<?= BASEURL ?>/user/signin">Sign In</a></p>
            </div>
        </div>
    </main>
