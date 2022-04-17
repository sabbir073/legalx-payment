jQuery(document).ready(function(e) {
    jQuery('#onedayservice').click(function (){
        jQuery.ajax({
            type: "GET",
            url: obj.paymenturl, 
            data: {'servicetype':'D'},
            success: function(msg){      
                console.log(msg);
            }
        });
    });


});