jQuery(document).ready(function($) {
    jQuery('#onedayservice').click(function (event){
        event.preventDefault();
        $.ajax({
            url: ajax_payment.ajaxurl,
            type: 'POST',
            data:{ 
              servicetype: 'D',
              action: 'make_legalx_payment',
              _ajax_nonce: ajax_payment.nonce,
              
            },
            success: function( data ){
              
              console.log( data );
            }
          });
    });
});