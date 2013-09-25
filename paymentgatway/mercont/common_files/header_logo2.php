	 <table border="0" class="txt" cellspacing="0" width="100%" cellpadding="0" align="center">
            <tr class="new_admin" style="background-color:transparent">
              <td width="70%" align="left">
             <div style="  margin-left: 44px; padding-top: 21px;"><img src="graphics/logo_admin.gif"  /></div>	  </td>
              <td width="30%" align="right" nowrap="nowrap" valign="top">
              <div class="logout_box">
				<strong style="color:#fff;">
				<?php
					if(isset($_SESSION['adminauth'])){	
						echo 'Welcome, '.$_SESSION['adminauth']['name'];
				?>
				</strong><br />
				<a href="admin.php">Home</a> <a href="logout.php" class="logout_btn">Logout</a>
				<?php
				}
				?>
              
              </div>
			</td>
            </tr>
            <tr class="bottom" style="background-color:transparent">
              <td colspan="2" align="center" height="25" valign="middle"><div id="msgstatusarea"></div></td>
            </tr>
          </table>
