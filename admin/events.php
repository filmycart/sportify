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
    $url_current = "events.php?";

    if(!empty($admin)){

        $events = new Event();

        $sort_by = "id";
        $sort_type = "desc";
        //$all_events = (array) $events->orderBy('id')->orderType('desc')->all();
        $all_events = $events->where(["admin_id" => $admin->id])
                            //->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy($sort_by)->orderType($sort_type)->all();
                            //->limit($start, BACKEND_PAGINATION)->all();

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
              <li class="breadcrumb-item active">Events</li>
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
                        <h3 class="card-title">Events</h3>
                    </div>  
                    <div style="width:9%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEvent('create','','101','4183','35','33','37')">Add Event</a>
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
                            .hideModalDiv{
                                dispaly:none;
                            }
                        </style>
                        <form id="updateEvent" name="updateEvent">
                                <input type="hidden" id="eventId" name="eventId" value="<?php echo (!empty($eventId)?$eventId:''); ?>" >
                                <input type="hidden" id="eventAction" name="eventAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" >
                                <input type="hidden" id="eventCountry" name="eventCountry" value="101" />
                                <div id="eventSucResponseDiv" style="color:green;"></div>
                                <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div style="float:left;width:100%;border:0px solid red;" id="modal-div">    
                                <div style="float:left;width:100%;">
                                    <div style="float:left;width:48%;">
                                        <label>Title</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <input type="text" id="eventTitle" name="eventTitle" class="form-control" data-target="#eventTitle" />
                                        </div>
                                    </div>
                                    <div style="float:left;width:1%;">&nbsp;</div>
                                    <div style="float:left;width:48%;">
                                        <div class="form-group">
                                            <label>Venue</label>
                                            <div class="input-group" data-target-input="nearest">
                                                <input type="text" id="eventVenue" name="eventVenue" class="form-control" data-target="#eventVenue" />
                                            </div>
                                        </div>                                     
                                    </div>
                                </div>
                                <div style="float:left;width:100%;">
                                    <div style="float:left;width:48%;">
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
                                    <div style="float:left;width:1%;">&nbsp;</div>
                                    <div style="float:left;width:48%;">                                     
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
                                <div style="float:left;width:100%;">
                                    <div style="float:left;width:48%;">
                                        <div class="form-group">
                                            <label>State</label>
                                            <div id="eventStateDiv"></div>
                                        </div>
                                    </div>
                                    <div style="float:left;width:1%;">&nbsp;</div>
                                    <div style="float:left;width:48%;">
                                        <div class="form-group">
                                            <label>City</label>
                                            <div id="eventCityDiv"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div style="float:left;width:100%;">
                                    <div style="float:left;width:48%;">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <div id="eventCategoryDiv"></div>
                                        </div>
                                    </div>
                                    <div style="float:left;width:1%;">&nbsp;</div>
                                    <div style="float:left;width:48%;">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <div id="eventSubCategoryDiv"></div>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_events) > 0){
                            foreach ($all_events as $item){ 
                    ?>
                              <tr>
                                <!-- <td>
                                    <img class="p-15" src="<?php echo UPLOADED_FOLDER . DIRECTORY_SEPARATOR . UPLOADED_THUMB_FOLDER . DIRECTORY_SEPARATOR . $item->image_name; ?>" alt="image" />
                                </td> -->
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEvent('edit','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>')"><?php echo $item->title; ?></a>
                                </td>
                                <?php 
                                    if(!empty($sub_categories_assoc[$item->sub_category_id])){
                                        $cat_param = $url_current . "sub_category_id=" . $item->sub_category_id;
                                        $current_sub_category = "<a class='ml-5 link' href='" . $cat_param . "'>" . $sub_categories_assoc[$item->sub_category_id] . "</a>";
                                    }
                                    else {
                                        $current_sub_category = "Unknown";
                                    }
                                ?>
                                <td>
                                    <?php echo $current_sub_category; ?>
                                </td>
                                <td>
                                    <?php 
                                        $address = "";
                                        if((isset($item->address)) && (!empty($item->address))){
                                            $address = $item->address;
                                        }     
                                    ?>
                                    <?php echo $address; ?>
                                </td>
                                <td>
                                    <?php 
                                        $startDate = "";
                                        if((isset($item->start_date)) && (!empty($item->start_date))){
                                            $startDate = date("d/m/Y h:i:s A",strtotime($item->start_date));
                                        }     
                                    ?>
                                    <?php echo $startDate; ?>
                                </td>
                                <td>
                                    <?php 
                                        $endDate = "";
                                        if((isset($item->end_date)) && (!empty($item->end_date))){
                                            $endDate = date("d/m/Y h:i:s A",strtotime($item->end_date));
                                        }     
                                    ?>
                                    <?php echo $endDate; ?>
                                </td>
                                <td>
                                    <?php 
                                        $status_class = "";
                                        $status = "In-Active";
                                        if($item->status == 1){
                                            $status_class = "active";
                                            $status = "Active";
                                        }     
                                    ?>
                                    <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEvent('edit','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEvent('delete','<?php echo $item->id; ?>','<?php echo $item->admin_id; ?>')"><i class="ion-trash-a"></i></a>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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
            function deleteEvent(eventAction, eventId, countryId, cityId, stateId, categoryId, subCategoryId) {

                $('#del-modal-title-text').text('Delete Event');

                var formData = {};
                if(eventAction == "delete") {
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                
                    $.ajax({
                        url: "../private/controllers/event.php",
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

            function addEditEvent(eventAction, eventId, countryId, cityId, stateId, categoryId, subCategoryId) {

                $("#eventSucResponseDiv").html('');
                $("#eventErrResponseDiv").html('');                
                $("#eventStateDiv").html('');
                $("#eventCityDiv").html('');
                $("#eventCategoryDiv").html('');
                $("#eventSubCategoryDiv").html('');

                eventState(countryId, cityId, stateId);
                eventCategory(categoryId);
                eventSubCategory(categoryId, subCategoryId);

                var formData = {};
                if(eventAction == "create") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Add Event');
                    $("#eventId").val('');
                    $("#eventAction").val('add');
                    $("#eventTitle").val('');
                    $("#eventStartDate").val('');
                    $("#eventEndDate").val('');
                    $("#eventVenue").val('');
                } else if(eventAction == "edit") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Update Event');
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                } else if(eventAction == "delete") {
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                }           

                if(eventAction == "edit") {
                    $.ajax({
                        url: "../private/controllers/event.php",
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
                var eventCategory = $("#eventCategory").val();
                var eventSubCategory = $("#eventSubCategory").val();

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
                };

                $.ajax({
                    url: "../private/controllers/event.php",
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
                            };

                            $.ajax({
                                url: "../private/controllers/event.php",
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