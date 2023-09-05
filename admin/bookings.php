<?php require_once('./private/init.php'); ?>

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
    $url_current = "events.php?";

    if(!empty($admin)){

        $bookings = new Bookings();
        $category = new Category();
        $events = new Event();
        $user = new User();

        $sort_by = "id";
        $sort_type = "desc";
        $all_bookings = (array) $bookings->orderBy('id')->orderType('desc')->all();
        /*$all_bookings = $bookings->where(["admin_id" => $admin->id])
                            //->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy($sort_by)->orderType($sort_type)->all();
                            //->limit($start, BACKEND_PAGINATION)->all();*/

        $all_events = $events->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)->all(); 

        $all_category = $category->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)->all();    

        $eventCategory = array();
        if(!empty($all_category)) {
            foreach($all_category as $category_val) {
                $eventCategory[$category_val->id] = $category_val; 
            }
        }                        

        $displayEvent = array();
        if(!empty($all_events)) {
            foreach($all_events as $event_val) {
                $displayEvent[$event_val->id] = $event_val; 
            }
        }      

        $all_user = $user->orderBy($sort_by)->orderType($sort_type)->all();    

        $eventUser = array();
        if(!empty($all_user)) {
            foreach($all_user as $user_val) {
                $eventUser[$user_val->id] = $user_val; 
            }
        }       

        $displayEvent = array();
        if(!empty($all_events)) {
            foreach($all_events as $event_val) {
                $displayEvent[$event_val->id] = $event_val; 
            }
        }              

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
    /*
        $eventId = "";
        $pgEventId = "";
        $pgEventAction = "";
        if((isset($_GET["eventId"])) && (!empty($_GET["eventId"]))) {
            $pgEventId = $_GET['eventId'];
        } elseif((isset($_POST["id"])) && (!empty($_POST["id"]))) {
            $pgEventId = $_POST['id'];
        } 

        if((isset($_GET["eventAction"])) && (!empty($_GET["eventAction"]))) {
            $pgEventAction = $_GET['eventAction'];
        } 
         elseif((isset($_POST["eventAction"])) && (!empty($_POST["eventAction"]))) {
            $pgEventAction = $_POST['eventAction'];
        }*/

    /*    print"<pre>";
        print_r($_GET);
        exit;*/

    /*    $viewEvent = new Event();
        $viewEventArray = array();
        if((Helper::is_get()) && (!empty($pgEventId)) && ($pgEventAction == "view")) {
            $viewEvent->id = $pgEventId;
            $viewEventArray = (array) $viewEvent->where(["id" => $viewEvent->id])->andwhere(["admin_id" => $admin->id])->one();
            
            print"<pre>";
            print_r($viewEventArray);
            exit;
        }*/

        /*if(!empty($eventId)) {
            $pgEventAction = "update";
        } else {
            //$pgAction = "create"; 
        }*/
    }else {
        Helper::redirect_to("login.php");
    }

    $delMsg = '';
    if((isset($_GET['delmsg'])) && (!empty($_GET['delmsg']))) {
        $delMsg = 'Event Deleted Successfully.';
    }
