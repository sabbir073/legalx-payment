<?php
/**
* @package Legalx-Payment
*/
/*
Plugin Name:  Legalx Payment
Plugin URI:   https://github.com/sabbir073
Description:  Legalx Payment
Version:      1.0.0
Author:       Amicritas IT Ltd. 
Author URI:   https://amicritas.com
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  Legalx-Payment
*/


defined( 'ABSPATH' ) or die( 'Hey! You can not access to this' );



add_action( 'wp_enqueue_scripts', 'ajax_scripts_payment' );


function ajax_scripts_payment() {
    wp_register_script( 'paymentajax', plugin_dir_url( __FILE__ ).'payment.js', array(), null, true );
    $arr = array(
        'paymenturl' => plugin_dir_url( __FILE__ ) .'payment.php'
    );
    wp_localize_script('paymentajax','obj', $arr );

    wp_enqueue_script('paymentajax');
}


add_action( 'wp_enqueue_scripts', 'ajax_scripts_payment_confirm' );


function ajax_scripts_payment_confirm() {
    wp_register_script( 'paymentconfirmajax', plugin_dir_url( __FILE__ ).'payment-confirm.js', array(), null, true );
    $arr = array(
        'paymentconfirmurl' => plugin_dir_url( __FILE__ ) .'payment-confirm.php'
    );
    wp_localize_script('paymentconfirmajax','obj',$arr );

    wp_enqueue_script('paymentconfirmajax');
}

add_action( 'wp_enqueue_scripts', 'custom_jquery_script' );

function custom_jquery_script(){
    wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
    wp_enqueue_script('jquery');
}

