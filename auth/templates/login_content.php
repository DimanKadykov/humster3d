<div id="subIntro"> 
    <div class="wrap">
        <h1 >Login / Register - 3dwrapp</h1>
    </div>
</div>

<div id="container" class="user-login">
    <div id="content" class="wrap">
        <style>.commonContent{ padding: 20px; } .commonContent .btn {width: 100%;}</style>
        <div class="row-fluid" style="width: 820px;margin: auto;margin-top: 20px;">
            <div>
                <?php if (!empty($flashes)): ?>
                    <?php foreach ($flashes as $flash): ?>
                        <p><?php echo $flash ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>        
            </div>

            <div class="commonContainer pull-left">
                <h2>Log in</h2>
                <div class="commonContainer border shadow bg-white">
                    <div class="tab-content">
                        <?php if (!empty($loginErrors)): ?>
                            <?php foreach ($loginErrors as $error): ?>
                                <p style="color:red">
                                    <?php echo $error ?>
                                </p>
                            <?php endforeach; ?>
                        <?php endif; ?>        

                        <!--End of tab-pane-->
                        <div class="tab-pane commonContent active" id="regularlogin">
                            <form action="/auth/auth.php" method="POST" id="login-form" name="login-form">
                                <input type="text" class="common" name="email" placeholder="Email" value="">
                                <input type="password" class="common" name="password" placeholder="Password">
                                <input type="hidden" name="login_type" value="mystyle" />
                                <input type="hidden" name="login" value="1" />
                                <a href="/auth/reset_password.php" class="forget">Forgot Password</a>
                                <input type="submit" class="btn btn-login" value="Login" />
                            </form>
                        </div>
                    </div>
                    <!--End of tab-content-->
                </div>
                <!--End of topCommon-->
                <div class="bottomContent">
                </div>
                <!--End of bottomContent-->
            </div>
            <!--End of commonContainer-->
            <div class="commonContainer pull-right">
                <h2>Register</h2>
                <div class="commonContent border shadow bg-white">
                    <div class="tab-content">
                        <div>
                            <?php if (!empty($errorsReg)): ?>
                                <?php foreach ($errorsReg as $error): ?>
                                    <p style="color:red">
                                        <?php echo $error ?>
                                    </p>
                                <?php endforeach; ?>
                            <?php endif; ?>        
                        </div>

                        <div class="tab-pane active " id="regularregister">
                            <form action="/auth/register.php" method="POST" id="register-form-mystyle" name="register-form-mystyle">
                                <input type="text" class="common" name="first_name" required="true" placeholder="First name" value="">
                                <input type="text" class="common" name="last_name" required="true" placeholder="Last name" value="">
                                <input type="text" class="common" name="email" placeholder="Email" required="true" value="">                                        
                                <input type="password" class="common" name="password" placeholder="Password" required="true">
                                <input type="password" class="common" name="password_repeat" required="true" placeholder="Retype Password">
                                <span class="bagree">
                                    <span>
                                        <input type="checkbox" name="terms-agree" required="true" value="agree" checked>
                                    </span>
                                    <label>
                                        I agree to the
                                        <a href="https://www.whateverskateboards.com/terms-and-conditions" target="_blank" rel="nofollow">
                                            Terms of Service
                                        </a> and
                                        <a href="https://www.whateverskateboards.com/privacy-policy.php" target="_blank" rel="nofollow">
                                            Privacy Policy
                                        </a>
                                    </label>
                                </span>
                                <!--End of -->
                                <input type="submit" class="btn btn-login" value="Register" />
                            </form>
                        </div>
                    </div>
                </div>
                <!--End of commonContent-->
            </div>
            <!--End of commonContainer-->
        </div>
    </div> <!-- /container -->
    <div class="clear" style="clear: both;">&nbsp;</div>
</div>