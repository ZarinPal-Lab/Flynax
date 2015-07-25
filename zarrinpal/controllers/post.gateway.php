<?php
session_start();
include("nusoap.php"); 
 
 
 
 
 
 
 


	require_once('../../../includes/config.inc.php');
	
	/* system controller */
	require_once( RL_INC . 'control.inc.php' );
	
	
	
	/* load system configurations */
	$config = $rlConfig -> allConfig();
	$errors = false;
	

	if (!$_POST['item_number'])
	{

		$plan_id = $_SESSION[planid];
		$item_id = $_SESSION[itemid];
		$account_id = $_SESSION[accountid];
		$crypted_sum = $_SESSION[crypted_price];
		$callback_class = $_SESSION[callback_class];
		$callback_method = $_SESSION[callback_method];
		$cancel_url = $_SESSION['nope'];
		$success_url = $_SESSION['success'];
		$lang_code = $_SESSION[RL_LANG_CODE];
		
		
		
		define( 'RL_LANG_CODE', $lang_code );
		define( 'RL_DATE_FORMAT', $rlDb -> getOne('Date_format', "`Code` = '{$config['lang']}'", 'languages') );
		
		$seo_base = RL_URL_HOME;
		$seo_base .= $lang_code == $config['lang'] ? '' : $lang_code;
		
		$lang = $rlLang -> getLangBySide( 'frontEnd', RL_LANG_CODE );
		$GLOBALS['lang'] = $lang;

		$total = $_SESSION[price]*10;
		
		
		

		// Check crypted sum
		
		
			$MerchantID = $_SESSION[merchant];
	$Amount = $_SESSION[price]; //Amount will be based on Toman
	$Authority = $_GET['Authority'];
	
	if($_GET['Status'] == 'OK'){
		// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
		$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
		$client->soap_defencoding = 'UTF-8';
		$result = $client->call('PaymentVerification', array(
															array(
																	'MerchantID'	 => $MerchantID,
																	'Authority' 	 => $Authority,
																	'Amount'	 	 => $Amount
																)
															)
		);
		
		
		
		

		if (( $result['Status'] == 100 ) or ( $result['Status'] == 101 ))
		{
			// If IPN processing script gets to this point it means
			// everything went smoothly and we can update listing status
			$txn_id = $result['RefID'];
			
	
			$reefless -> loadClass(str_replace('rl', '', $callback_class));
			
			$$callback_class -> $callback_method( $item_id, $plan_id, $account_id, $txn_id, 'زرین پال', $total );
			
			
			
			
			?>
								
							
								<meta http-equiv="Refresh" content="0;URL=<?echo $success_url;?>">    <?
		}
		else
		{
		
		// echo $result['Status'];
			$reefless -> redirect(null, $cancel_url);
		}
	}
	
	else {
		?>
								
							
								<meta http-equiv="Refresh" content="0;URL=<?echo $cancel_url;?>">    <?
	}
	
	}
