<?php

add_action('wp_ajax_make_legalx_payment', 'make_legalx_payment');

function make_legalx_payment(){

$success = false;

$msisdn = get_user_meta(get_current_user_id(), 'phone', false);

$servicename= 'LegalX';

$subservicename= 'LegalX';

$servicetype= $_POST['servicetype'];

$groupid= '1';

$length = 32;
$characters = '0123456789';
$charactersLength = strlen($characters);
$refid = '';

for ($i = 0; $i < $length; $i++) {
    $refid .= $characters[rand(0, $charactersLength - 1)];
}

$sequence = 'LX';

$ssid = get_user_meta(get_current_user_id(), 'SSID', false);

$api_url = 'http://wap.teletalk.com.bd/legalx/chargejson.php';

$url = sprintf( '%s?msisdn=%s&servicename=%s&subservicename=%s&servicetype=%s&groupid=%s&refid=%s&sequence=%s&sesid=%s', $msisdn, $servicename, $subservicename, $servicetype, $groupid, $refid, $sequence,  $ssid );

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

if ( 'Charge OTP Send' === $decoded_response['result'] ) {
    $success = true;
} else {
    $success      = false;
}

return $decoded_response['result'];

}

make_legalx_payment();



