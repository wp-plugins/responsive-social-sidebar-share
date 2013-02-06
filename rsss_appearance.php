<div class="wrap pc-wrap">
	<?php global $rsss_savemsg; ?>
	<div class="rsssicon icon32"></div>
	<h2><?php _e('Responsive Social Share Sidebar '.rsss_get_version().' Setting\'s','rsss') ?></h2>
	<?php
		if (!current_user_can('edit_plugins')) { 
			_e('You do not have sufficient permissions to manage plugins on this blog.<br>','rsss');
			return;
		}
	?>
	<div id="rsss_block">
		<?php if($rsss_savemsg){ _e($rsss_savemsg,'rsss'); } ?>
		<!-- Install Plugins From Wordpress Site -->
		<div id="poststuff" class="rsss-meta-box">
			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3 class="hndle"><span><?php _e('General Settings :', 'rsss'); ?></span></h3>
				<div class="inside">
					<form name="rsss_adminform" method="post" action="options.php">
					<?php settings_fields('rsss_plugin_options'); ?>
					<?php $options = get_option('rsss_options'); ?>
						<table class="rsss_tbl">
							<tr>
								<td><label for="showonpage"><?php _e('Show on Page','rsss'); ?></label></td>
								<td><input type="checkbox" id="showonpage" name="rsss_options[showonpage]" value="1" <?php if($options['showonpage']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="showonpost"><?php _e('Show on Post','rsss'); ?></label></td>
								<td><input type="checkbox" id="showonpost" name="rsss_options[showonpost]" value="1" <?php if($options['showonpost']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><?php _e('Position','rsss'); ?></td>
								<td style="line-height:24px;">
									<input type="radio" id="rsss_floating" name="rsss_options[showonposition]" value="1" <?php if($options['showonposition']==1){ echo "checked=checked"; } ?> />&nbsp;<label for="rsss_floating"><?php _e('FLOATING','rsss'); ?></label><br/>
									<input type="radio" id="rsss_bfcont" name="rsss_options[showonposition]" value="0" <?php if($options['showonposition']==0){ echo "checked=checked"; } ?> />&nbsp;<label for="rsss_bfcont"><?php _e('AFTER TITLE','rsss'); ?></label><br/>
									<input type="radio" id="rsss_usecode" name="rsss_options[showonposition]" value="shortcode" <?php if($options['showonposition']=='shortcode'){ echo "checked=checked"; } ?> />&nbsp;<label for="rsss_usecode"><?php _e('USE CODE','rsss'); ?></label>
								</td>
							</tr>
							<tr>
								<td></td>
								<td class="rsss_note"><?php _e('Note: If you select "USE CODE" option then add shortcode <br/><b>[responsive_social_share_sidebar]</b> in page or post or <br/>use php code inside post loop <br/><b>&#60;&#63;php if (function_exists(\'responsive_social_share_sidebar\')) { echo responsive_social_share_sidebar(); } &#63;&#62;</b><br/>','rsss'); ?></td></tr>
							<tr>
								<td><label for="show_twitter_icon"><?php _e('Show Twitter Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_twitter_icon" name="rsss_options[show_twitter_icon]" value="1" <?php if($options['show_twitter_icon']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_facebook_share"><?php _e('Show Facebook Icon (share)','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_facebook_share" name="rsss_options[show_facebook_share]" value="1" <?php if($options['show_facebook_share']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_facebook_like"><?php _e('Show Facebook Icon (Like)','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_facebook_like" name="rsss_options[show_facebook_like]" value="1" <?php if($options['show_facebook_like']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_google_plus"><?php _e('Show Google Pluse Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_google_plus" name="rsss_options[show_google_plus]" value="1" <?php if($options['show_google_plus']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_digg_icon"><?php _e('Show Digg Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_digg_icon" name="rsss_options[show_digg_icon]" value="1" <?php if($options['show_digg_icon']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_stumble_icon"><?php _e('Show Stumbleupon Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_stumble_icon" name="rsss_options[show_stumble_icon]" value="1" <?php if($options['show_stumble_icon']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_pinterest_icon"><?php _e('Show Pinterest Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_pinterest_icon" name="rsss_options[show_pinterest_icon]" value="1" <?php if($options['show_pinterest_icon']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<tr>
								<td><label for="show_email_icon"><?php _e('Show Email Icon','rsss'); ?></label></td>
								<td><input type="checkbox" id="show_email_icon" name="rsss_options[show_email_icon]" value="1" <?php if($options['show_email_icon']){ echo "checked=checked"; } ?> /></td>
							</tr>
							<input type="hidden" name="rsss_saveOptions" value="rsss_save" />
							<tr><td colspan="2" height="5"></td></tr>
							<tr><td><input type="submit" name="rsss_submit" class="button-primary button" value="Save Settings"/></td></tr>
						</table>
					</form>
				</div>
			</div>		
		</div>
		<iframe frameborder="1" class="rsss_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/rsss/rsss.php" width="250px" height="430px" scrolling="no" ></iframe> 	
	</div>	
</div>	