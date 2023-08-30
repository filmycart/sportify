<?php require_once('./private/init.php'); ?>
<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());
$deletable_image_ids = "";
$inventory_status = "active";
$single_inventory = 0;
$eventId = "";
$pgAction = "";
if(!empty($admin)) {
    $event = new Event();
    $all_sub_categories = new Sub_Category();
    $all_sub_categories = $all_sub_categories->where(["status"=>1])->all();

    $event->admin_id = $admin->id;
    $event->status = 1;

    $panel_setting = new Setting();
    $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();

    /*if(Helper::is_get() && isset($_GET["id"])) {
        if((isset($_GET["id"])) && (!empty($_GET["id"]))) {
            $eventId = $_GET['id'];
        } elseif((isset($_POST["id"])) && (!empty($_POST["id"]))) {
            $eventId = $_POST['id'];
        }

        $event->id = $eventId;
        $event = $event->where(["id" => $event->id])->andwhere(["admin_id" => $admin->id])->one();

        if(count(array($event)) > 0) {
            $image_from_db = new Item_Image();
            $images_from_db = $image_from_db->where(["item_id"=>$event->id])->all();
        }
    }*/
}else {
    Helper::redirect_to("login.php");
}
    if(!empty($eventId)) {
        $pgAction = "update";
    } else {
        //$pgAction = "create"; 
    }
?>
<?php require("common/php/php-head.php"); ?>
<body>
<?php require("common/php/header.php"); ?>
<div class="main-container">
    <?php require("common/php/sidebar.php"); ?>
    <div class="main-content">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <!-- <h1>Add Event</h1> -->
                    &nbsp;
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Add Event</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <!-- <div class="card card-primary"> -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add Event</h3>
                        </div>
                        <!-- form start -->
                          <form id="addEvent" name="addEvent">
                            <input type="hidden" id="eventId" name="eventId" value="<?php echo (!empty($eventId)?$eventId:''); ?>" >
                            <input type="hidden" id="eventAction" name="eventAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" >
                            <input type="hidden" id="eventCountry" name="eventCountry" value="101" />
                            <div class="card-body">
                                <div id="eventSucResponseDiv" style="color:green;"></div>
                                <div id="eventErrResponseDiv" style="color:green;"></div>
                                <div style="float:left;width:100%;">
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="form-group">
                                          <label>Title</label>
                                            <div class="input-group" data-target-input="nearest">
                                                <input type="text" id="eventTitle" name="eventTitle" class="form-control" data-target="#eventTitle" value="<?php echo (!empty($event->title)?$event->title:''); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="form-group">
                                            <label>State</label>
                                            <div id="eventStateDiv"></div>
                                        </div>
                                    </div>
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="form-group">
                                            <label>City</label>
                                            <div id="eventCityDiv"></div>
                                        </div>
                                    </div>
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="form-group">
                                          <label>Start Date</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" id="eventStartDate" name="eventStartDate" class="form-control datetimepicker-input" data-target="#eventStartDate" value="<?php echo (!empty($event->start_date)?$event->start_date:''); ?>"/>
                                                <div class="input-group-append" data-target="#eventStartDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;"> 
                                        <div class="form-group">
                                          <label>End Date</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" id="eventEndDate" name="eventEndDate" class="form-control datetimepicker-input" data-target="#eventEndDate" value="<?php echo (!empty($event->end_date)?$event->end_date:''); ?>"/>
                                                <div class="input-group-append" data-target="#eventEndDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                               </div>  
                               <div style="float:left;width:100%;">
                                  <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="form-group">
                                          <label>Venue</label>
                                            <div class="input-group" data-target-input="nearest">
                                                <input type="text" id="eventVenue" name="eventVenue" class="form-control" data-target="#eventVenue" value="<?php echo (!empty($event->address)?$event->address:''); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <div id="eventCategoryLoadingDiv"></div>
                                        <div id="eventCategoryDiv"></div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                    <div class="form-group">
                                        <label>Sub-Category</label>
                                        <div id="eventSubCategoryLoadingDiv"></div>
                                        <div id="eventSubCategoryDiv"></div>
                                    </div>
                                </div>
                                <!-- <div style="float:left;width:100%;">
                                    <div class="box1 col-md-4" style="float:left;padding:20px 30px 0 30px;">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="r3" id="radioSuccess1">
                                            <label for="radioSuccess1">
                                            </label>
                                        </div>
                                    </div>                                   
                                </div> -->
                                <div class="card-footer">
                                    <div style="float:left;width:100%;">
                                        <div class="box1 col-md-5" style="float:left;padding:10px 20px 30px 10px;">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </div>      
                             <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                              </div> 
                              <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                  <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                </div>
                              </div>
                            </div> -->
                            <!-- /.card-body -->  
                          </form>
                    </div>
                
               <!--  </div> -->
                <!-- /.card -->
                </div>
              <!--/.col (left) -->
              <!-- right column -->
