<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

$sort_by_array["created"] = "Date";
$sort_by_array["name"] = "Name";
$sort_by_array["title"] = "Title";
$sort_by_array["description"] = "Description";
$sort_by_array["display_order"] = "Display Order";
$sort_by_array["status"] = "Status";

$sort_type_array["DESC"] = "Desc";
$sort_type_array["ASC"] = "Asc";

$sort_by = $sort_type = $search = "";
$url_current = "cms.php?";

if(!empty($admin)){
    $all_cms = new Cms();
    $pagination = "";
    $pagination_msg = "";

    if(Helper::is_get()){
        $page = Helper::get_val("page");
        $search = Helper::get_val("search");
        $sort_by = Helper::get_val("sort_by");
        $sort_type = Helper::get_val("sort_type");;
        
        if($search){
            $url_for_pagination = $url_current;
            $item_count = $all_cms->where(["created_by" => $admin->id])->like(["title" => $search])->search()->count();

            if($item_count < 1) $pagination_msg = "Nothing Found.";

            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
            if($page){
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }

            $start = ($page - 1) * BACKEND_PAGINATION;
            
			if($sort_by && $sort_type){
				$all_cms = $all_cms->where(["created_by" => $admin->id])
					->like(["name" => $search])->like(["title" => $search])->search()
					->orderBy($sort_by)->orderType($sort_type)
					->limit($start, BACKEND_PAGINATION)->all();
			}else{
				$all_cms = $all_cms->where(["created_by" => $admin->id])
					->like(["name" => $search])->like(["title" => $search])->search()
					->orderBy("created")->orderType("DESC")
					->limit($start, BACKEND_PAGINATION)->all();
			}
			
        }else{
			
            $url_for_pagination = $url_current;
            $item_count = $all_cms->where(["created_by" => $admin->id])->count();
                      
            $item_count = $all_cms->where(["created_by" => $admin->id])->count();
            if($item_count < 1) $pagination_msg = "Nothing Found.";
            
            $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
            if($page) {
                if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
            }else {
                $page = 1;
                $pagination->set_page($page);
            }
			
            $start = ($page - 1) * BACKEND_PAGINATION;

			if($sort_by && $sort_type){
				$all_cms = $all_cms->where(["created_by" => $admin->id])
					->orderBy($sort_by)->orderType($sort_type)
					->limit($start, BACKEND_PAGINATION)->all();
			}else{
				$all_cms = $all_cms->where(["created_by" => $admin->id])
					->orderBy("created")->orderType("DESC")
					->limit($start, BACKEND_PAGINATION)->all();
			}
        }
    }

    $panel_setting = new Setting();
    $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();
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
                        <input type="text" placeholder="Search Here" name="search" value="<?php echo $search; ?>"/>
                        <button type="submit"><b>Search</b></button>
                    </form>
                </div>
                <h6 class="float-r mt-5"><b><a class="c-btn" href="cms-form.php">+ Add Cms</a></b></h6>
            </div>


            <div class="oflow-hidden sort-wrapper">
                <div class="float-l page-count-text">

                    <?php if(empty($pagination_msg)){ ?>
                        <h6 class="">Showing <?php echo ($start + 1) . " - " . ((($page - 1) * BACKEND_PAGINATION) + count($all_cms)) . " of " . $item_count; ?> result</h6>
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


            <div class="item-wrapper oflow-x-auto">
			
				<table class="order-table min-w-1000x">
                    <thead>
                        <tr>
							<th>Parent</th>
                            <th>Name</th>
							<th>Title</th>
							<th>Desc</th>
							<th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(count($all_cms) > 0){
								foreach ($all_cms as $item){ ?>
                                <tr>
									<td><?php echo $item->parent_id; ?></td>
									<td><?php echo $item->name; ?></td>
									<td><?php echo $item->title; ?></td>
									<td><?php echo $item->description; ?></td>
									<td><?php echo $item->display_order; ?></td>
                                    <td><?php $status_class = "";
                                            if($item->status == 1) $status_class = "active"; ?>
                                        <span class="table-status <?php echo $status_class; ?>"></span>
									</td>
                                    <td>
										<div style="border:0px solid red;float:left;width:100%;">
											<div style="border:0px solid red;float:left;width:49%;">
												<a href="<?php echo 'cms-form.php?id='.$item->id; ?>">
													<i class="ion-compose"></i>
												</a>
											</div>	
											<div style="border:0px solid red;float:left;width:49%;">
												<a data-confirm = "Are you sure?" href="<?php echo '../private/controllers/cms.php?id=' . $item->id . '&admin_id=' . $item->created_by; ?>">
													<i class="ion-trash-a"></i>
												</a>
											</div>
										</div>			
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