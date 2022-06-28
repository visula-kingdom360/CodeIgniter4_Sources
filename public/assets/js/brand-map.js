$(document).ready(function(){

    var brand_id = '';
    brand_id = $("#brandid").select()[0].value;

    brandDetails(brand_id);

    $("#brandid").change(function(){
        brand_id = this.value;
        brandDetails(brand_id);
        console.log(this.value);
    });

    function brandDetails(brand_id)
    {
        $.ajax({
            type: "POST",
            url: "js-request/brand-detail",
            data: {
                brandid:brand_id,
            },
            success: function (response) {
                var brnadData = $.parseJSON(response);

                $("#summary").html(brnadData['Summary']);
                $("#description").html(brnadData['Description']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)
                console.log(ajaxOptions)
                console.log(thrownError)
            },

        });
    }
});
