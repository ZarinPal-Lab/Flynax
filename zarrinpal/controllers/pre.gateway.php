<?php
/**copyrights**/


$data = $plan_id .'|'. $item_id .'|'. $account_id .'|'. $price .'|'. $callback_class .'|'. $callback_method .'|'. $cancel_url .'|'. $success_url .'|'. RL_LANG_CODE .'|'. $callback_plugin; // $callback_plugin from v4.0.2
$data = base64_encode( $data ) ;
                                   
$success_url = $success_url . '&amp;item_number=' . $data; 
$reference = $reefless -> generateHash(8, 'upper');
$signature = md5($GLOBALS['config']['paytpv_account'] . $GLOBALS['config']['paytpv_usercode'] . $GLOBALS['config']['paytpv_terminal'] . 1 . $reference . $price . $GLOBALS['config']['paytpv_currency'] . md5($GLOBALS['config']['paytpv_password']));

$notify_url = RL_PLUGINS_URL . 'paytpv/controllers/post.gateway.php?item_number=' . $data . '&amp;ref=' . $reference . '&amp;s=' . $signature;
$payment_url = RL_PLUGINS_URL . 'zarrinpal/controllers/pre2.gateway.php'; 
$price=$price/10;
?>
<form name="payment_form" action="<?php echo $payment_url; ?>" method="post"> 
	
	
	<input type="hidden" name="merchant" value="<?php echo $GLOBALS['config']['zarrinpal_merchant']; ?>" /> 
	<input type="hidden" name="success" value="<?php echo $success_url; ?>" /> 
	<input type="hidden" name="cancel" value="<?php echo $cancel_url; ?>" />  
	<input type="hidden" name="price" value="<?php echo $price; ?>" />  
	<input type="hidden" name="itemid" value="<?php echo $item_id; ?>" />
	<input type="hidden" name="planid" value="<?php echo $plan_id; ?>" />
	<input type="hidden" name="accountid" value="<?php echo $account_id; ?>" />
	<input type="hidden" name="callback1" value="<?php echo $callback_class; ?>" />
	<input type="hidden" name="callback2" value="<?php echo $callback_method; ?>" />
	<input type="hidden" name="cprice" value="<?php echo $crypted_price; ?>" />
	<input type="hidden" name="langcode" value="<?php echo RL_LANG_CODE; ?>" />
	<input type="hidden" name="itemname" value="<?php echo $item_name; ?>" />
	<input type="hidden" name="acinfo" value="<?php echo $account_info['Id']; ?>" />

</form>