<!--               <div class="col-md-6">

              </div> -->
              <!--/.col (right) -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        </div><!--main-content-->

    </div>
    

</div><!--main-container-->


 <?php echo "<script>maxUploadedFile = '" . MAX_IMAGE_SIZE  . "'</script>"; ?>
 <?php echo "<script>maxUploadedFileCount = '" . MAX_FILE_COUNT  . "'</script>"; ?>
 <?php echo "<script>adminId = '" . $admin->id  . "'</script>"; ?>

 <?php require("common/php/php-footer.php"); ?>

<script> attrQty = [];</script>
<script> attrFromDB = [];</script>
<script> attrIdsFromDB = [];</script>

<?php if(!empty($inventories)){
    foreach($inventories as $inv_item){
        $a_id = str_replace(",", "_", $inv_item->attributes);
        echo "<script>attrIdsFromDB.push('" . $inv_item->id . "'); </script>";
        echo "<script>attrFromDB.push('" . $a_id . "'); </script>";
        echo "<script>attrQty['" . $a_id . "'] = '" . $inv_item->quantity  . "'</script>";
    }
}?>

<!-- jQuery -->
<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/dist/js/demo.js"></script>
<!-- Page specific script -->
<!-- date-range-picker -->
<script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#eventStartDate').datetimepicker({ icons: { time: 'far fa-clock' } });
        $('#eventEndDate').datetimepicker({ icons: { time: 'far fa-clock' } });
    });
</script>
<script>
    function objectifyForm(formArray) {
        //serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
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

            $('#addEvent').validate({
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
            });
        });
    })(jQuery);
    /*(function( $ ) {
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    alert( "Form successful submitted!" );
                }
            });

            $('#addEvent').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
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
    })(jQuery);*/
