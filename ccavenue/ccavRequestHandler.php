<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>
<?php 
include('Crypto.php');
include("connection.php");

	error_reporting(0);
	

	$merchant_data='';
	$resp_data = '';
	
	$working_key='3A5F7172E7947B223888492581B32ED2';//Shared by CCAVENUES
	$access_code='AVAU84GD83BV10UAVB';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}


     $merchant_id = $_POST["merchant_id"];
	 $order_id = $_POST["order_id"];
	 $amount = $_POST["amount"];
	 $currency = $_POST["currency"];
	 $redirect_url = $_POST["redirect_url"];
	 $cancel_url = $_POST["cancel_url"];
	 $language = $_POST["language"];

	$resp_data = "merchant_id=".$merchant_id."&";
	$resp_data .= "order_id=".$order_id."&";
	
 	$query = "SELECT * FROM purchase_order WHERE order_id ='" .$order_id. "'";
	$result = $mysqli->query($query);
	
		if (mysqli_num_rows($result)> 0)
		{
			while ($row = mysqli_fetch_array($result))
			{
				$purchase_amount = $row['total_amount'];
			}
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

