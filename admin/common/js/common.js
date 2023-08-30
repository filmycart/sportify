function eventState(countryId, cityId, stateId) {
    $.ajax({
        url: "state.php",
        cache: false,
        type: "POST",
        data: {countryId : countryId, stateSelId : stateId},
        beforeSend: function() {
            $('#stateSpinnerDiv').show();
        },
        complete: function(){
            $('#stateSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventStateDiv").html(html);
            eventCity(cityId, stateId);
        }
    });
}

function eventCity(cityId, stateId) {
    $.ajax({
        url: "city.php",
        cache: false,
        type: "POST",
        data: {cityId : cityId, stateId : stateId},
        beforeSend: function() {
            $('#citySpinnerDiv').show();
        },
        complete: function(){
            $('#citySpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCityDiv").html(html);
        }
    });
}   

function eventType(eventTypeId) {
    $.ajax({
        url: "type.php",
        cache: false,
        type: "POST",
        data: {eventTypeId : eventTypeId},
        beforeSend: function() {
            $('#typeSpinnerDiv').show();
        },
        complete: function(){
            $('#typeSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventTypeDiv").html(html);
        }
    });
} 

function eventCategoryType(categoryId, eventTypeId, categoryTypeId) {
    $.ajax({
        url: "category_type.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, eventTypeId : eventTypeId, categoryTypeId : categoryTypeId},
        beforeSend: function() {
            $('#categoryTypeSpinnerDiv').show();
        },
        complete: function(){
            $('#categoryTypeSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCategoryTypeDiv").html(html);
        }
    });
}

function eventCategory(categoryId, eventTypeId) {
    $.ajax({
        url: "category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, eventTypeId: eventTypeId},
        beforeSend: function() {
            $('#categorySpinnerDiv').show();
        },
        complete: function(){
            $('#categorySpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCategoryDiv").html(html);
        }
    });
} 

function eventSubCategory(categoryId, subCategoryId) {
    var parentCategoryId = $("#eventCategory").val();
    $.ajax({
        url: "sub_category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, subCategoryId : subCategoryId },
        beforeSend: function() {
            $('#subCategorySpinnerDiv').show();
        },
        complete: function(){
            $('#subCategorySpinnerDiv').hide();
        },
        success: function(html){
            $("#eventSubCategoryDiv").append(html);
        }
    });
}     