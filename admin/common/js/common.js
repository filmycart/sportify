function eventState(countryId, cityId, stateId) {
    $.ajax({
        url: "state.php",
        cache: false,
        type: "POST",
        data: {countryId : countryId, stateSelId : stateId},
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
        success: function(html){
            $("#eventCityDiv").html(html);
        }
    });
}   

function eventCategory(categoryId) {
    $.ajax({
        url: "category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId},
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
        success: function(html){
            $("#eventSubCategoryDiv").append(html);
        }
    });
}     