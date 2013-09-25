
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>
<body>
<br><br>
<center><h1>Payment Details</h1></center>
<br><br>
<table align='center'>
<tbody align="left">
<form id="cc_form" name="cc_form" method="post" action="https://www.binaryfolder.com/crm/api/auth.php">
<input name="key" type="hidden" value="ENTER YOUR API KEY HERE" />
<input name="process_mode" type="hidden" value="void" />
<input name="redirect_url" type="hidden" value="ENTER YOUR REDIRECT URL HERE" />
<tr>
    <th>Transaction ID:</th>
    <td>     <input name="transaction_id" type="text" value="" /></td>
</tr>
<tr><th colspan="2" align="center"><input type="submit" name="test" value="Submit Sale" /></th></tr>
 </form>
 </tbody>
 </table>
</body>
</html>