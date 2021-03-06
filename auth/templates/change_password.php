<div id="subIntro"> 
    <div class="wrap">
        <h1 >Change password - 3dwrapp</h1>
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
                <h2>Enter new password and repeat</h2>
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
                            <form action="/auth/change_password.php" method="POST" id="login-form" name="login-form">
                                <input type="password" class="common" name="new_password" placeholder="new password" value="">
                                <input type="password" class="common" name="confirm_new_password" placeholder="repeat password">
                                <input type="hidden" name="token" value="<?php echo $token ?>" />
                                <input type="submit" class="btn btn-login" value="Send" />
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
            
            <!--End of commonContainer-->
        </div>
    </div> <!-- /container -->
    <div class="clear" style="clear: both;">&nbsp;</div>
</div>