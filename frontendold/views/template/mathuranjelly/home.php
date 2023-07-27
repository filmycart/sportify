        <?php 
            include("header.php");
        ?>
        <!-- start of hero -->
        <section class="hero hero-style-1">
            <div class="hero-slider">
                <div class="slide">
                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/slider/slide-1.jpg" alt class="slider-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col col-lg-5 slide-caption">
                                <div class="slide-title">
                                    <h2><span>Fresh</span> Organic <span>Honey</span></h2>
                                </div>
                                <div class="btns">
                                    <a href="shop.html" class="btn theme-btn">Shop Now <i
                                            class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-image">
                        <div class="simg-1"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/slider/img-1.png" alt=""></div>
                        <div class="simg-2"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/slider/img-2.png" alt=""></div>
                    </div>
                    <div class="hero-shape-img"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/slider/img-3.png" alt=""></div>
                </div>
            </div>
        </section>
        <!-- end of hero slider -->
        <!-- category-area-start -->
        <section class="category-area section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="category-wrap">
                            <div class="category-title">
                                <h2>Our Honey Category</h2>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, eos fugit officiis
                                    error ipsum, dolor ducimus nam ratione nulla deleniti inventore blanditiis.</p>
                            </div>

                            <?php
                                if(!empty($homepage_cat)) {
                                    foreach($homepage_cat as $homepage_cat_val) {
                            ?>
                                        <div class="category-item">
                                            <div class="category-icon">
                                                <img src="<?=MATHURANJELLY_UPLOAD_PATH?><?=$homepage_cat_val->image_name?>" alt="">
                                            </div>
                                            <div class="category-content">
                                                <h2>
                                                    <a href="index.php?pg-name=products">
                                                        <?=$homepage_cat_val->title?>
                                                    </a>
                                                </h2>
                                                <p><?=$homepage_cat_val->title?></p>
                                            </div>
                                        </div>
                            <?php            
                                    }
                                }
                            ?>
                            <!--<div class="category-item">
                                <div class="category-icon">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/category/icon-1.png" alt="">
                                </div>
                                <div class="category-content">
                                    <h2><a href="product.html">Queen Bee Honey</a></h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing industry has been the industry's
                                        standard eos fugit industry's standard consectetur ipsum.</p>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-icon">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/category/icon-2.png" alt="">
                                </div>
                                <div class="category-content">
                                    <h2><a href="product.html">Sunflower Honey</a></h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing industry has been the industry's
                                        standard eos fugit industry's standard consectetur ipsum.</p>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-icon">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/category/icon-3.png" alt="">
                                </div>
                                <div class="category-content">
                                    <h2><a href="product.html">Manuka Honey</a></h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing industry has been the industry's
                                        standard eos fugit industry's standard consectetur ipsum.</p>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="category-img">
                            <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/category/category.jpg" alt="">
                            <div class="ct-img"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/category/icon-4.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- category-area-end -->

        <!-- product-area-start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-title">
                            <h2>Himalayan <span>Honey</span></h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry has been the industry's standard consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="row align-items-center">
                        <?php 
                            if(!empty($homepage_prod)) {
                                foreach($homepage_prod as $homepage_prod_val) {
                        ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <img src="<?=MATHURANJELLY_UPLOAD_PATH?><?=$homepage_prod_val->image_name?>" alt="">
                                                <ul>
                                                    <!--<li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Cart"
                                                            href="cart.html"><i class="fi flaticon-shopping-cart"></i></a></li>-->
                                                    <li data-bs-toggle="modal" data-bs-target="#popup-quickview"><button
                                                            data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                                class="fi ti-eye"></i></button></li>
                                                    <!--<li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Wishlist"
                                                            href="wishlist.html"><i class="fi flaticon-like"></i></a></li>-->
                                                </ul>
                                                <div class="offer-thumb">
                                                    <span>-28%</span>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="product-single"><?=$homepage_prod_val->title?></a></h3>
                                                <div class="product-btm">
                                                    <div class="product-price">
                                                        <ul>
                                                            <li>$85.00</li>
                                                            <li>$98.00</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>

        </section>

        <!-- product-area-end -->

        <!-- offer-area-end -->
        <!--<section class="offer-area section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="offer-img">
                            <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/honey.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="offer-wrap">
                            <div class="offer-title">
                                <small>Limited Offer For Customer</small>
                                <h2>Fresh Sunflower <span>Orginal Honey Up</span> <br> To 58% Off.</h2>
                            </div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, eos fugit officiis
                                error ipsum, dolor ducimus nam ratione nulla deleniti inventore blanditiis lorem inorci
                                sed vestibulum tempus.</p>
                            <a href="shop.html" class="btn theme-btn" tabindex="0">Shop Now <i
                                    class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </section>-->

        <!-- offer-area-end -->

        <!-- Flash-Sale-area-start -->
        <!--<section class="flash-Sale-area product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-title">
                            <h2>Flash <span>Sale</span> Items</h2>
                            <div class="flash-text">
                                <div class="product_timing">
                                    <div data-countdown="2021-10-12"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="product-img">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/product/1.png" alt="">
                                    <ul>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Cart"
                                                href="cart.html"><i class="fi flaticon-shopping-cart"></i></a></li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview"><button
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button></li>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Wishlist"
                                                href="wishlist.html"><i class="fi flaticon-like"></i></a></li>
                                    </ul>
                                    <div class="offer-thumb">
                                        <span>28% OFF</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-single.html">Manuka Honey</a></h3>
                                    <div class="product-btm">
                                        <div class="product-price">
                                            <ul>
                                                <li>$85.00</li>
                                                <li>$98.00</li>
                                            </ul>
                                        </div>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="product-img">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/product/8.png" alt="">
                                    <ul>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Cart"
                                                href="cart.html"><i class="fi flaticon-shopping-cart"></i></a></li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview"><button
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button></li>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Wishlist"
                                                href="wishlist.html"><i class="fi flaticon-like"></i></a></li>
                                    </ul>
                                    <div class="offer-thumb">
                                        <span>45% OFF</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-single.html">Mustard Flower Honey </a></h3>
                                    <div class="product-btm">
                                        <div class="product-price">
                                            <ul>
                                                <li>$95.00</li>
                                                <li>$108.00</li>
                                            </ul>
                                        </div>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="product-img">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/product/6.png" alt="">
                                    <ul>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Cart"
                                                href="cart.html"><i class="fi flaticon-shopping-cart"></i></a></li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview"><button
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button></li>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Wishlist"
                                                href="wishlist.html"><i class="fi flaticon-like"></i></a></li>
                                    </ul>
                                    <div class="offer-thumb">
                                        <span>30% OFF</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-single.html">Pure Hill Honey</a></h3>
                                    <div class="product-btm">
                                        <div class="product-price">
                                            <ul>
                                                <li>$75.00</li>
                                                <li>$88.00</li>
                                            </ul>
                                        </div>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                                                <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="product-img">
                                    <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/product/5.png" alt="">
                                    <ul>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Cart"
                                                href="cart.html"><i class="fi flaticon-shopping-cart"></i></a></li>
                                        <li data-bs-toggle="modal" data-bs-target="#popup-quickview"><button
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"><i
                                                    class="fi ti-eye"></i></button></li>
                                        <li><a data-bs-toggle="tooltip" data-bs-html="true" title="Add to Wishlist"
                                                href="wishlist.html"><i class="fi flaticon-like"></i></a></li>
                                    </ul>
                                    <div class="offer-thumb">
                                        <span>50% OFF</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="product-single.html">Mango Flower Honey</a></h3>
                                    <div class="product-btm">
                                        <div class="product-price">
                                            <ul>
                                                <li>$155.00</li>
                                                <li>$198.00</li>
                                            </ul>
                                        </div>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- Flash-Sale-area-end -->

        <!-- start tp-projects -->
        <!--<section class="tp-projects section-padding">
            <div class="container">
                <div class="row">
                    <div class="section-title mb-0">
                        <h2>Latest <span>Project</span></h2>
                    </div>
                    <div class="col col-xs-12 sortable-gallery">
                        <div class="gallery-filters projects-menu">
                            <ul>
                                <li><a data-filter="*" href="#" class="current">All Project</a></li>
                                <li><a data-filter=".flower" href="#">Flower</a></li>
                                <li><a data-filter=".hill" href="#">Hill</a></li>
                                <li><a data-filter=".forest" href="#">Forest</a></li>
                                <li><a data-filter=".queen" href="#">Queen</a></li>
                            </ul>
                        </div>
                        <div class="projects-grids gallery-container clearfix">
                            <div class="grid flower">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-1.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid hill">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-6.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid flower queen">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-2.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid hill forest queen">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-7.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid hill">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-8.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid flower forest">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-9.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid queen">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-3.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid hill">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-10.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid forest">
                                <div class="project-inner">
                                    <div class="img-holder">
                                        <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/projects/img-11.jpg" alt>
                                    </div>
                                    <div class="hover-content">
                                        <div class="details">
                                            <h3><a href="project.html">fresh original honey</a></h3>
                                            <p class="cat">healthy food</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="view-btn">
                    <a class="theme-btn" href="project.html">View All <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </section>-->
        <!-- end tp-projects -->

        <!-- service-area-end -->
        <div class="service-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="service-item">
                            <div class="service-icon">
                                <span><img draggable="false" src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/support/1.png" alt=""></span>
                            </div>
                            <div class="service-icon-text">
                                <h2>Free Shipping</h2>
                                <span>Order Over $560</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="service-item">
                            <div class="service-icon">
                                <span><img draggable="false" src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/support/2.png" alt=""></span>
                            </div>
                            <div class="service-icon-text">
                                <h2>Easy Payment</h2>
                                <span>100% Secure Payment</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="service-item">
                            <div class="service-icon">
                                <span><img draggable="false" src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/support/3.png" alt=""></span>
                            </div>
                            <div class="service-icon-text">
                                <h2>20/07 Support</h2>
                                <span>Any time Support </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service-area-end -->
        <?php 
            include("footer.php");
        ?>