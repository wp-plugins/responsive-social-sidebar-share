<?php
//-- enqueue front end script and style -----------------
add_action('wp_enqueue_scripts', 'rsss_frontend_scripts');
function rsss_frontend_scripts() {	
	if(!is_admin()){
		wp_enqueue_script('jquery');
		wp_enqueue_script('rsss_front_script',plugins_url('js/rsss_front.js',__FILE__), array('jquery'));
		wp_enqueue_style('rsss_front_style',plugins_url('css/rsss_front.css',__FILE__));
	}
}

function rsss_if_intitle($f) {
	$aray = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
	foreach($aray as $a) {	$aa[] = $a["function"];	}
	if(in_array($f,$aa)) { return true; }
	return false;
}

//-- fliter the post/page title content -----------
add_filter('the_title', 'rsss_site_sidebar');
function rsss_site_sidebar($rsss_title){

	global $wpdb;
	$rss_sidebar="";
	
	$options = get_option('rsss_options');
	
	$rsss_page = $options['showonpage'];
	$rsss_post = $options['showonpost'];
	$rsss_position = $options['showonposition'];
	
	if(($rsss_post&&is_single())||($rsss_page&&is_page())){
		$rss_sidebar = show_responsive_social_share_sidebar();
	}
	if($rsss_position == 'shortcode' || !in_the_loop() || !rsss_if_intitle("the_title")){ 
		return $rsss_title;
	}
	else{  
		return $rsss_title.$rss_sidebar;
	}
	
}

function show_responsive_social_share_sidebar(){
	global $post;
	$options = get_option('rsss_options');
	
	$from_this = "http://www.wpfruits.com/downloads/wp-plugins/wp-sidebar-social-share/?rsss_refs=".$_SERVER['SERVER_NAME'];
	
	$tw = $options['show_twitter_icon'];
	$fb = $options['show_facebook_share'];
	$fbl= $options['show_facebook_like'];
	$gp = $options['show_google_plus'];
	$dg = $options['show_digg_icon'];
	$st = $options['show_stumble_icon'];
	$pi = $options['show_pinterest_icon'];
	$em = $options['show_email_icon'];
	$posit = $options['showonposition'];
	
	//if floating option is selected
	if(!empty($posit))
	{
	$dtr='<div id="rsss_sidebar">';
		if(!empty($tw))
		{
		$dtr.='<div class="ss_sidebar_button">
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</div>
			<div class="clear"></div>';
		}
		if(!empty($fb))
		{
		$dtr.='<div class="ss_sidebar_button facebook_ss_sidebar">
			<a href="http://www.facebook.com/sharer.php?u='.urlencode(get_permalink()).'&t='.get_query_var('name').'" target="blank"><img src="'.plugins_url('images/fbshare.gif',__FILE__).'" /></a>
			</div>
			<div class="clear"></div>';
		}
		if(!empty($fbl))
		{
		$dtr.='<div class="ss_sidebar_button">
			<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink()).'&amp;layout=box_count&amp;show_faces=true&amp;width=52&amp;action=like&amp;font=segoe+ui&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:52px;height:62px;" allowTransparency="true">
			</iframe></div>
			<div class="clear"></div>';
		}
		if(!empty($gp))
		{
		$dtr.='<div class="ss_sidebar_button">
			<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
			<g:plusone size="tall" href="'.urlencode(get_permalink()).'"></g:plusone>
			</div>
			<div class="clear"></div>';
		}
		if(!empty($dg))
		{
		$dtr.='<div class="ss_sidebar_button">
			<script type="text/javascript">(function() { 
			var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0]; 
			s.type = "text/javascript"; 
			s.async = true; 
			s.src = "http://widgets.digg.com/buttons.js"; 
			s1.parentNode.insertBefore(s, s1); })(); 
			</script><a class="DiggThisButton DiggMedium"></a>
			</div>
			<div class="clear"></div>';
		}
		if(!empty($pi))
		{
		$dtr.='<div class="ss_sidebar_button">
			<a href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&description='.get_query_var('name').'" class="pin-it-button" count-layout="vertical">Pin It</a>
			<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
			</div>
			<div class="clear"></div>';
		}
		if(!empty($st))
		{
		$dtr.='<div class="ss_sidebar_button"><a target="_blank"><script src="http://www.stumbleupon.com/hostedbadge.php?s=5"></script></a></div>
			<div class="clear"></div>';
		}
		if(!empty($em))
		{
		$dtr.='<div class="ss_sidebar_button ss_share_button"><a href="mailto:?subject='.get_permalink().'" >Email</a></div>
			<div class="clear"></div>';
		}
		$dtr.='<a style="display:block !important;" target="_blank" class="rsss_ficon" href="'.$from_this.'">RSSS</a>';
		
		$dtr.='
		<div class="clear"></div>';
	$dtr.='</div>';
	}

	$dtr.='<div id="rsss_sidebar_hid" style="display:';
	if(!empty($posit))
	{
	$dtr.="none";
	}
	else
	{
	$dtr.="block";
	}
	$dtr.=';">';

	if(!empty($tw))
	{
	$dtr.='<span class="ss_sidebar_button ss_sidebar_twitter">
		<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</span>';
	}
	if(!empty($fb))
	{
	$dtr.='<span class="ss_sidebar_button">
		<a href="http://www.facebook.com/sharer.php?u='.urlencode(get_permalink()).'&t='.get_query_var('name').'" target="blank"><img src="'.plugins_url('images/fbshare.gif',__FILE__).'" /></a>
		</span>';
	}
	if(!empty($fbl))
	{
	$dtr.='<span class="ss_sidebar_button ss_sidebar_facebooklike">
		<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink()).'&amp;layout=button_count&amp;show_faces=false&amp;width=60&amp;action=like&amp;font=segoe+ui&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:85px;height:21px;" allowTransparency="true">
		</iframe></span>';
	}
	if(!empty($gp))
	{
	$dtr.='<span class="ss_sidebar_button ss_sidebar_facebooklike">
			<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
			<g:plusone size="medium" href="'.urlencode(get_permalink()).'"></g:plusone>
		</span>';
	}
	if(!empty($dg))
	{
	$dtr.='<span class="ss_sidebar_button">
		<script type="text/javascript">(function() {
		var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0]; 
		s.type = "text/javascript";
		s.async = true;
		s.src = "http://widgets.digg.com/buttons.js";
		s1.parentNode.insertBefore(s, s1); })(); 
		</script>
		<a class="DiggThisButton DiggCompact"></a>
		</span>';
	}
	if(!empty($st))
	{
	$dtr.='<span class="ss_sidebar_button">
		<script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script>
		</span>';
	}
	if(!empty($pi))
	{
	$dtr.='<span class="ss_sidebar_button">
		<a href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&description='.get_query_var('name').'" class="pin-it-button" count-layout="horizontal">Pin It</a>
		<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
		</span>';
	}
	if(!empty($em))
	{
	$dtr.='<span class="ss_sidebar_button ss_share_button"><a href="mailto:?subject='.get_permalink().'" >Email</a></span>';
	}
	$dtr.='<div class="clear"></div>
	</div>';
	return $dtr;
}

