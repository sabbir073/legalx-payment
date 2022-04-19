<?php



function make_legalx_payment(){

    check_ajax_referer( 'payment_ajax_nonce' );

    $success = false;

    $msisdn = get_user_meta(get_current_user_id(), 'phone', true);
    
    $servicename= 'LegalX';
    
    $subservicename= 'LegalX';
    
    $servicetype = $_REQUEST['servicetype'];
    
    $groupid= '1';
    
    $length = 32;
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $refid = '';
    
    for ($i = 0; $i < $length; $i++) {
        $refid .= $characters[rand(0, $charactersLength - 1)];
    }
    
    $sequence = 'LX';
    
    $ssid = get_user_meta(get_current_user_id(), 'SSID', true);
    
    $api_url = 'http://wap.teletalk.com.bd/legalx/chargejson.php';
    
    $url = sprintf( '%s?msisdn=%s&servicename=%s&subservicename=%s&servicetype=%s&groupid=%s&refid=%s&sequence=%s&sesid=%s', $api_url, $msisdn, $servicename, $subservicename, $servicetype, $groupid, $refid, $sequence,  $ssid );
    
    $response = wp_remote_post(
        $url,
        array(
            'method'      => 'GET',
            'timeout'     => 30,
            'sslverify' => false,
            'headers'     => array(),
            'body'        => array(),
            'cookies'     => array(),
        )
    );
    
    $decoded_response = (array) json_decode( $response['body'] );
    
    $result = $decoded_response['result'];
    
    wp_send_json_success(
			array(
				'verified'     => $result,
			)
		);
		
		wp_die();

}


add_action( "wp_ajax_make_legalx_payment", "make_legalx_payment" );
add_action( "wp_ajax_nopriv_make_legalx_payment", "make_legalx_payment" );
