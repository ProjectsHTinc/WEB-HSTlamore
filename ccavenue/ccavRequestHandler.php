<?php 
include('Crypto.php');
include("connection.php");
?>
<html>
<head>
<title>Little A More - Payment</title>
</head>
<body>
<center>

<?php 

	error_reporting(0);
	
	$merchant_data='';
	$resp_data = '';
	$working_key='66DE435387A4C12180CCB5350B4B6552';//Shared by CCAVENUES
	$access_code='AVAU84GD83BV10UAVB';//Shared by CCAVENUES
	
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
    

exit;

    $merchant_id = $_POST["merchant_id"];
	$order_id = $_POST["order_id"];
	$amount = trim($_POST["amount"]);
	$currency = $_POST["currency"];
	$redirect_url = $_POST["redirect_url"];
	$cancel_url = $_POST["cancel_url"];
	$language = $_POST["language"];

	$resp_data = "merchant_id=".$merchant_id."&";
	$resp_data .= "order_id=".$order_id."&";
	//$resp_data .= "amount=".$amount."&";
	
 	$sQuery = "SELECT total_amount FROM purchase_order WHERE order_id = '$order_id' LIMIT 1";
	$objRs = mysql_query($sQuery);
	while ($row = mysql_fetch_array($objRs))
	{
		$purchase_amount  = trim($row['total_amount']);
	}

	if ($amount != $purchase_amount){
		$resp_data .= "amount=".$purchase_amount."&";
	} else {
		$resp_data .= "amount=".$amount."&";
	} 
	
	$resp_data .= "currency=".$currency."&";
	$resp_data .= "redirect_url=".$redirect_url."&";
	$resp_data .= "cancel_url=".$cancel_url."&";
	$resp_data .= "language=".$language."&";
	

	$encrypted_data=encrypt($resp_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

