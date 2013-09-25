<?php
$obj=new binaryfolder_class();
$obj->add_field("key","Enter Your API Key");
$obj->add_field("ssl","true");
$obj->add_field("id","Enter your merchant ID");
$obj->add_field("transaction_id","");
$obj->add_field("redirect","");
$obj->gateway_url="https://www.binaryfolder.com/crm/api/auth.php";
$obj->add_field("process_mode","refund");
$obj->process();

class binaryfolder_class {
   var $gateway_url;
   var $field_string;
   var $fields = array();
   var $gatewayurls = array();
   var $response_string;
   var $response = array();
   function seturl($url) 
   {
      $this->gateway_url = $url;
   }
   function add_field($field, $value) {
      $this->fields["$field"] = urlencode($value);
   }
   function process()
    {
    foreach( $this->fields as $key => $value )
          {
         $this->field_string .= "$key=".$value."&";
               //  print "$key = $value\n";
          }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->gateway_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " ))
;
        $this->response_string = curl_exec($ch);
        /*if (curl_errno($ch)) {
                $this->response['Response Reason Text'] = curl_error($ch);
                return 3;
        } else curl_close ($ch);*/
        //Break up the respons
        print "RESPONSE:!";
	    print_r($this->response_string);
     }
}
?>
