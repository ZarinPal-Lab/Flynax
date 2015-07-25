<!-- zarrinpal Plugin  -->

<li id="gateway_zarrinpal">
	<img alt="{$lang.zarrinpal_payment}" src="{$smarty.const.RL_PLUGINS_URL}zarrinpal/static/zarrinpal.png" />
	<p><input {if $smarty.post.gateway == 'zarrinpal'}checked="checked"{/if} type="radio" name="gateway" value="zarrinpal" /></p>
</li>

<!-- end zarrinpal Plugin --> 