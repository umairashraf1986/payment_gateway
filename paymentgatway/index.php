<?php 
error_reporting(0) ;
include('common_files/connection.php'); //Configuration files

if($_POST['language'] == 'en') {
	$_SESSION['lang'] = 'en';
}
 else if ($_POST['language'] == 'ch')
 {  
	 $_SESSION['lang'] = 'ch';
 }
	
else if (!isset($_SESSION['lang'])) 
{
	$_SESSION['lang'] = 'en';
}
  
	//Website Base section
	if($_GET['page']){
		$_SESSION['curr_page']=$_GET['page'];
		$filename = $_GET['page'].'.php' ;
		if(file_exists('base/'.$filename.''))
		{
			include('base/'.$filename.'');
		}
	}else{

		if(file_exists('base/index.php'))
		{
			include('base/index.php');
		}
	} 
	 //Website Header section
	  $SURL = 'http://dev.ejuicysolutions.com/pokeapanda/game/'.$_SESSION['lang'].'/' ;
	
	   include($_SESSION['lang'].'/includes/header.php');

?>
<?php 
    if($_GET['page']){
		if(file_exists($_SESSION['lang'].'/'.$filename)){
				
			include($_SESSION['lang'].'/'.$filename);
				
		}else{
			include('base/error.php');
		}
	}else{
		
		include($_SESSION['lang'].'/'.'index.php');
			
	}
	//Website Footer Section.
	//include($_SESSION['lang'].'/includes/footer.php');
?>