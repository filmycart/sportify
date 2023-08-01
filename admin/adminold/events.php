<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

$sort_by_array["created"] = "Date";
$sort_by_array["title"] = "Title";
$sort_by_array["current_price"] = "Selling Price";
$sort_by_array["purchase_price"] = "Purchase Price";
$sort_by_array["sub_category_id"] = "Sub Category";
$sort_by_array["featured"] = "Featured";
$sort_by_array["status"] = "Status";

$sort_type_array["DESC"] = "Desc";
$sort_type_array["ASC"] = "Asc";

$sort_by = $sort_type = $search = "";
$url_current = "products.php?";

if(!empty($admin)){
    $all_products = new Product();
    $pagination = "";
    $pagination_msg = "";

    if(Helper::is_get()){
        $page = Helper::get_val("page");
        $search = Helper::get_val("search");
        $sort_by = Helper::get_val("sort_by");
        $sort_type = Helper::get_val("sort_type");;
        $sub_category_id = Helper::get_val("sub_category_id");
        
        if($search){
            if($sub_category_id){
                $url_for_pagination = $url_current . "sub_category_id=" . $sub_category_id . "&&";
                $item_count = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                    ->like(["title" => $search])->search()->count();
            }else{
                $url_for_pagination = $url_current;
                $item_count = $all_products->where(["admin_id" => $admin->id])->like(["title" => $search])->search()->count();
            }

            if($item_count < 1) $pagination_msg = "Nothing Found.";

            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
            if($page){
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }

            $start = ($page - 1) * BACKEND_PAGINATION;

            if($sub_category_id){
                if($sort_by && $sort_type){
                    $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                        ->like(["title" => $search])->like(["tags" => $search])->search()
                        ->orderBy($sort_by)->orderType($sort_type)
                        ->limit($start, BACKEND_PAGINATION)->all();
                }else{
                    $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                        ->like(["title" => $search])->like(["tags" => $search])->search()
                        ->orderBy("created")->orderType("DESC")
                        ->limit($start, BACKEND_PAGINATION)->all();
                }
            }else{
                if($sort_by && $sort_type){
                    $all_products = $all_products->where(["admin_id" => $admin->id])
                        ->like(["title" => $search])->like(["tags" => $search])->search()
                        ->orderBy($sort_by)->orderType($sort_type)
                        ->limit($start, BACKEND_PAGINATION)->all();
                }else{
                    $all_products = $all_products->where(["admin_id" => $admin->id])
                        ->like(["title" => $search])->like(["tags" => $search])->search()
                        ->orderBy("created")->orderType("DESC")
                        ->limit($start, BACKEND_PAGINATION)->all();
                }
            }

        }else{
            if($sub_category_id){
                $url_for_pagination = $url_current . "sub_category_id=" . $sub_category_id . "&&";
                $item_count = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])->count();
            }else{
                $url_for_pagination = $url_current;
                $item_count = $all_products->where(["admin_id" => $admin->id])->count();
            }
            
            $item_count = $all_products->where(["admin_id" => $admin->id])->count();
            if($item_count < 1) $pagination_msg = "Nothing Found.";
            
            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
            if($page) {
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }


            $start = ($page - 1) * BACKEND_PAGINATION;

            if($sub_category_id){
                if($sort_by && $sort_type){
                    $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                        ->orderBy($sort_by)->orderType($sort_type)
                        ->limit($start, BACKEND_PAGINATION)->all();
                }else{
                    $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                        ->orderBy("created")->orderType("DESC")
                        ->limit($start, BACKEND_PAGINATION)->all();
                }
            }else{
                if($sort_by && $sort_type){
                    $all_products = $all_products->where(["admin_id" => $admin->id])
                        ->orderBy($sort_by)->orderType($sort_type)
                        ->limit($start, BACKEND_PAGINATION)->all();
                }else{
                    $all_products = $all_products->where(["admin_id" => $admin->id])
                        ->orderBy("created")->orderType("DESC")
                        ->limit($start, BACKEND_PAGINATION)->all();
                }
            }
        }
    }

    $panel_setting = new Setting();
    $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();

    $all_sub_categories = new Sub_Category();
    $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])->all();
    $sub_categories_assoc = [];
    foreach ($all_sub_categories as $item){
        $sub_categories_assoc[$item->id] = $item->title;
    }

}else Helper::redirect_to("login.php");

?>


<?php require("common/php/php-head.php"); ?>

    <body>

