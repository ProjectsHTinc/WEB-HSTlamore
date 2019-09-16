<?php 
include('Crypto.php');
include("connection.php");
?>
<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php 

	error_reporting(0);
	
	$merchant_data='';
	$resp_data = '';
	$working_key='CA4120A14E0FB331E45F4B110C904EEA';//Shared by CCAVENUES
	$access_code='AVRA85GF94BB60ARBB';//Shared by CCAVENUES
	
	/*
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
    */
    $merchant_id = $_POST["merchant_id"];
	$order_id = $_POST["order_id"];
	$purchase_id = $_POST["purchase_id"];
	$amount = trim($_POST["amount"]);
	$currency = $_POST["currency"];
	$redirect_url = $_POST["redirect_url"];
	$cancel_url = $_POST["cancel_url"];
	$language = $_POST["language"];

	$resp_data = "merchant_id=".$merchant_id."&";
	$resp_data .= "purchase_id=".$purchase_id."&";
	$resp_data .= "order_id=".$order_id."&";
	
	
	
	$sQuery = "SELECT
                B.pricing
                FROM
                    institute_plan_history A,
                    institute_plans B
                WHERE
                    A.id = '$purchase_id' AND A.institute_plan_id = B.id
                LIMIT 1";
	$objRs = mysql_query($sQuery);
	while ($row = mysql_fetch_array($objRs))
	{
		$purchase_amount  = trim($row['pricing']);
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

