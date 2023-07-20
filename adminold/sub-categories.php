<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());


$sort_by_array["created"] = "Date";
$sort_by_array["title"] = "Title";
$sort_by_array["status"] = "Status";
$sort_by_array["category_id"] = "Category";

$sort_type_array["DESC"] = "Desc";
$sort_type_array["ASC"] = "Asc";

$sort_by = $sort_type = $search = "";
$this_url = "sub-categories.php?";


if(!empty($admin)){
    $all_sub_categories = new Sub_Category();

    $pagination = "";
    $pagination_msg = "";

    if(Helper::is_get()){
        $page = Helper::get_val("page");
        $search = Helper::get_val("search");
        $sort_by = Helper::get_val("sort_by");
        $sort_type = Helper::get_val("sort_type");;


        if($search){
            $item_count = $all_sub_categories->where(["admin_id" => $admin->id])->like(["title" => $search])->search()->count();

            if($item_count < 1) $pagination_msg = "Nothing Found.";

            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $this_url);
            if($page){
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }

            $start = ($page - 1) * BACKEND_PAGINATION;

            if($sort_by && $sort_type){
                $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])
                    ->like(["title" => $search])->search()
                    ->orderBy($sort_by)->orderType($sort_type)->limit($start, BACKEND_PAGINATION)->all();

            }else{
                $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])
                    ->like(["title" => $search])->search()
                    ->orderBy("created")->orderType("DESC")->limit($start, BACKEND_PAGINATION)->all();
            }
        }else{



            $item_count = $all_sub_categories->where(["admin_id" => $admin->id])->count();
            if($item_count < 1) $pagination_msg = "Nothing Found.";




            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $this_url);
            if($page) {
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }

            $start = ($page - 1) * BACKEND_PAGINATION;




            if($sort_by && $sort_type){
                $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])
                    ->orderBy($sort_by)->orderType($sort_type)
                    ->limit($start, BACKEND_PAGINATION)->all();

            }else{
                $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])
                    ->orderBy("created")->orderType("DESC")
                    ->limit($start, BACKEND_PAGINATION)->all();
            }

        }
    }

    $all_categories = new Category();
    $all_categories = $all_categories->where(["admin_id" => $admin->id])->all();

    $category_assoc = [];
    foreach ($all_categories as $item){
        $category_assoc[$item->id] = $item->title;
    }

}else Helper::redirect_to("login.php");



?>


<?php require("common/php/php-head.php"); ?>

    <body>

<?php require("common/php/header.php"); ?>

    <div class="main-container">

        <?php require("common/php/sidebar.php"); ?>

        <div class="main-content">

            <h5 class="mb-30 mb-xs-15">Sub Categories</h5>

            <?php if($message) echo $message->format(); ?>

            <div class="oflow-hidden mb-xs-0">
                <div class="float-l search-wrapper">

                    <form method="get">
                        <input type="text" placeholder="Search Here" name="search" value="<?php echo $search; ?>"/>
                        <button type="submit"><b>Search</b></button>
                    </form>
                </div>
                <h6 class="float-r mb-15"><b><a class="c-btn" href="sub-category-form.php">+ Add Sub Category</a></b></h6>
            </div>

            <div class="oflow-hidden sort-wrapper">
                <div class="float-l page-count-text">

                    <?php if(empty($pagination_msg)){ ?>
                        <h6 class="">Showing <?php echo ($start + 1) . " - " . ((($page - 1) * BACKEND_PAGINATION) + count($all_categories)) . " of " . $item_count; ?> result</h6>
                    <?php }else{
                        echo "<h6 class='ml-10'>" . $pagination_msg . "</h6>";
                    } ?>

                </div>
                <div class="float-r">
                    <form method="get">

                        <?php if($search) { ?> <input type="hidden" name="search" value="<?php echo $search; ?>" /> <?php } ?>

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




            <?php if(!empty($pagination_msg)) echo $pagination_msg; ?>

            <div class="item-wrapper">

                <table class="order-table min-w-1000x">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(count($all_sub_categories) > 0){
                        foreach ($all_sub_categories as $item){ ?>

                            <tr>

                                <td>
                                    <img class="p-15" src="<?php echo UPLOADED_FOLDER . DIRECTORY_SEPARATOR . UPLOADED_THUMB_FOLDER . DIRECTORY_SEPARATOR . $item->image_name; ?>" alt="image" />
                                </td>

                                <td><?php $status_class = "";
                                    if($item->status == 1) $status_class = "active"; ?>
                                    <span class="table-status <?php echo $status_class; ?>"></span>
                                </td>

                                <td>
                                    <a href="sub-category-form.php?id=<?php echo $item->id; ?>"><?php echo $item->title; ?></a>
                                </td>

                                <td>

                                    <?php if(isset($category_assoc[$item->category_id]) && !empty($category_assoc[$item->category_id])){
                                        echo $category_assoc[$item->category_id];
                                    }else {
                                        echo "Undefined";
                                    } ?>

                                </td>

                                <td>
                                    <a href="<?php echo 'sub-category-form.php?id=' . $item->id; ?>"><i class="ion-compose"></i></a>
                                    <a data-confirm = "Are you sure?" href="<?php echo '../private/controllers/sub_category.php?id=' . $item->id . '&&admin_id=' . $item->admin_id; ?>">
                                        <i class="ion-trash-a"></i></a>
                                </td>

                            </tr>

                        <?php }
                    } ?>
                    </tbody>
                </table>

            </div><!--item-wrapper-->

            <?php echo $pagination->format(); ?>

        </div><!--main-content-->
    </div><!--main-container-->

<?php require("common/php/php-footer.php"); ?>