//-- add shortcode to the plugin --------------
add_shortcode('responsive_social_share_sidebar', 'responsive_social_share_sidebar');
function responsive_social_share_sidebar()
{
	global $options;
	$options = get_option('rsss_options');
	$rsss_page = $options['showonpage'];
	$rsss_post = $options['showonpost'];
	$dtr="";	
		
	if(($rsss_post&&is_single())||($rsss_page&&is_page()))
	{
		$tw = $options['show_twitter_icon'];
		$fb = $options['show_facebook_share'];
		$fbl= $options['show_facebook_like'];
		$gp = $options['show_google_plus'];
		$dg = $options['show_digg_icon'];
		$st = $options['show_stumble_icon'];
		$pi = $options['show_pinterest_icon'];
		$em = $options['show_email_icon'];
		$posit = $options['showonposition'];

		if($posit=="shortcode")
		{
			$dtr.='<div id="rsss_sidebar_hid" style="display:block;">';
			
			if(!empty($tw))
			{
			$dtr.='<span class="ss_sidebar_button ss_sidebar_twitter">
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
				</span>';
			}
			if(!empty($fb))
			{
			$dtr.='<span class="ss_sidebar_button">
				<a href="http://www.facebook.com/sharer.php?u='.urlencode(get_permalink()).'&t='.get_query_var('name').'" target="blank"><img src="'.plugins_url('images/fbshare.gif',__FILE__).'" /></a>
				</span>';
			}
			if(!empty($fbl))
			{
			$dtr.='<span class="ss_sidebar_button ss_sidebar_facebooklike">
				<iframe src="http://www.facebook.com/plugins/like.php?href='.urlencode(get_permalink()).'&amp;layout=button_count&amp;show_faces=false&amp;width=60&amp;action=like&amp;font=segoe+ui&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:85px;height:21px;" allowTransparency="true">
				</iframe></span>';
			}
			if(!empty($gp))
			{
			$dtr.='<span class="ss_sidebar_button ss_sidebar_facebooklike">
					<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
					<g:plusone size="medium" href="'.urlencode(get_permalink()).'"></g:plusone>
				</span>';
			}
			if(!empty($dg))
			{
			$dtr.='<span class="ss_sidebar_button">
				<script type="text/javascript">(function() {
				var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0]; 
				s.type = "text/javascript";
				s.async = true;
				s.src = "http://widgets.digg.com/buttons.js";
				s1.parentNode.insertBefore(s, s1); })(); 
				</script>
				<a class="DiggThisButton DiggCompact"></a>
				</span>';
			}
			if(!empty($st))
			{
			$dtr.='<span class="ss_sidebar_button">
				<script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script>
				</span>';
			}
			if(!empty($pi))
			{
			$dtr.='<span class="ss_sidebar_button">
				<a href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&description='.get_query_var('name').'" class="pin-it-button" count-layout="horizontal">Pin It</a>
				<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
				</span>';
			}
			if(!empty($em))
			{
			$dtr.='<span class="ss_sidebar_button ss_share_button"><a href="mailto:?subject='.get_permalink().'" >Email</a></span>';
			}
			$dtr.='<div class="clear"></div>
			</div>';
		}
	}	
	return $dtr;
}
?>