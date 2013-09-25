<?php
include('config.php');
include('connect.php');
include('classes/libmail.php');

$query = mysql_query("SELECT 
					  * 
					  FROM 
					  ".$tblprefix."email_queue 
					  LIMIT 0, 50");

if(mysql_num_rows($query)>0){
	while($row = mysql_fetch_array($query)){
		$m	= new Mail; // create the mail
		$m->From("refunds@axopay.com");
		$m->To($row['to']);
		$m->Subject($row['subject']);
		$m->Body($row['body']);	// set the body
		$m->Priority(1) ;	// set the priority to Low
		$m->Send();	// send the mail*/
		mysql_query("DELETE 
					 FROM 
					 ".$tblprefix."email_queue 
					 WHERE 
					 `id`=".$row['id']);
		sleep(1);
	}
}
?>