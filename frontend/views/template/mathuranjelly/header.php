<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="themepresss">
    <link rel="shortcut icon" type="image/png" href="<?=MATHURANJELLY_UPLOAD_PATH?><?=$s_config->favicon_image_name?>">
    <title><?php echo $s_config->title."-".$s_config->tag_line; ?></title>
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/themify-icons.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/flaticon.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/owl.theme.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/slick.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/slick-theme.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/owl.transitions.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="inner">
                <span class="icon"><i><img src="<?=MATHURANJELLY_UPLOAD_PATH?><?=$s_config->loading_image_name?>" alt=""></i></span>
            </div>
        </div>
        <!-- end preloader -->
        <!-- Start header -->
        <header id="header" class="site-header header-style-1">
            <nav class="navigation navbar navbar-expand-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggler open-btn">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar first-angle"></span>
                                    <span class="icon-bar middle-angle"></span>
                                    <span class="icon-bar last-angle"></span>
                                </button>
                                <?php
                                    if(!file_exists(MATHURANJELLY_UPLOAD_PATH.$s_config->image_name)){
                                ?>
                                        <a class="navbar-brand" href="index.php?pg-name=home">
                                            <?=$s_config->title?>
                                        </a>    
                                <?php
                                    }
                                    else{
                                ?>
                                         <a class="navbar-brand" href="index.php?pg-name=home">
                                            <img src="<?=MATHURANJELLY_UPLOAD_PATH?><?=$s_config->image_name?>" alt="Logo"><?=$s_config->title?>
                                        </a>
                                <?php        
                                    }
                                ?>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                <a class="menu-close" href="#"><i class="fi flaticon-cancel"></i></a>
                                <?php
                                    /*print"<pre>";
                                    print_r($cms_menu);
                                    exit;*/
                                ?>
                                <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="menu-item-has-children">
                                        <a <?=$menu_active_home?> href="index.php?pg-name=home">Home</a>
                                    </li>
                                    <?php
                                        if(!empty($parent_cms_menu)) {
                                            foreach($parent_cms_menu as $parent_cms_menu_val) {
                                    ?>
                                                <li>
                                                    <a <?=$menu_active_contact?> href="index.php?pg-name=content"><?=$parent_cms_menu_val->title?>
                                                    </a>
                                                    <?php
                                                        if(!empty($child_cms_disp_menu[$parent_cms_menu_val->id])) {
                                                    ?>
                                                                <ul class="sub-menu">
                                                                    <?php
                                                                        foreach($child_cms_disp_menu[$parent_cms_menu_val->id] as $child_cms_disp_val) {
                                                                    ?>
                                                                                <li>
                                                                                    <a href="index.php?pg-name=content"><?=$child_cms_disp_val->title?></a>
                                                                                </li>
                                                                    <?php
                                                                        }    
                                                                    ?>             
                                                                </ul>
                                                         <?php
                                                            }    
                                                        ?>
                                                </li>
                                    <?php            

                                            }
                                        }
                                    ?>
                                    <li class="menu-item-has-children">
                                        <a <?=$menu_active_products?> href="index.php?pg-name=products">Products</a>
                                    </li>
                                    <li>
                                        <a <?=$menu_active_contact?> href="index.php?pg-name=contact">Contact</a>
                                    </li>
                                    <!--<li class="menu-item-has-children">
                                        <a class="active" href="#">Home</a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home Style 1</a></li>
                                            <li><a href="index-2.html">Home Style 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="http://google.com">Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="404.html">404 Error</a></li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Product</a>
                                                <ul class="sub-menu">
                                                    <li><a href="product.html">Product</a></li>
                                                    <li><a href="product-single.html">Product Single</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Project</a>
                                                <ul class="sub-menu">
                                                    <li><a href="project.html">Project</a></li>
                                                    <li><a href="project-single.html">Project Single</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Blog right sidebar</a></li>
                                            <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                                            <li><a href="blog-fullwidth.html">Blog fullwidth</a></li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Blog details</a>
                                                <ul class="sub-menu">
                                                    <li><a href="blog-single.html">Blog details right sidebar</a></li>
                                                    <li><a href="blog-single-left-sidebar.html">Blog details left
                                                            sidebar</a></li>
                                                    <li><a href="blog-single-fullwidth.html">Blog details fullwidth</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>-->                                   
                                </ul>
                            </div><!-- end of nav-collapse -->
                        </div>
                        <div class="col-lg-2">
                            <div class="header-right d-flex">
                                 <!--<div class="header-profile-form-wrapper">
                                    <button class="profile-toggle-btn"><i class="fi flaticon-user"></i></button>
                                    <div class="header-profile-content">
                                       <ul>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="register.html">Register</a></li>
                                            <li><a href="order.html">Order History</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mini-cart">
                                    <button class="cart-toggle-btn"> <i class="fi flaticon-bag"></i> <span
                                            class="cart-count">2</span></button>
                                    <div class="mini-cart-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="product-single.html"><img
                                                            src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/img-1.jpg" alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="product-single.html">Wildflower Honey</a>
                                                    <span class="mini-cart-item-price">$20.15</span>
                                                    <span class="mini-cart-item-quantity">x 1</span>
                                                </div>
                                            </div>
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="product-single.html"><img
                                                            src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/img-2.jpg" alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="product-single.html">Queen Bee Honey</a>
                                                    <span class="mini-cart-item-price">$13.25</span>
                                                    <span class="mini-cart-item-quantity">x 2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            <span class="mini-checkout-price">Total: $215.14</span>
                                            <div class="mini-btn">
                                                <a href="checkout.html" class="view-cart-btn s1">Checkout</a>
                                                <a href="cart.html" class="view-cart-btn">View Cart</a>
                                            </div>
                                        </div>
                                        <div class="visible-icon"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/bee2.png"
                                                alt=""></div>
                                    </div>
                                </div>
                                <div class="header-wishlist-form-wrapper">
                                    <button class="wishlist-toggle-btn"><i class="fi flaticon-heart"></i> <span
                                            class="cart-count">2</span> </button>
                                    <div class="mini-wislist-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="product-single.html"><img
                                                            src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/img-1.jpg" alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="product-single.html">Wildflower Honey</a>
                                                    <span class="mini-cart-item-price">$20.15</span>
                                                    <span class="mini-cart-item-quantity">x 1</span>
                                                </div>
                                            </div>
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="product-single.html"><img
                                                            src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/img-2.jpg" alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="product-single.html">Queen Bee Honey</a>
                                                    <span class="mini-cart-item-price">$13.25</span>
                                                    <span class="mini-cart-item-quantity">x 2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            <span class="mini-checkout-price">Total: $215.14</span>
                                            <div class="mini-btn">
                                                <a href="checkout.html" class="view-cart-btn s1">Checkout</a>
                                                <a href="wishlist.html" class="view-cart-btn">View Wishlist</a>
                                            </div>
                                        </div>
                                        <div class="visible-icon"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/shop/mini-cart/bee2.png"
                                                alt=""></div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->