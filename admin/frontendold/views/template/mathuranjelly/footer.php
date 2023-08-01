
        <!-- start of tp-site-footer-section -->
        <footer class="tp-site-footer">
            <div class="tp-upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-7 col-sm-11 col-11">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <a href="index.html"><img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/logo2.png" alt="blog"><?=(!empty($s_config->title)?$s_config->title:'')?></a>
                                </div>
                                <p><?=(!empty($s_config->tag_line)?$s_config->tag_line:'')?></p>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-md-7 col-sm-11 col-11">
                            <div class="widget tp-service-link-widget">
                                <div class="widget-title">
                                    <h3>Contact </h3>
                                </div>
                                <div class="contact-ft">
                                    <ul>
                                        <li><i class="fi flaticon-pin"></i><?=(!empty($s_config->address)?$s_config->address:'')?>
                                        </li>
                                        <li><i class="fi flaticon-call"></i><?=(!empty($s_config->phone_number)?$s_config->phone_number:'')?></li>
                                        <li><i class="fi flaticon-envelope"></i><?=(!empty($s_config->email)?$s_config->email:'')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-md-7 col-sm-11 col-11">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>My Account</h3>
                                </div>
                                <ul>
                                    <li><a href="project.html">Our Projects</a></li>
                                    <li><a href="order.html">Order History</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--<div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="widget newsletter-widget">
                                <div class="widget-title">
                                    <h3>Newsletter</h3>
                                </div>
                                <p>You will be notified when somthing new will be appear.</p>
                                <form>
                                    <div class="input-1">
                                        <input type="email" class="form-control" placeholder="Email Address *" required>
                                    </div>
                                    <div class="submit clearfix">
                                        <button type="submit"><i class="ti-email"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>-->
                    </div>
                </div> <!-- end container -->
            </div>
            <div class="tp-lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <p class="copyright"> Copyright &copy; 2022 <?=(!empty($s_config->title)?$s_config->title:'')?> All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-shape1">
                <i class="fi flaticon-honeycomb"></i>
            </div>
            <div class="footer-shape2">
                <i class="fi flaticon-honey-1"></i>
            </div>
        </footer>
        <!-- end of tp-site-footer-section -->

        <!-- popup-quickview  -->
        <div id="popup-quickview" class="modal fade" tabindex="-1">
            <div class="modal-dialog quickview-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fi flaticon-cancel"></i></button>
                    <div class="modal-body d-flex">
                        <div class="product-details">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <div class="product-single-img">
                                        <div class="modal-product">
                                            <div class="item">
                                                <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/modal2.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-single-content">
                                        <h5>Queen Bee Honey</h5>
                                        <h6>350.00 USD</h6>
                                        <ul class="rating">
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis ultrices
                                            lectus lobortis, dolor et tempus porta, leo mi efficitur ante, in varius
                                            felis
                                            sem ut mauris. Proin volutpat lorem inorci sed vestibulum tempus. Lorem
                                            ipsum
                                            dolor sit amet, consectetur adipiscing elit. Aliquam
                                            hendrerit.
                                        </p>
                                        <div class="product-filter-item color">
                                            <div class="color-name">
                                                <span>Color :</span>
                                                <ul>
                                                    <li class="color1"><input id="1" type="radio" name="color"
                                                            value="30">
                                                        <label for="1"></label>
                                                    </li>
                                                    <li class="color2"><input id="2" type="radio" name="color"
                                                            value="30">
                                                        <label for="2"></label>
                                                    </li>
                                                    <li class="color3"><input id="3" type="radio" name="color"
                                                            value="30">
                                                        <label for="3"></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-filter-item color filter-size">
                                            <div class="color-name">
                                                <span>Weight :</span>
                                                <ul>
                                                    <li class="color"><input id="w1" type="radio" name="size"
                                                            value="30">
                                                        <label for="w1">4L</label>
                                                    </li>
                                                    <li class="color"><input id="w2" type="radio" name="size"
                                                            value="30">
                                                        <label for="w2">2L</label>
                                                    </li>
                                                    <li class="color"><input id="w3" type="radio" name="size"
                                                            value="30">
                                                        <label for="w3">500ML</label>
                                                    </li>
                                                    <li class="color"><input id="w4" type="radio" name="size"
                                                            value="30">
                                                        <label for="w4">200ML</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="pro-single-btn">
                                            <div class="quantity cart-plus-minus">
                                                <input type="text" value="1">
                                                <div class="dec qtybutton"></div>
                                                <div class="inc qtybutton"></div>
                                            </div>
                                            <a href="#" class="theme-btn">Add to cart</a>
                                        </div>
                                        <div class="social-share">
                                            <span>Share with : </span>
                                            <ul class="socialLinks">
                                                <li><a href='#'><i class="fa fa-facebook"></i></a></li>
                                                <li><a href='#'><i class="fa fa-linkedin"></i></a></li>
                                                <li><a href='#'><i class="fa fa-twitter"></i></a></li>
                                                <li><a href='#'><i class="fa fa-instagram"></i></a></li>
                                                <li><a href='#'><i class="fa fa-youtube-play"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="m-shape">
                                            <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/bee2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- popup-quickview -->

        <!-- Popup Subscribe Form -->
        <div id="popup-subscribe2" class="modal fade" tabindex="-1">
            <div class="modal-dialog subscribe-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fi flaticon-cancel"></i></button>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <div class="modal-img d-none d-md-block">
                                <img src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/images/modal.jpg" alt="">
                            </div>
                            <div class="modal-subscribe flex-style">
                                <div class="subscribe-box">
                                    <h2>Subscribe to Our Newsletter</h2>
                                    <p>Received 10% Discount on Your Next Purchase!</p>
                                    <form id="mc-form" class="sform">
                                        <div class="form_msg">
                                            <label class="mt10" for="mc-email"></label>
                                        </div>
                                        <input type="email" name="email" id="mc-email" placeholder="Enter Your Email"
                                            required>
                                        <input type="submit" name="submit" value="subscribe">
                                    </form>
                                    <p class="no-padding fz-12">By submitting your email you will accept our privacy
                                        policy.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popup Subscribe Form -->


    </div>
    <!-- end of page-wrapper -->



    <!-- All JavaScript files
    ================================================== -->

    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/jquery.min.js"></script>
    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- Plugins for this template -->
    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/jquery-ui.min.js"></script>
    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/jquery-plugin-collection.js"></script>

    <!-- Custom script for this template -->
    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/script.js"></script>
    <script src="<?=MATHURANJELLY_TEMPLATE_ROOT_PATH?>assets/js/modernizr.custom.js"></script>

</body>

</html>