</script>    
<script>
     var uploadedFolder = '<?php echo UPLOADED_FOLDER; ?>';
     uploadedFolder = uploadedFolder + '/';

     var uploadAjaxCall,
         refreshDisable = false,
         submitDisable = false;

     var uploadStatus = $('#upload-status'),
         uploadProgress = $('#upload-progress'),
         multipleImages = $('#multiple-images');

     function checkFileType(fileType, acceptedFiles){

         var validFile = false;
         $(acceptedFiles).each(function(key, value){
             if(fileType == value) {
                 validFile = true;
                 return;
             }
         });
         return validFile;
     }

     function checkUpload(input, file){
         var $this = $(input),
             file_data = file,
             noError = true,
             acceptedFiles = ['image/png', 'image/jpeg', 'image/jpg'];

         if(file_data != null){
             if(checkFileType(file_data.type, acceptedFiles)){
                 if(file_data.size / (1024 * 1024) > maxUploadedFile){
                     noError  = false;
                     alert("Too Large file (Max file size : " + maxUploadedFile + "MB)");
                 }
             }else {
                 alert(file_data.name + " is Invalid File Type(Accepted File : png, jpg, jpeg)");
                 noError = false;
             }
         }else noError = false;
         return noError;
     }


     function showUploadedImage(file){
         var _URL = window.URL || window.webkitURL,
             img = new Image(),
             imgElement = $('<img />'),
             imageWrapper = $("<div></div>",{ class: "img-wrapper" });

         img.src = _URL.createObjectURL(file);
         img.onload = function() {

             $(imgElement).attr('src', img.src).appendTo(imageWrapper);
             imageWrapper.appendTo('#multiple-images');
         };
         return imageWrapper;
     }


     function upload(input, form_data){
         var $this = $(input),
             fileCount = $this.get(0).files.length,
             url = $this.data('url'),
             removeUrl = $this.data('remove-url');

         $(uploadProgress).css('width', 0);

         if(maxUploadedFileCount < fileCount) alert('You can upload maximum ' + maxUploadedFileCount + ' files per upload.');
         else{
             for (var i = 0; i < fileCount; ++i) {

                 var _URL = window.URL || window.webkitURL,
                     file = $this[0].files[i],
                     form_data = new FormData();

                 form_data.append('image_name', file);

                 if(file){
                     if(checkUpload(input, file)){
                         var fileType = file["type"],
                             fileName = file["name"],
                             fileSize = file["size"] / (1024 *1024);

                         uploadAjaxCall = $.ajax({
                             url: url,
                             dataType: 'json',
                             cache: false,
                             contentType: false,
                             processData: false,
                             data: form_data,
                             type: 'POST',

                             success: function (res) {
                                 var uploadedObj = JSON.parse(JSON.stringify(res));

                                 console.log(uploadedObj);
                                 if(uploadedObj.status_code == 200){

                                     var imgElement = $('<img />'),
                                         imageWrapper = $("<div></div>",{ class: "img-wrapper" }),
                                         removeImage = $("<a></a>",{ class: "remove-image", href: removeUrl, 'data-file-name': uploadedObj.data.file_name}),
                                         removeIcon = $('<i></i>', {class: 'ion-close-round'});

                                     $(imgElement).attr('src', uploadedFolder + uploadedObj.data.file_name).appendTo(imageWrapper);

                                     $(removeIcon).appendTo(removeImage);
                                     $(removeImage).appendTo(imageWrapper);
                                     $(imageWrapper).appendTo(multipleImages);

                                     var imageNames = $('[name="uploaded-image-names"]').val();
                                     imageNames += uploadedObj.data.file_name + ',';
                                     $('[name="uploaded-image-names"]').val(imageNames)

                                     $(uploadStatus).text('Done');
                                 }else $(uploadStatus).text(uploadedVideoObj.message);

                             },

                             xhr: function(){
                                 var xhr = $.ajaxSettings.xhr();
                                 if (xhr.upload) {
                                     xhr.upload.addEventListener('progress', function(event) {
                                         var percent = 0;
                                         var position = event.loaded || event.position;
                                         var total = event.total;
                                         if (event.lengthComputable) {

                                             percent = Math.ceil(position / total * 100);
                                             $(uploadProgress).css('width', percent + '%');
                                             $(uploadStatus).text('Uploading... ' + percent + ' %');
                                         }
                                     }, true);
                                 }
                                 return xhr;
                             },

                             mimeType:"multipart/form-data"
                         });
                     }
                 }
             }
         }
     }

     function removeFile(removeBtn){
         var fileName = $(removeBtn).attr('data-file-name'),
             url = $(removeBtn).attr('href');

         var values = {
             'image_name': fileName,
             'admin_id': '<?php echo $admin->id; ?>'
         };

         var a = $.ajax({
             url: url,
             dataType: 'json',
             cache: false,
             data: values,
             type: 'POST',
             success: function(res) {
                 var uploadedObj = JSON.parse(JSON.stringify(res));

                 if(uploadedObj.status_code == 201) $(uploadStatus).text(uploadedObj.message);

                 $(removeBtn).closest('.img-wrapper').remove();
                 $(uploadStatus).text('Successfully Deleted');

                 var imageNames = $('[name="uploaded-image-names"]').val();
                 var updatedNames = '';
                 var nameArray = imageNames.split(',');
                 if(nameArray[nameArray.length-1].trim() == '') nameArray.splice(nameArray.length-1, 1);

                 $(nameArray).each(function(key, value){
                     if(fileName == value)  nameArray.splice(key, 1);
                     else updatedNames += value + ','

                 });

                 $('[name="uploaded-image-names"]').val(updatedNames);

                 $(uploadProgress).css('width', '0px');
             }
         });
     }


     function removeExistingFile(removeBtn){
         var fileName = $(removeBtn).attr('data-file-name'),
             url = $(removeBtn).attr('href');

         var values = {
             'image_name': fileName,
             'admin_id': '<?php echo $admin->id; ?>'
         };

         var a = $.ajax({
             url: url,
             dataType: 'json',
             cache: false,
             data: values,
             type: 'POST',
             success: function(res) {
                 var uploadedObj = JSON.parse(JSON.stringify(res));

                 if(uploadedObj.status_code == 201) $(uploadStatus).text(uploadedObj.message);

                 $(removeBtn).closest('.img-wrapper').remove();
                 $(uploadStatus).text('Successfully Deleted');

                 var imageNames = $('[name="removed-image-ids"]').val();
                 imageNames += $(removeBtn).data('image-id') + ',';

                 $('[name="removed-image-ids"]').val(imageNames);

                 $(uploadProgress).css('width', '0px');
             }
         });
     }


     function renderNewCB(combinedCB, newCbId, newCbText){
         var cbWrapper = $('<div>'),
             cbInput = $('<input>', {
                 type: 'checkbox', id: newCbId, name: 'combined-attr', value: newCbId, 'checked': 'checked'
             }).appendTo(cbWrapper),
             cbLabel = $('<label>', { text: newCbText, for: newCbId });

         cbLabel.appendTo(cbWrapper);
         cbWrapper.appendTo(combinedCB);
     }


     function renderCombinedAttr(combinedCB, newCbId, newCbText, attrQty){

         var newId = newCbId.replace(/atr/g, '');
         newId = newId.replace(/val/g, '');

         var cbWrapper = $('<div>', { class: 'combined-attr-inner' }),
             cbLabel = $('<label>', { text: newCbText, for: newId }).appendTo(cbWrapper),
             qtyInput = $('<input>', { placeholder: 'Quantity', name: 'qty' + newId, id: newId, class: 'qty'}).appendTo(cbWrapper);

         if(attrQty != null){
             if(attrQty[newId] != 'undefined') qtyInput.val(attrQty[newId]);
         }

         cbWrapper.appendTo(combinedCB);
     }


     function attrMappingUpdate(checkedAttr, attrQty){
         var combinedCB = $('#combined-cb');
         combinedCB.html('');

        $(checkedAttr).each(function(key, value){
            var newCbId = '';
            var newCbText = '';
            $(value).each(function(key, value){

                newCbId += value + '_';
                newCbText += $('label[for="' + value + '"]').text() + ' + ';
            });

            newCbId = newCbId.slice(0, -1);
            newCbText = newCbText.slice(0, -3);

            renderNewCB(combinedCB, newCbId, newCbText);

        });

     }


     function attrMappingAdd(checkedAttr, checkedAssociativeAttr){
         var combinedCB = $('#combined-cb');
         combinedCB.html('');


         if(checkedAttr.length == 1){
             /*=========ONE=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 var cbId = checkedAssociativeAttr[0][j],
                     cbText = $('label[for="' + cbId + '"]').text(),
                     newCbText = cbText;
                 newCbId = cbId;

                 renderNewCB(combinedCB, newCbId, newCbText);
             }

         }else if(checkedAttr.length == 2){
             /*=========TWO=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){

                     var cbId1 = checkedAssociativeAttr[0][j],
                         cbId2 = checkedAssociativeAttr[1][k],
                         cbText1 = $('label[for="' + cbId1 + '"]').text(),
                         cbText2 = $('label[for="' + cbId2 + '"]').text(),
                         newCbText = cbText1 + ' + ' + cbText2,
                         newCbId = cbId1 + '_' + cbId2;

                     renderNewCB(combinedCB, newCbId, newCbText);
                 }
             }

         }else if(checkedAttr.length == 3){
             /*=========THREE=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){

                         var cbId1 = checkedAssociativeAttr[0][j],
                             cbId2 = checkedAssociativeAttr[1][k],
                             cbId3 = checkedAssociativeAttr[2][l],
                             cbText1 = $('label[for="' + cbId1 + '"]').text(),
                             cbText2 = $('label[for="' + cbId2 + '"]').text(),
                             cbText3 = $('label[for="' + cbId3 + '"]').text(),
                             newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3,
                             newCbId = cbId1 + '_' + cbId2 + '_' + cbId3;

                         renderNewCB(combinedCB, newCbId, newCbText);
                     }
                 }
             }

         }else if(checkedAttr.length == 4){
             /*=========FOUR=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){

                             var cbId1 = checkedAssociativeAttr[0][j],
                                 cbId2 = checkedAssociativeAttr[1][k],
                                 cbId3 = checkedAssociativeAttr[2][l],
                                 cbId4 = checkedAssociativeAttr[3][m],
                                 cbText1 = $('label[for="' + cbId1 + '"]').text(),
                                 cbText2 = $('label[for="' + cbId2 + '"]').text(),
                                 cbText3 = $('label[for="' + cbId3 + '"]').text(),
                                 cbText4 = $('label[for="' + cbId4 + '"]').text(),
                                 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4,
                                 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4;

                             renderNewCB(combinedCB, newCbId, newCbText);
                         }
                     }
                 }
             }

         }else if(checkedAttr.length == 5){
             /*=========FIVE=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){

                                 var cbId1 = checkedAssociativeAttr[0][j],
                                     cbId2 = checkedAssociativeAttr[1][k],
                                     cbId3 = checkedAssociativeAttr[2][l],
                                     cbId4 = checkedAssociativeAttr[3][m],
                                     cbId5 = checkedAssociativeAttr[4][n],
                                     cbText1 = $('label[for="' + cbId1 + '"]').text(),
                                     cbText2 = $('label[for="' + cbId2 + '"]').text(),
                                     cbText3 = $('label[for="' + cbId3 + '"]').text(),
                                     cbText4 = $('label[for="' + cbId4 + '"]').text(),
                                     cbText5 = $('label[for="' + cbId5 + '"]').text(),
                                     newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5,
                                     newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5;

                                 renderNewCB(combinedCB, newCbId, newCbText);
                             }
                         }
                     }
                 }
             }
         }else if(checkedAttr.length == 6){
             /*=========SIX=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){
								 for(var o = 0; o < checkedAssociativeAttr[5].length; o++){

									 var cbId1 = checkedAssociativeAttr[0][j],
										 cbId2 = checkedAssociativeAttr[1][k],
										 cbId3 = checkedAssociativeAttr[2][l],
										 cbId4 = checkedAssociativeAttr[3][m],
										 cbId5 = checkedAssociativeAttr[4][n],
										 cbId6 = checkedAssociativeAttr[5][o],
										 cbText1 = $('label[for="' + cbId1 + '"]').text(),
										 cbText2 = $('label[for="' + cbId2 + '"]').text(),
										 cbText3 = $('label[for="' + cbId3 + '"]').text(),
										 cbText4 = $('label[for="' + cbId4 + '"]').text(),
										 cbText5 = $('label[for="' + cbId5 + '"]').text(),
										 cbText6 = $('label[for="' + cbId6 + '"]').text(),
										 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5+ ' + ' + cbText6,
										 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5+ '_' + cbId6;

									 renderNewCB(combinedCB, newCbId, newCbText);
								 }
                             }
                         }
                     }
                 }
             }
         }else if(checkedAttr.length == 7){
             /*=========SEVEN=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){
								 for(var o = 0; o < checkedAssociativeAttr[5].length; o++){
									 for(var p = 0; p < checkedAssociativeAttr[6].length; p++){

										 var cbId1 = checkedAssociativeAttr[0][j],
											 cbId2 = checkedAssociativeAttr[1][k],
											 cbId3 = checkedAssociativeAttr[2][l],
											 cbId4 = checkedAssociativeAttr[3][m],
											 cbId5 = checkedAssociativeAttr[4][n],
											 cbId6 = checkedAssociativeAttr[5][o],
											 cbId7 = checkedAssociativeAttr[6][p],
											 cbText1 = $('label[for="' + cbId1 + '"]').text(),
											 cbText2 = $('label[for="' + cbId2 + '"]').text(),
											 cbText3 = $('label[for="' + cbId3 + '"]').text(),
											 cbText4 = $('label[for="' + cbId4 + '"]').text(),
											 cbText5 = $('label[for="' + cbId5 + '"]').text(),
											 cbText6 = $('label[for="' + cbId6 + '"]').text(),
											 cbText7 = $('label[for="' + cbId7 + '"]').text(),
											 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5 + ' + ' + cbText6 + ' + ' + cbText7,
											 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5 + '_' + cbId6 + '_' + cbId7;

										 renderNewCB(combinedCB, newCbId, newCbText);
									 }
								 }
                             }
                         }
                     }
                 }
             }
         }else if(checkedAttr.length == 8){
             /*=========EIGHT=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){
								 for(var o = 0; o < checkedAssociativeAttr[5].length; o++){
									 for(var p = 0; p < checkedAssociativeAttr[6].length; p++){
										 for(var q = 0; q < checkedAssociativeAttr[7].length; q++){

											 var cbId1 = checkedAssociativeAttr[0][j],
												 cbId2 = checkedAssociativeAttr[1][k],
												 cbId3 = checkedAssociativeAttr[2][l],
												 cbId4 = checkedAssociativeAttr[3][m],
												 cbId5 = checkedAssociativeAttr[4][n],
												 cbId6 = checkedAssociativeAttr[5][o],
												 cbId7 = checkedAssociativeAttr[6][p],
												 cbId8 = checkedAssociativeAttr[7][q],
												 cbText1 = $('label[for="' + cbId1 + '"]').text(),
												 cbText2 = $('label[for="' + cbId2 + '"]').text(),
												 cbText3 = $('label[for="' + cbId3 + '"]').text(),
												 cbText4 = $('label[for="' + cbId4 + '"]').text(),
												 cbText5 = $('label[for="' + cbId5 + '"]').text(),
												 cbText6 = $('label[for="' + cbId6 + '"]').text(),
												 cbText7 = $('label[for="' + cbId7 + '"]').text(),
												 cbText8 = $('label[for="' + cbId8 + '"]').text(),
												 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5 + ' + ' + cbText6 + ' + ' + cbText7 + ' + ' + cbText8,
												 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5 + '_' + cbId6 + '_' + cbId7 + '_' + cbId8;

											 renderNewCB(combinedCB, newCbId, newCbText);
										 }
									 }
								 }
                             }
                         }
                     }
                 }
             }
         }else if(checkedAttr.length == 9){
             /*=========NINE=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){
								 for(var o = 0; o < checkedAssociativeAttr[5].length; o++){
									 for(var p = 0; p < checkedAssociativeAttr[6].length; p++){
										 for(var q = 0; q < checkedAssociativeAttr[7].length; q++){
											 for(var r = 0; r < checkedAssociativeAttr[8].length; r++){

												 var cbId1 = checkedAssociativeAttr[0][j],
													 cbId2 = checkedAssociativeAttr[1][k],
													 cbId3 = checkedAssociativeAttr[2][l],
													 cbId4 = checkedAssociativeAttr[3][m],
													 cbId5 = checkedAssociativeAttr[4][n],
													 cbId6 = checkedAssociativeAttr[5][o],
													 cbId7 = checkedAssociativeAttr[6][p],
													 cbId8 = checkedAssociativeAttr[7][q],
													 cbId9 = checkedAssociativeAttr[8][r],
													 cbText1 = $('label[for="' + cbId1 + '"]').text(),
													 cbText2 = $('label[for="' + cbId2 + '"]').text(),
													 cbText3 = $('label[for="' + cbId3 + '"]').text(),
													 cbText4 = $('label[for="' + cbId4 + '"]').text(),
													 cbText5 = $('label[for="' + cbId5 + '"]').text(),
													 cbText6 = $('label[for="' + cbId6 + '"]').text(),
													 cbText7 = $('label[for="' + cbId7 + '"]').text(),
													 cbText8 = $('label[for="' + cbId8 + '"]').text(),
													 cbText9 = $('label[for="' + cbId9 + '"]').text(),
													 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5 + ' + ' + cbText6 + ' + ' + cbText7 + ' + ' + cbText8 + ' + ' + cbText9,
													 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5 + '_' + cbId6 + '_' + cbId7 + '_' + cbId8 + '_' + cbId9;

												 renderNewCB(combinedCB, newCbId, newCbText);
											 }
										 }
									 }
								 }
                             }
                         }
                     }
                 }
             }
         }else if(checkedAttr.length == 10){
             /*=========NINE=========*/
             for(var j = 0; j < checkedAssociativeAttr[0].length; j++){
                 for(var k = 0; k < checkedAssociativeAttr[1].length; k++){
                     for(var l = 0; l < checkedAssociativeAttr[2].length; l++){
                         for(var m = 0; m < checkedAssociativeAttr[3].length; m++){
                             for(var n = 0; n < checkedAssociativeAttr[4].length; n++){
								 for(var o = 0; o < checkedAssociativeAttr[5].length; o++){
									 for(var p = 0; p < checkedAssociativeAttr[6].length; p++){
										 for(var q = 0; q < checkedAssociativeAttr[7].length; q++){
											 for(var r = 0; r < checkedAssociativeAttr[8].length; r++){
												 for(var s = 0; s < checkedAssociativeAttr[9].length; s++){

													 var cbId1 = checkedAssociativeAttr[0][j],
														 cbId2 = checkedAssociativeAttr[1][k],
														 cbId3 = checkedAssociativeAttr[2][l],
														 cbId4 = checkedAssociativeAttr[3][m],
														 cbId5 = checkedAssociativeAttr[4][n],
														 cbId6 = checkedAssociativeAttr[5][o],
														 cbId7 = checkedAssociativeAttr[6][p],
														 cbId8 = checkedAssociativeAttr[7][q],
														 cbId9 = checkedAssociativeAttr[8][r],
														 cbId10 = checkedAssociativeAttr[9][s],
														 cbText1 = $('label[for="' + cbId1 + '"]').text(),
														 cbText2 = $('label[for="' + cbId2 + '"]').text(),
														 cbText3 = $('label[for="' + cbId3 + '"]').text(),
														 cbText4 = $('label[for="' + cbId4 + '"]').text(),
														 cbText5 = $('label[for="' + cbId5 + '"]').text(),
														 cbText6 = $('label[for="' + cbId6 + '"]').text(),
														 cbText7 = $('label[for="' + cbId7 + '"]').text(),
														 cbText8 = $('label[for="' + cbId8 + '"]').text(),
														 cbText9 = $('label[for="' + cbId9 + '"]').text(),
														 cbText10 = $('label[for="' + cbId10 + '"]').text(),
														 newCbText = cbText1 + ' + ' + cbText2 + ' + ' + cbText3 + ' + ' + cbText4 + ' + ' + cbText5 + ' + ' + cbText6 + ' + ' + cbText7 + ' + ' + cbText8 + ' + ' + cbText9 + ' + ' + cbText10,
														 newCbId = cbId1 + '_' + cbId2 + '_' + cbId3 + '_' + cbId4 + '_' + cbId5 + '_' + cbId6 + '_' + cbId7 + '_' + cbId8 + '_' + cbId9 + '_' + cbId10;

													 renderNewCB(combinedCB, newCbId, newCbText);
												 }
											 }
										 }
									 }
								 }
                             }
                         }
                     }
                 }
             }
         }
     }


     /*MAIN SCRIPTS*/
     (function ($) {
         "use strict";

         $("input.qty").change(function(){
             $('input[name="prev_attr"]').val(attrIdsFromDB.join(','));
         });

         $('[data-popup]').on('click', function(e){
             e.stopPropagation();
             e.preventDefault();

             var $this = $(this),
                 targetDiv = $this.data('popup');

             var checkedAttr = [];
             $($('#combined-attr-wrapper').find('label')).each(function(){

                 var attrValues = $(this).attr('for');
                 var attrValueArr = attrValues.split('_');
                 var checkedAssociativeAttr = [];

                 for(var  i = 0; i < attrValueArr.length; i++){
                     var attrValueIdArr = attrValueArr[i].split('-');
                     var first = 'atr' + attrValueIdArr[0];
                     var last = 'val' + attrValueIdArr[1];
                     var attrValueId = first + '-' + last;

                     $('#' + attrValueId).prop('checked', true);
                     $('#' + attrValueId).closest('.attribute-cb-wrapper').find('.attribute-cb').find('input').prop('checked', true);

                     checkedAssociativeAttr.push(attrValueId);
                 }

                 checkedAttr.push(checkedAssociativeAttr);
             });

             attrMappingUpdate(checkedAttr, attrQty);
             $(targetDiv).addClass('active');

         });


         $('#combined-attr-btn').on('click', function(e){
             var selectedAttr = [];
             e.preventDefault();
             e.stopPropagation();
             var combinedAttrWrapper = $('#combined-attr-wrapper'),
                 $this = $(this);

             combinedAttrWrapper.html('');

             $($this.closest('form').find('input[type="checkbox"]:checked')).each(function(event){
                 var attr = $(this).val();
                 attr = attr.replace(/atr|val/g, '');
                 selectedAttr.push(attr);

                 renderCombinedAttr(combinedAttrWrapper,  $(this).val(), $('label[for="' + $(this).val() + '"]').html(), attrQty);
             });

             if(selectedAttr.length > 0)  $(".inventory").removeClass('active');
             else $(".inventory").addClass('active');


             selectedAttr.sort();
             attrFromDB.sort();

             var isSame = (selectedAttr.length == attrFromDB.length) && selectedAttr.every(function(element, index){
                     return element == attrFromDB[index];
                 });

             if(!isSame){
                 if(attrIdsFromDB.length < 1) attrIdsFromDB.push('empty');
                 $('input[name="prev_attr"]').val(attrIdsFromDB.join(','));
             }

             $this.closest('.item-wrapper').removeClass('active');

         });


         $('input[type="checkbox"]').change(function() {
             var $this = $(this);

             if($this.attr('name') == 'attribute'){
                 if(this.checked) $this.closest('.attribute-cb-wrapper').find('.attribute-value-cb').find('input').prop('checked', true);
                 else $this.closest('.attribute-cb-wrapper').find('.attribute-value-cb').find('input').prop('checked', false);

             }else if($this.attr('name') == 'attribute-value'){
                 if(!this.checked) {
                     var haveChecked = false;
                     $($this.closest('.attribute-cb-wrapper').find('.attribute-value-cb').find('input')).each(function(){
                         if(this.checked) haveChecked = true;
                     });

                     if(!haveChecked) $this.closest('.attribute-cb-wrapper').find('.attribute-cb').find('input').prop('checked', false);
                 }else $this.closest('.attribute-cb-wrapper').find('.attribute-cb').find('input').prop('checked', true);
             }

             var checkedAttr = [];
             var checkedAssociativeAttr = [];
             $($(this).closest('.attribute-wrapper').find('.attribute-cb').find('input:checked')).each(function(key, value){
                 checkedAttr.push($(this).attr('id'));
                 checkedAssociativeAttr[key] = [];
             });

             var combinedCB = $('#combined-cb');
             combinedCB.html('');


             if(checkedAttr.length > 0){
                 var combinedCBHeading = $('<h6>', { text: 'Selected Combination', class: 'mt-15 mb-15' }).appendTo(combinedCB);
             }

             $($(this).closest('.attribute-wrapper').find('.attribute-value-cb').find('input:checked')).each(function(){
                 var attrValueId = $(this).attr('id');

                 $(checkedAttr).each(function(key, value){
                     if(attrValueId.indexOf(value) >= 0) {
                         checkedAssociativeAttr[key].push(attrValueId);
                         return;
                     }
                 });
             });

             attrMappingAdd(checkedAttr, checkedAssociativeAttr, attrQty);
         });


         $('[data-validation="true"]').on('submit', function(e){
             var hasError = false;
             if($('#combined-attr-wrapper').find('input').length < 1){
                 var inv = $('#inventory');

                 if(isEmpty(inv.val()) || inv.val() < 1) {
                     inv.addClass('has-error');
                     inv.after('<h6 class="err-msg">Inventory is required' + '</h6>');
                     hasError = true;
                 }
             }else{
                 $($(this).find('.combined-attr-inner input')).each(function(e){
                     var $this = $(this);

                     if(isEmpty($this.val()) || inv.val() < 1) {
                         hasError = true;
                         $this.addClass('has-error');
                         $this.after('<h6 class="err-msg">required' + '</h6>');
                     }
                 });
             }

             if(hasError){
                 e.stopPropagation();
                 e.preventDefault();
                 return false;
             }
         });

         $(document).on('click touch', function(e) {
             $('.popup-area').removeClass('active');
         });

         $('.popup-area .item').on('click touch', function(e) {
             e.stopPropagation();
         });


         window.onbeforeunload = function() {
             if(refreshDisable){
                 return "Are you sure you want to leave?";
             }
         }


         $("#file-upload").closest('form').on('submit', function(){
             if(submitDisable) {
                 alert("Upload is in Progress");
                 return false;
             }
         });

         $("#file-upload").change(function (){
             upload($(this));
         });


         $(document).on('click', '.remove-image', function(e) {
             e.preventDefault();
             e.stopPropagation();
             if(confirm("Are You Sure?")){
                 var $this = $(this);
                 removeFile($this)
             }
             return false;
         });
     })(jQuery);
