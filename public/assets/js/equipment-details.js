$(document).ready(function(){


});

$(document).on('click','.equip-search-button',function(){
    var equipment_search = $("#equip-search")[0].value;
    // console.log(equipment_search);
    $.ajax({
        type: "POST",
        url: "js-request/equipment-search",
        data: {
            equipment:equipment_search,
        },
        success: function (response) {
            // var brnadData = $.parseJSON(response);

            // $("#summary").html(brnadData['Summary']);
            // $("#description").html(brnadData['Description']);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // console.log(xhr)
            // console.log(ajaxOptions)
            // console.log(thrownError)
        },
    });

});
