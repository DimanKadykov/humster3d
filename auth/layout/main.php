<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="generator" content="MyStyle Platform">
        <title><?php echo $title ?></title>        
        <meta name="keywords" content=""/>
        <meta name="description" content="Design your own 3D cars"/>
        <meta property="og:title" content="Login / Register - 3dwrapp" />

        <!-- css reset -->
        <link rel="stylesheet" href="/css/reset.css" media="screen,projection" />
        <!-- bootstrap / rippln css -->
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="/css/font.css">
        <link rel="stylesheet" href="/css/bootstrap/bootstrap-select.css">
        <link rel="stylesheet" href="/css/checkbox.css">
        <!-- mystyle css -->
        <link rel="stylesheet" href="/css/main.css" media="screen,projection" />
        <link rel="stylesheet" href="/css/custom.css" media="screen,projection" />

        <!-- GOOGLE FONTS -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Lato:400,700,900,400italic' rel='stylesheet' type='text/css'>

<!--        <link rel="icon" href="https://d2cjjbw87j6ehp.cloudfront.net/r4196/favicon.ico">-->

        <!-- begin javascripts -->
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://d2cjjbw87j6ehp.cloudfront.net/r4196/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <!-- bxslider includes -->
        <!-- bxSlider Javascript file & CSS file -->
        <script src="https://d2cjjbw87j6ehp.cloudfront.net/r4196/js/bxslider/jquery.bxslider.min.js"></script>
        <link href="/css/jquery.bxslider.css" rel="stylesheet" />
    </head>
    <body class='user-login'>
        <div class="bg"><!--css bg--></div>
        <a name="top" id="top" class="top" style="display:none;"></a><!-- page top anchor -->
        <!-- fb sdk init -->
        <div id="fb-root"></div>

        <!-- start header -->
        <div id="header">
            <div id="header-inner">
                <h1 id="site-title"><a id="logo" href="https://www.whateverskateboards.com/" title="Design Your Own Skateboard or Longboard with Whatever YOU Want!  Add custom colors, text, upload photos, and more!">Design Your Own 3d car model and put Whatever You Want on it!</a></h1>

                <div id="account-bar"></div><!-- header nav -->
                <div class="menu-main-container">
                    <ul id="menu-main" class="menu">
                        <li id="menu-item-995" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-995">
                            <a title="Shop For Skateboard Designs" href="https://www.whateverskateboards.com/shop/">shop</a>
                        </li>
                        <li id="menu-item-995" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-995"><a title="Browse user designs and get inspired.  Customize any skateboard designs to make them your own!" href="https://www.whateverskateboards.com/skateboards/">browse</a></li>
                        <li id="menu-item-27" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27"><a title="Design Your Own Longboard, Skateboard, Shortboard, Cruiser, Downhill, Street or Trick Deck!" onclick="toggleCreateMenu()">create</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header --> 

        <!-- create menu -->
        <script>
            var createMenuOpen = false;
            function toggleCreateMenu() {
                (createMenuOpen == false) ? openCreateMenu() : closeCreateMenu();
            }
            function openCreateMenu() {
                $('.create-nav').stop().show('slow');
                createMenuOpen = true;
            }
            function closeCreateMenu() {
                $('.create-nav').stop().hide('slow');
                createMenuOpen = false;
            }
        </script>
        <div class="create-nav" id="create-nav">
            <div class="pagebreak-inner">
                <h2>Choose Board Type:</h2>
                <ul id="create-categories-menu"><!-- create/customize categories menu -->
                    <li class=longboards><a href="https://www.whateverskateboards.com/cart/longboards"><span><img src="https://d2cjjbw87j6ehp.cloudfront.net/cart/image/data/whatever-longboards-category-2.png"/></span><span>Longboards</span></a></li>
                    <li class=shortboards><a href="https://www.whateverskateboards.com/cart/shortboards"><span><img src="https://d2cjjbw87j6ehp.cloudfront.net/cart/image/data/whatever-shortboards-category-image.png"/></span><span>Shortboards</span></a></li>
                    <li class=complete-longboards><a href="https://www.whateverskateboards.com/cart/complete-longboards"><span><img src="https://d2cjjbw87j6ehp.cloudfront.net/cart/image/data/complete-category.jpg"/></span><span>Complete Longboards</span></a></li>
                    <li class=complete-shortboards><a href="https://www.whateverskateboards.com/cart/complete-shortboards"><span><img src="https://d2cjjbw87j6ehp.cloudfront.net/cart/image/data/complete-shortboards-lil-guy.jpg"/></span><span>Complete Shortboards</span></a></li>
                </ul>				<a href="#top" onclick="closeCreateMenu()" class="button-collapse-up">^ close</a>
            </div>
        </div>
        <div class="clear"></div><!-- end create menu --> 
    <!-- / #container -->
    
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/auth/templates/' . $template; ?>
    <!-- login ui init -->

    <div id="clear"><p>&nbsp;</p></div>
    <footer id="colophon" role="contentinfo">
        <div id="google-ad-wrapper"></div>
        <div id="footer-nav-wrapper">

        </div>
        <div class="clear"></div>
    </footer>
</body>
</html>