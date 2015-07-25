<?php
session_start();




include("nusoap.php");




$crypted_price = crypt(sprintf("%.2f", $price), $config['paypal_secret_word']);
$docroot = $_SERVER['SERVER_NAME'];
$url           = 'http://' . $docroot . '/plugins/zarrinpal/controllers/post.gateway.php';
$lib           = RL_PLUGINS_URL . 'zarrinpal/lib/nusoap.php';
$posturl           = RL_PLUGINS_URL . 'zarrinpal/controllers/post.gateway.php';













$_SESSION[itemid]=$_POST[itemid];
$_SESSION[planid]=$_POST[planid];
$_SESSION[accountid]=$_POST[accountid];
$_SESSION[price]=$_POST[price];
$_SESSION[callback_class]=$_POST[callback1];
$_SESSION[callback_method]=$_POST[callback2];
$_SESSION[crypted_price]=$_POST[cprice];
$_SESSION[RL_LANG_CODE]=$_POST[langcode];
$_SESSION[itemname]=$_POST[itemname];
$_SESSION[acinfo]=$_POST[acinfo];
$_SESSION[merchant]=$_POST[merchant];
$_SESSION[success]=$_POST[success];
$_SESSION[nope]=$_POST[cancel];





	$MerchantID = $_POST['merchant'];;  //Required
	$Amount = $_POST[price]; //Amount will be based on Toman  - Required
	$Description = $_POST[planid];  // Required
	$Email = 'UserEmail@Mail.Com'; // Optional
	$Mobile ='09123456789'; // Optional
	$CallbackURL = $url;  // Required

	
	
	// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
	$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
	$client->soap_defencoding = 'UTF-8';
	$result = $client->call('PaymentRequest', array(
													array(
															'MerchantID' 	=> $MerchantID,
															'Amount' 		=> $Amount,
															'Description' 	=> $Description,
															'Email' 		=> $Email,
															'Mobile' 		=> $Mobile,
															'CallbackURL' 	=> $CallbackURL
														)
													)
	);
	
	//Redirect to URL You can do it also by creating a form
	if($result['Status'] == 100)
	{
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result['Authority']);
	} else {
		
				?>
								
						
								<meta http-equiv="refresh" content="0;url=<?php echo $_SESSION['nope'];?>" >    <?
	}







?>
	
	
