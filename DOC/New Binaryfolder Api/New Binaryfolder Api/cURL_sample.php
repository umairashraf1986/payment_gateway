<?php
$obj=new binaryfolder_class();
$obj->add_field("key","4gbKqLcg");
$obj->add_field("ssl","true");
$obj->add_field("id","70000478");
$obj->add_field("first_name","FirstName");
$obj->add_field("last_name","LastName");
$obj->add_field("email","email@eamil.com");
$obj->add_field("address","address");
$obj->add_field("city","city");
$obj->add_field("state","NJ");
$obj->add_field("country","US");
$obj->add_field("zip","07039");
$obj->add_field("phone","5551212");
$obj->add_field("product","invoice#");
$obj->add_field("amount","25.10");
$obj->add_field("cc_no","4111111111111111");
$obj->add_field("cvv","123");
$obj->add_field("exp_dt","Aug");
$obj->add_field("exp_yr","20");
$obj->add_field("cardholder","Holder Name");
$obj->add_field("c_type","Visa");
$obj->add_field("redirect","");
$obj->gateway_url="https://www.binaryfolder.com/crm/api/auth.php";
$obj->add_field("process_mode","sale");
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
