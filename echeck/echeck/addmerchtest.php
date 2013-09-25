<?php
  //create array of data to be posted
$post_data['request_type'] = 'addmerchant';     
$post_data['security_key'] = '18a33ef0a08e0f4d2ce4a0a5e90295f9AAAA';     
$post_data['email_address'] = 'testdata@yahoo.com';     
$post_data['company_name'] = 'test data';     
$post_data['descriptor'] = 'test data';     
$post_data['company_tollfree'] = '5555555555';     
$post_data['company_local'] = '5555555555';     
$post_data['website'] = 'test data';     
$post_data['company_address'] = 'test data';     
$post_data['company_address2'] = 'test data';     
$post_data['company_city'] = 'test data';     
$post_data['company_state'] = 'test data';     
$post_data['company_zipcode'] = 'test data';     
$post_data['est_monthly'] = 'test data';      
$post_data['monthly_volume'] = 'test data'; 
$post_data['average_amount'] = 'test data'; 
$post_data['min_trans'] = 'test data'; 
$post_data['max_trans'] = 'test data'; 
$post_data['first_name'] = 'test data'; 
$post_data['last_name'] = 'test data'; 
$post_data['phone'] = "5555555555"; 
$post_data['cell'] = "5555555555"; 
$post_data['address'] = 'test data'; 
$post_data['address2'] = 'test data'; 
$post_data['city'] = 'test data'; 
$post_data['state'] = 'test data'; 
$post_data['zip_code'] = 'test data'; 
$post_data['manager_firstname'] = 'test data'; 
$post_data['manager_lastname'] = 'test data'; 
$post_data['manager_email'] = "testdata@yahoo.com"; 
$post_data['manager_phone'] = "5555555555"; 
$post_data['service_contact'] = "5555555555"; 
$post_data['service_email'] = "testdata@yahoo.com"; 
$post_data['service_phone'] = "5555555555"; 
$post_data['client_bankname'] = "test data"; 
$post_data['client_bank_routing'] = "01100015"; 
$post_data['client_bank_swift'] = "test data"; 

  //traverse array and prepare data for posting      
foreach ( $post_data as $key => $value) {         
    $post_items[] = $key . '=' . $value;     
} 

 //create the final string to be posted using implode()     
$post_string = implode ('&', $post_items); 

  //create cURL connection     
$curl_connection = curl_init('https://theecheck.com/backoffice/pi/iso_gateway_api.php'); 

//set options     
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);     
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");     
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);         
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);    
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1); 

 //set data to be posted     
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string); 


 //perform our request     
$result = curl_exec($curl_connection);     
echo "Transaction Result: " . $result . "<br><br>";     
// uncomment below to show information regarding the request   
//  print_r(curl_getinfo($curl_connection));    
// echo curl_errno($curl_connection) . '-' . curl_error($curl_connection);  
   
 //close the connection     
curl_close($curl_connection);  


?>