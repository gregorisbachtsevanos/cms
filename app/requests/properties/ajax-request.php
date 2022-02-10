<?php

foreach($_POST as $key=>$val){
	$data[$key] = $val;
    print_r($data);
    die();
}
$username = 'global';
$password = 'WbEL MeTD GCtX c3u5 zWF6 0sNH';
$rest_api_url = "https://apartments.cozyestate.gr/wp-json/automatorwp/webhooks/0kqhpnbg";

$data_string = json_encode([
	'post_type'=> 'property',
	'title'    => 'Nikolaou Plastira 59',
    'content'  => $data['info'],
	'status'   => 'publish',
	
	'post_meta'=>
    array(
        array(
            'property_id_key'=>'REAL_HOMES_property_id',
            'property_id_value'=>$data['postal'],
        ),
        array(
            'property_price_key'=>'REAL_HOMES_property_price',
            'property_price_value'=>$data['latitude'],
        ),
		 array(
            'property_bathrooms_key'=>'REAL_HOMES_property_bathrooms',
            'property_bathrooms_value'=>$data['kitchen'],
        ),
        array(
            'property_bedrooms_key'=>'REAL_HOMES_property_bedrooms',
            'property_bedrooms_value'=>$data['double_beds'],
        ),
		 array(
            'property_year_key'=>'REAL_HOMES_property_year_built',
            'property_year_value'=>$data['longitude']
        )
    ) 
    
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $rest_api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string),
    'Authorization: Basic ' . base64_encode($username . ':' . $password),
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

if ($result) {
    echo "done";
} else {
    echo "error";
}