</script>
<script>
    var countryId = 101;
    var stateSelId = 35;
    $.ajax({
        url: "state.php",
        cache: false,
        type: "POST",
        data: {countryId : countryId, stateSelId : stateSelId},
        success: function(html){
            $("#eventStateDiv").append(html);

            var stateId = $("#eventState").val();
            //console.log(stateId,"stateId");
            if(stateId != undefined || stateId == "" || stateId == null) {
                stateId = 35;
            }

            $.ajax({
                url: "city.php",
                cache: false,
                type: "POST",
                data: {stateId : stateId},
                success: function(html){
                    $("#eventCityDiv").append(html);
                }
            });

        }
    });

   /* var stateId = $("#eventState").val();
    console.log(stateId,"stateId");
    if(stateId != undefined || stateId == "" || stateId == null) {
        stateId = 35;
    }

    $.ajax({
        url: "city.php",
        cache: false,
        type: "POST",
        data: {stateId : stateId},
        success: function(html){
            $("#eventCityDiv").append(html);
        }
    });*/

    //var parentCategoryId = $("#parentCategoryId").val();
    //var $loading = $('# ').hide();
    //var $loading = $('#eventSubCategoryLoadingDiv').hide();
    
    $.ajax({
        url: "category.php",
        cache: false,
        type: "POST",
        //data: {parentCategoryId : parentCategoryId},
        success: function(html){
            $("#eventCategoryDiv").append(html);
        }
    });

    var parentCategoryId = $("#eventCategory").val();
    $.ajax({
        url: "sub_category.php",
        cache: false,
        type: "POST",
        data: {parentCategoryId : parentCategoryId},
        success: function(html){
            $("#eventSubCategoryDiv").append(html);
        }
    });

    function eventState(){
        var countryId = 101;
        $.ajax({
            url: "state.php",
            cache: false,
            type: "POST",
            data: {countryId : countryId},
            success: function(html){
                $("#eventStateDiv").append(html);
            }
        });
    }
    function eventCity(stateId){
        var stateId = $("#eventStateId").val();
        $.ajax({
            url: "city.php",
            cache: false,
            type: "POST",
            data: {stateId : stateId},
            success: function(html){
                $("#eventCityDiv").append(html);
            }
        });
    }    
</script>    
</body>