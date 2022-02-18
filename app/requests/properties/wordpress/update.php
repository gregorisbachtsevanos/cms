<?php

foreach($_POST as $key=>$val){
	$data[$key] = $val;
    // print_r($data);die();
}
$api_response = wp_remote_post( 'https://apartments.cozyestate.gr/wp-json/wp/v2/property/5708/', array(
    'headers' => array(
       'Authorization' => 'Basic ' . base64_encode( 'LOGIN:PASSWORD' )
   ),
   'body' => array(
           'title' => 'My test 1'
   )
) );

$body = json_decode( $api_response['body'] );


if( wp_remote_retrieve_response_message( $api_response ) === 'OK' ) {
   echo 'The post ' . $body->title->rendered . ' has been updated successfully';
}