<?php require("common/php/header.php"); ?>

    <div class="main-container">

        <?php require("common/php/sidebar.php"); ?>

        <div class="main-content">


            <?php if($message) echo $message->format(); ?>


            <div class="oflow-hidden mb-xs-0">
                <div class="float-l search-wrapper">

                    <form method="get">
                        <?php if($sub_category_id) { ?> <input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id; ?>" /> <?php } ?>
                        <input type="text" placeholder="Search Here" name="search" value="<?php echo $search; ?>"/>
                        <button type="submit"><b>Search</b></button>
                    </form>
                </div>
                <h6 class="float-r mt-5"><b><a class="c-btn" href="event-form.php">+ Add Event</a></b></h6>
            </div>


            <div class="oflow-hidden sort-wrapper">
                <div class="float-l page-count-text">

                    <?php if(empty($pagination_msg)){ ?>
                        <h6 class="">Showing <?php echo ($start + 1) . " - " . ((($page - 1) * BACKEND_PAGINATION) + count($all_products)) . " of " . $item_count; ?> result</h6>
                    <?php }else{
                        echo "<h6 class='ml-10'>" . $pagination_msg . "</h6>";
                    } ?>

                </div>
                <div class="float-r">
                    <form method="get">

                        <?php if($search) { ?> <input type="hidden" name="search" value="<?php echo $search; ?>" /> <?php } ?>
                        <?php if($sub_category_id) { ?> <input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id; ?>" /> <?php } ?>

                        <div class="dplay-inl-b">
                            <label>Sort by</label>
                            <select name="sort_by">
                                <?php foreach($sort_by_array as $key => $value){
                                    if(!empty($sort_by) && $key == $sort_by) $selected_sort_by = "selected";
                                    else $selected_sort_by = ""; ?>

                                    <option <?php echo $selected_sort_by; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="dplay-inl-b">
                            <select name="sort_type">
                                <?php foreach($sort_type_array as $key => $value){
                                    if(!empty($sort_by) && $key == $sort_type) $selected_sort_type = "selected";
                                    else $selected_sort_type = ""; ?>
                                    <option <?php echo $selected_sort_type; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="dplay-inl-b">
                            <button class="" type="submit">Submit</button>
                        </div>

                    </form>
                </div><!--float-r-->
            </div><!--oflow-hidden-->


            <div class="item-wrapper oflow-x-auto">
			
				<table class="order-table min-w-1000x">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Purchase<span class="font-8">(<?php echo $panel_setting->currency_name; ?>)</span></th>
                            <th>Selling<span class="font-8">(<?php echo $panel_setting->currency_name; ?>)</span></th>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(count($all_products) > 0){
                            foreach ($all_products as $item){ ?>

                                <tr>

									<td>
										<img class="p-15" src="<?php echo UPLOADED_FOLDER . DIRECTORY_SEPARATOR . UPLOADED_THUMB_FOLDER . DIRECTORY_SEPARATOR . $item->image_name; ?>" alt="image" />
									</td>

                                    <td><?php $status_class = "";
                                            if($item->status == 1) $status_class = "active"; ?>
                                        <span class="table-status <?php echo $status_class; ?>"></span>
									</td>

									<td>
										<a href="event-form.php?id=<?php echo $item->id; ?>"><?php echo $item->title; ?></a>
									</td>
									

                                    <?php if(!empty($sub_categories_assoc[$item->sub_category_id])){

                                        $cat_param = $url_current . "sub_category_id=" . $item->sub_category_id;
                                        $current_sub_category = "<a class='ml-5 link' href='" . $cat_param . "'>" . $sub_categories_assoc[$item->sub_category_id] . "</a>";
                                    }else $current_sub_category = "Unknown"; ?>
									
									
									<td>
										<?php echo $current_sub_category; ?>
									</td>


                                    <td><?php $featured_class = "";
                                            if($item->featured == 1) $featured_class = "active"; ?>
                                        <span class="table-status <?php echo $featured_class; ?>"></span>
                                    </td>
									
                                    

                                    <?php
                                        $purchase_price = $panel_setting->currency_font . $item->purchase_price;
                                        $prev_price = $panel_setting->currency_font . $item->prev_price;
                                        $current_price = $panel_setting->currency_font . $item->current_price;

                                        if($panel_setting->currency_type == CURRENCY_APPEND){

                                            $purchase_price = $item->purchase_price . ' ' . $panel_setting->currency_font;
                                            $prev_price = $item->prev_price  . ' ' . $panel_setting->currency_font;
                                            $current_price = $item->current_price . ' ' . $panel_setting->currency_font;

                                        }
                                    ?>

									<td><?php echo $purchase_price ?></td>
									
									<td><?php if($item->prev_price > 0){ ?>
                                            <span class="prev-price"><?php echo $prev_price; ?></span>
                                        <?php } ?>
										<span class="current-price"><b><?php echo $current_price; ?>
									</td>
									
									<td><?php echo $item->tags; ?></td>
									

                                    <td>
										<a href="<?php echo 'product-form.php?id=' . $item->id; ?>"><i class="ion-compose"></i></a>
                                        <a data-confirm = "Are you sure?" href="<?php echo '../private/controllers/product.php?id=' . $item->id . '&&admin_id=' . $item->admin_id; ?>">
                                            <i class="ion-trash-a"></i></a>
									</td>
                                    
                                </tr>

                            <?php }
                        } ?>
                    </tbody>
                </table>
				
			
            </div><!--item-wrapper-->

            <?php echo $pagination->format(["sort_by"=>$sort_by, "sort_type"=>$sort_type, "search"=>$search]); ?>

        </div><!--main-content-->
    </div><!--main-container-->

<?php require("common/php/php-footer.php"); ?>