?>
<link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<?php require("common/php/php-head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <?php require("common/php/header.php"); ?>
        <?php require("common/php/sidebar.php"); ?>        
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Bookings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <div style="width:100%;float:left;">
                    <div style="width:30%;float:left;">
                        <h3 class="card-title">Bookings</h3>
                    </div>  
                    <div style="width:9%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEvent('create','','101','4183','35','','37','171','174')">Add Event</a>
                    </div>
                </div>
              </div>
               <div class="modal fade" id="del-event-form-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="del-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="delEventSucResponseDiv" style="color:green;"></div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <div class="modal fade" id="event-form-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <style>
                            .hideModalDiv {
                                dispaly:none;
                            }

                            .spinner {
                                width:25px;
                                height:25px;
                            }

                            .eventFormMainDiv {
                                float:left;
                                width:100%;
                                border:0px solid red;
                            }

                            .eventFormRow {
                                float:left;
                                width:100%;
                                border:0px solid red;
                            }

                            .eventFormCol {    
                                float:left;
                                width:48%;
                                border:0px solid red;
                            }

                            .eventFormSpacerDiv { 
                                 float:left;
                                 width:1%;
                            }
                        </style>
                        <form id="updateEvent" name="updateEvent" enctype="multipart/form-data">
                            <input type="hidden" id="eventId" name="eventId" value="<?php echo (!empty($eventId)?$eventId:''); ?>" />
                            <input type="hidden" id="eventAction" name="eventAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" />
                            <input type="hidden" id="eventCategoryHidden" name="eventCategoryHidden" value="" />
                            <input type="hidden" id="eventCountry" name="eventCountry" value="101" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">    
                               <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Title</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <input type="text" id="eventTitle" name="eventTitle" class="form-control" data-target="#eventTitle" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div class="form-group">
                                            <label>Venue</label>
                                            <div class="input-group" data-target-input="nearest">
                                                <input type="text" id="eventVenue" name="eventVenue" class="form-control" data-target="#eventVenue" />
                                            </div>
                                        </div>                                     
                                    </div>
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" id="eventStartDate" name="eventStartDate" class="form-control datetimepicker-input" data-target="#eventStartDate" />
                                                <div class="input-group-append" data-target="#eventStartDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">                                    
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" id="eventEndDate" name="eventEndDate" class="form-control datetimepicker-input" data-target="#eventEndDate" />
                                                <div class="input-group-append" data-target="#eventEndDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                 <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="typeSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div id="eventTypeDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="categorySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <div id="eventCategoryDiv"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="stateSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>State</label>
                                            <div id="eventStateDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="citySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <div id="eventCityDiv"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="categoryTypeSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Category Type</label>
                                            <div id="eventCategoryTypeDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="evenFileSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div id="eventImagePreview"></div>
                                        <div class="form-group" id="eventFileLabelDiv">
                                            <label>Image</label>
                                        </div>
                                        <div class="form-group" id="eventFileDiv">
                                            <input name="eventFile" id="eventFile" type="file" multiple />
                                            <input type="hidden" name="eventFileHidden" id="eventFileHidden" />
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                        </form>
                    </div>
                    <div class="modal-footer right-content-between">
                      <button type="button" name="eventSubmit" name="eventSubmit" class="btn btn-primary" onclick="submitEvent()">Save</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="eventsList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Category</th>
                        <th>Booked By</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_bookings) > 0) {
                            foreach ($all_bookings as $item){ 
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <?php 
                                    $current_event = $eventDisp = "";
                                    $eventId = $item->event_id;
                                    if(!empty($eventId)) {
                                        if((isset($all_events[$eventId]->title)) && (!empty($all_events[$eventId]->title))) {
                                            $eventDisp = $all_events[$eventId]->title; 
                                            $event_param = $url_current . "id=" . $eventId;
                                            $current_event .= "<div style='border:0px solid red;float:left;width:100%;'><div style='border:0px solid red;float:left;width:50%;'><a href='" . $event_param . "'>" . $eventDisp . "</a></div></div>";
                                        }                                        
                                    } else {
                                        $current_event = "Unknown";
                                    }
                                ?>
                                <td>
                                    <?php echo $current_event; ?>
                                </td>
                                <?php 
                                    $current_category = $eventDispCat = "";
                                    /*$eventCategoryIdArray = explode(",",$item->category_id);
                                    if(!empty($eventCategoryIdArray)) {
                                        foreach($eventCategoryIdArray as $eventCategoryIdVal) {
                                            if((isset($eventCategory[$eventCategoryIdVal]->title)) && (!empty($eventCategory[$eventCategoryIdVal]->title))) {
                                                $eventDispCat = $eventCategory[$eventCategoryIdVal]->title; 
                                                $cat_param = $url_current . "category_id=" . $eventCategoryIdVal;
                                                $current_category .= "<div style='border:0px solid red;float:left;width:100%;'><div style='border:0px solid red;float:left;width:50%;'><a href='" . $cat_param . "'>" . $eventDispCat . "</a></div></div>";
                                            }
                                        }
                                    } else {
                                        $current_category = "Unknown";
                                    }*/
                                ?>
                                <td>
                                    <?php echo $current_category; ?>
                                </td>
                                <?php 
                                    $current_user = $eventDispUsr = "";
                                    $eventUserId = $item->user;
                                    if(!empty($eventUserId)) {
                                        if((isset($eventUser[$eventUserId]->email)) && (!empty($eventUser[$eventUserId]->email))) {
                                            $eventDispUsr = $eventUser[$eventUserId]->email; 
                                            $usr_param = $url_current . "user=" . $eventUserId;
                                            $current_category .= "<div style='border:0px solid red;float:left;width:100%;'><div style='border:0px solid red;float:left;width:50%;'><a href='" . $usr_param . "'>" . $eventDispUsr . "</a></div></div>";
                                        }
                                    } else {
                                        $current_user = "Unknown";
                                    }
                                ?>
                                <td>
                                    <?php echo $eventDispUsr; ?>
                                </td>
                                <td>
                                    <?php 
                                        $status_class = "";
                                        $status = "In-Active";
                                        if($item->status == 1) {
                                            $status_class = "active";
                                            $status = "Active";
                                        }     
                                    ?>
                                    <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td>
                                    &nbsp;
                                    <!-- <a href="#" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEvent('edit','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>','<?php echo $item->type_id; ?>','<?php echo $item->category_type_id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEvent('delete','<?php echo $item->id; ?>','<?php echo $item->admin_id; ?>')"><i class="ion-trash-a"></i></a> -->
                                </td>
                              </tr>
                  <?php 
                        }
                    }    
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Category</th>
                        <th>Booked By</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>    
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../admin/plugins/jszip/jszip.min.js"></script>
        <script src="../admin/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../admin/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../admin/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../admin/dist/js/demo.js"></script>
        <!-- Page specific script -->
        <script>
            jQuery.noConflict();
            (function( $ ) {
              $(function() {
                // More code using $ as alias to jQuery
                $("#eventsList").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "order":  [[0, 'desc']],
                    "columnDefs": [{ "orderable": false, "targets": [6,7] }]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            })(jQuery);

          /*$(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });*/
        </script>
        <?php require("common/php/php-footer.php"); ?>
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- date-range-picker -->
        <script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#eventStartDate').datetimepicker({ icons: { time: 'far fa-clock' } });
                $('#eventEndDate').datetimepicker({ icons: { time: 'far fa-clock' } });
            });
        </script>
        <script>
            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            function delEventImage(eventFileName, respArray) {

                $('#eventImagePreview').html('');

                respArr = removeA(respArray, eventFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("eventAction", "deleteEventImg");
                formdata.append("eventFileName", eventFileName);
    
                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";

                $.ajax({
                    url: "./private/controllers/event.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        var fileCount = respArr.length;
                        //console.log("fileCount",fileCount);
                        for (var index = 0; index < fileCount; index++) {
                            var src = "'"+respArr[index]+"'";
                            var src1 = respArr[index];
                            if((src != undefined) && (src1 != undefined)) {
                                var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';
                                /*$('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+' name="deleteEventImg" name="deleteEventImg" id="deleteEventImg"><i class="fa fa-trash" aria-hidden="true"></i></a></div>');*/
                                 $('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a></div>');
                                respFileNameArray[index] = src1;
                            }
                        }  

                        respFileName = respFileNameArray.toString();

                        console.log("respFileNameArray",respFileNameArray);
                        console.log("respFileName",respFileName);

                        $('#eventFileHidden').val(respFileName);                
                    }
                });
            }

            $('#eventFile').change(function(e) {

                $('#eventImagePreview').html('');

                var fileData = $('#eventFile').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('eventFile').files.length;
                var eventTitle = $('#eventTitle').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('eventFile').files[index]);
                }   

                if (formdata) {
                    formdata.append("eventAction", "upload");
                    formdata.append("eventTitle", eventTitle);
                }

                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/event.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['eventImage'];
                        respArray1 = "'"+php_script_response['eventImage']+"'";
                        var fileCount = respArray.length;
                        for (var index = 0; index < fileCount; index++) {
                            var src = "'"+respArray[index]+"'";
                            var src1 = respArray[index];
                            var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';

                            /*$('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+' name="deleteEventImg" name="deleteEventImg" id="deleteEventImg"><i class="fa fa-trash" aria-hidden="true"></i></a></div>');*/

                            $('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;</div>');
                            respFileNameArray[index] = src1;
                        }   

                        //console.log("respFileNameArray",respFileNameArray);
                        respFileName = respFileNameArray.toString();

                        $('#eventFileHidden').val(respFileName);
                        
                        /*$('#eventFileLabelDiv').hide();
                        $('#eventFileDiv').hide();*/
                    }
                 });      
            });

            $('#stateSpinnerDiv').show();
            $('#citySpinnerDiv').hide();
            $('#typeSpinnerDiv').hide(); 
            $('#categorySpinnerDiv').hide();
            $('#categoryTypeSpinnerDiv').hide();            
            $('#subCategorySpinnerDiv').hide();
            $('#evenFileSpinnerDiv').hide();

            function deleteEvent(eventAction, eventId, countryId, cityId, stateId, categoryId, subCategoryId) {

                $('#del-modal-title-text').text('Delete Event');

                var formData = {};
                if(eventAction == "delete") {
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/event.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {           
                            $("#delEventSucResponseDiv").append(html);
                            setTimeout(function() {
                                window.location.replace("events.php");
                            }, 2000);                    
                        }
                    });
                }
            }

            /*$("#eventCategory").change(function(e){
                var eventCategorySelMultiValues = $(this).val();
                alert("You have selected : "+eventCategorySelMultiValues);
            });*/

            function addEditBooking(bookingAction, bookingId) {

                $("#eventImagePreview").html('');
                $("#eventSucResponseDiv").html('');
                $("#eventErrResponseDiv").html('');                
                $("#eventStateDiv").html('');
                $("#eventCityDiv").html('');
                $("#eventTypeDiv").html('');
                $("#eventCategoryDiv").html('');
                $("#eventCategoryTypeDiv").html('');
                $("#eventSubCategoryDiv").html('');

                eventState(countryId, cityId, stateId);
                eventCategory(categoryId, eventTypeId);
                eventType(eventTypeId);
                eventSubCategory(categoryId, subCategoryId);
                eventCategoryType(categoryId, eventTypeId, categoryTypeId);

                if(bookingAction == "edit") {
                    eventImage(bookingId);
                }

                var formData = {};
                if(bookingAction == "create") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Add Event');
                    $("#eventId").val('');
                    $("#eventAction").val('add');
                    $("#eventTitle").val('');
                    $("#eventStartDate").val('');
                    $("#eventEndDate").val('');
                    $("#eventVenue").val('');
                } else if(bookingAction == "edit") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Update Event');
                    formData = {
                        "eventId": eventId,
                        "bookingAction": bookingAction
                    };
                } else if(bookingAction == "delete") {
                    formData = {
                        "eventId": eventId,
                        "bookingAction": bookingAction
                    };
                }           

                if(eventAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/event.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {           
                            respArr = JSON.parse(html);
                            if(eventAction == "edit") {
                                $("#eventId").val(respArr.id);
                                $("#eventAction").val('update');
                                $("#eventTitle").val(respArr.title);
                                $("#eventStartDate").val(respArr.start_date);
                                $("#eventEndDate").val(respArr.end_date);
                                $("#eventVenue").val(respArr.address);
                                $("#eventCountry").val(respArr.country_id);
                            }                    
                        }
                    });
                }
            }

            function submitEvent() {
                /*$('#updateEvent').validate({
                    rules: {
                        eventTitle: {
                            required: true,
                            minlength: 5,
                            maxlength: 50
                        },
                        eventVenue: {
                            required: true,
                            minlength: 10,
                            maxlength: 200
                        },
                        eventStartDate: {
                            required: true
                        },
                        eventEndDate: {
                            required: true
                        }
                    },
                    messages: {
                        eventTitle: {
                            required: "Enter Title.",
                            minlength: "Title should be minimum of 5 chanracters.",
                            maxlength: "Title should should not be beyond 50 characters."
                        },
                        eventVenue: {
                            required: "Enter Venue.",
                            minlength: "Title should be minimum of 5 chanracters.",
                            maxlength: "Title should should not be beyond 200 characters."
                        },
                        eventStartDate: {
                            required: "Enter Start Date and Time."
                        },
                        eventEndDate: {
                            required: "Enter End Date and Time."
                        }                   
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });*/

                var eventId = $("#eventId").val();
                var eventAction = $("#eventAction").val();
                var eventTitle = $("#eventTitle").val();
                var eventState = $("#eventState").val();
                var eventCity = $("#eventCity").val();
                var eventStartDate = $("#eventStartDate").val();
                var eventEndDate = $("#eventEndDate").val();
                var eventVenue = $("#eventVenue").val();
                var eventCountry = $("#eventCountry").val();
                var eventType = $("#eventType").val();
                var eventCategory = $("#eventCategory").val();
                var eventCategoryType = $("#eventCategoryType").val();
                var eventSubCategory = $("#eventSubCategory").val();
                var eventFileHidden = $("#eventFileHidden").val();
                var eventCategoryHidden = $("#eventCategoryHidden").val();

                var formData = {
                    eventId: eventId,
                    eventAction: eventAction,
                    eventTitle: eventTitle,
                    eventState: eventState,
                    eventCity: eventCity,
                    eventStartDate: eventStartDate,
                    eventEndDate: eventEndDate,
                    eventVenue: eventVenue,
                    eventCountry: eventCountry,
                    eventType: eventType,
                    eventCategory: eventCategory,
                    eventCategoryType: eventCategoryType,
                    eventSubCategory: eventSubCategory,
                    eventFileHidden: eventFileHidden,
                    eventCategoryHidden: eventCategoryHidden
                };

                $.ajax({
                    url: "../admin/private/controllers/event.php",
                    cache: false,
                    type: "POST",
                    datatype:"JSON",
                    data: formData,
                    success: function(html) {
                        $("#eventSucResponseDiv").append(html);
                        setTimeout(function() {
                            window.location.replace("events.php");
                        }, 2000);
                    }
                });
            }    

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $.validator.setDefaults({
                        submitHandler: function () {
                            var eventId = $("#eventId").val();
                            var eventAction = $("#eventAction").val();
                            var eventTitle = $("#eventTitle").val();
                            var eventState = $("#eventState").val();
                            var eventCity = $("#eventCity").val();
                            var eventStartDate = $("#eventStartDate").val();
                            var eventEndDate = $("#eventEndDate").val();
                            var eventVenue = $("#eventVenue").val();
                            var eventCountry = $("#eventCountry").val();
                            var eventCategory = $("#eventCategory").val();
                            var eventSubCategory = $("#eventSubCategory").val();
                            var eventFileHidden = $("#eventFileHidden").val();

                            var formData = {
                                eventId: eventId,
                                eventAction: eventAction,
                                eventTitle: eventTitle,
                                eventState: eventState,
                                eventCity: eventCity,
                                eventStartDate: eventStartDate,
                                eventEndDate: eventEndDate,
                                eventVenue: eventVenue,
                                eventCountry: eventCountry,
                                eventCategory: eventCategory,
                                eventSubCategory: eventSubCategory,
                                eventFileHidden: eventFileHidden
                            };

                            $.ajax({
                                url: "../admin/private/controllers/event.php",
                                cache: false,
                                type: "POST",
                                datatype:"JSON",
                                data: formData,
                                success: function(html) {
                                    $("#eventSucResponseDiv").append(html);
                                    setTimeout(function() {
                                        window.location.replace("events.php");
                                    }, 2000);
                                }
                            });
                        }
                    });

                    $('#updateEvent').validate({
                        rules: {
                            eventTitle: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            eventVenue: {
                                required: true,
                                minlength: 5,
                                maxlength: 200
                            },
                            eventStartDate: {
                                required: true
                            },
                            eventEndDate: {
                                required: true
                            }
                        },
                        messages: {
                            eventTitle: {
                                required: "Event Title should not be empty.",
                                minlength: "Event Title should be minimum of 5 characters.",
                                maxlength: "Event Title should should not be beyond 50 characters."
                            },
                            eventVenue: {
                                required: "Event Venue should not be empty.",
                                minlength: "Event Venue should be minimum of 5 characters.",
                                maxlength: "Event Venue should should not be beyond 200 characters."
                            },
                            eventStartDate: {
                                required: "Enter Start Date and Time."
                            },
                            eventEndDate: {
                                required: "Enter End Date and Time."
                            }                   
                        },
                        errorElement: 'span',
                        errorPlacement: function (error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.form-group').append(error);
                        },
                        highlight: function (element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function (element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        }
                    });
                });
            })(jQuery);
        </script>    