<?php session_start();?>
<script type="text/javascript" src="javascript/jquery-1.3.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
						   
	$('.toggle:not(.toggle-open)') .addClass('toggle-closed') .parents('li') .children('ul') .hide();
	
	$('.<?php echo $_SESSION['current_page']; ?>') .addClass('toggle-open') .parents('li') .children('ul') .slideDown();

	if($.browser.msie){
		$('#menu ul.navmenu li:last-child .menutop') .css('border-bottom','1px solid #CCC');
	}
							
	$('.toggle') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .empty('') .append('+') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open') .empty('') .append('&ndash;') .parents('li') .children('ul') .slideDown(250);
		} })
								 
	$('.toggle1') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
	$('.toggle2') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
		$('.toggle3') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
			$('.toggle4') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
			$('.toggle5') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
		
			$('.toggle6') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
			$('.toggle0') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
			$('.toggle7') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
			$('.toggle8') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		$('.toggle9') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
	    $('.toggle10') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		$('.toggle11') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
		$('.toggle13') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
				$('.toggle12') .click(function(){
		if ($(this) .hasClass('toggle-open')) {		
			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
		}else{
			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
			$(this) .removeClass('toggle-closed') .addClass('toggle-open').parents('li') .children('ul') .slideDown(250);
		} })
		
		})
</script>

<div id="container_menu">
	<div align="center"id="menu">	
    	<ul class="navmenu">

        <li><div class="menutop toggle0"><a href="#">Welcome!</a><div class="toggle">+</div></div>
        <ul class="submenu">
        <li><a href="#">
			<?php echo 'Welcome: '.$_SESSION['adminauth']['name']; ?>
        </a></li>
        </ul>
        </li>
        <li>
        <div class="menutop toggle2"><a href="#">Merchant</a>
          <div class="toggle">+</div></div>
        <ul class="submenu">
        
       <li><a href="admin.php?act=list_transections&nav=toggle2">&nbsp;&nbsp;&nbsp;<img border="0" src="graphics/arrow-curve-000-left.gif" height="10" width="10" />Transaction Log</a></li> 
       
       	<?php 
		$query = mysql_query("SELECT 
							  vt_mode 
							  FROM 
							  crm_merchants 
							  WHERE 
							  `merchant_website`='".$_SESSION['adminauth']['merchant_website']."'");
		if(mysql_num_rows($query)>0){
			$query_array = mysql_fetch_array($query);
			$vt_mode = $query_array['vt_mode'];
			$_SESSION['adminauth']['vt_mode'] = $vt_mode;
		}
			if($_SESSION['adminauth']['vt_mode'] == '1'){
		?>
				<li><a href="admin.php?act=virtual_terminal&nav=toggle2">&nbsp;&nbsp;&nbsp;<img border="0" src="graphics/arrow-curve-000-left.gif" height="10" width="10" />Virtual Terminal</a></li> 
		<?php		
			}//end if
		?>
       	<?php if($_SESSION['adminauth']['bank'] != 9 && $_SESSION['adminauth']['bank'] != 10 && $_SESSION['adminauth']['bank'] != 11){?>
         <li><a href="admin.php?act=refund_log&nav=toggle2">&nbsp;&nbsp;&nbsp;<img border="0" src="graphics/arrow-curve-000-left.gif" height="10" width="10" />Refund Log</a></li>
        <?php }?>
         
         <?php if($_SESSION['adminauth']['bank'] == 7){?>
         
         <li><a href="admin.php?act=void_log&nav=toggle2">&nbsp;&nbsp;&nbsp;<img border="0" src="graphics/arrow-curve-000-left.gif" height="10" width="10" />Void Log</a></li>
         
		 <?php }?>
         
        </ul>
        </li>
        
        
        <li><div class="menutop toggle11"><a href="#">Settings</a><div class="toggle">+</div></div>
        <ul class="submenu">

        <?php if($_SESSION['adminauth']['role']=="2") { ?>
        	<li><a href="admin.php?act=change_password&nav=toggle11"><img border="0" src="graphics/arrow-curve-000-left.gif" height="10" width="10" />Merchant Settings</a></li>
        <?php } ?>
		  
        </ul>                
        </li>

        </ul>
    </div>
</div>