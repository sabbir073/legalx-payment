$(document).ready(function(e) {
    e.preventDefault();
    $('#onedayservice').click(function (){
        $.ajax({
            type: "GET",
            url: obj.paymentajax, 
            data: {servicetype:"D"},
            success: function(msg){      
                console.log(msg);
            }
        });
    });


});