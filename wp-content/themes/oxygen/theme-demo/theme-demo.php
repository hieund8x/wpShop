<?php
/**
 *	Oxygen WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

function labdemo_active($cookie_name, $equal_to = '')
{
	if(is_array($equal_to))
	{
		return in_array(cookie($cookie_name), $equal_to) ? ' class="active"' : '';
	}
	
	if(strstr($cookie_name, ','))
	{
		$cookie_name = explode(",", $cookie_name);
		$equal_to = explode(",", $equal_to);
		
		$all_requals = true;
		
		foreach($cookie_name as $i => $cookie_name_entry)
		{
			if(cookie($cookie_name_entry) != $equal_to[$i])
			{
				$all_requals = false;
			}
		}
		
		return $all_requals ? ' class="active"' : '';
	}
	
	return cookie($cookie_name) == "{$equal_to}" ? ' class="active"' : '';
}

add_action('wp_enqueue_scripts', function()
{
	wp_enqueue_script('demo-js', THEMEURL . 'theme-demo/demo.js', null, null, true);
	wp_enqueue_style('demo-css', THEMEURL . 'theme-demo/demo.css', null, null);
});


add_filter('get_data_header_type', function($value)
{
	$header_type = isset($_GET['header_type']) ? $_GET['header_type'] : (isset($_COOKIE['header_type']) ? $_COOKIE['header_type'] : '');
	
	if($header_type)
	{
		switch($header_type)
		{
			case "1":
				return "1";
				break;
				
			case "2":
				return "2";
				break;
				
			case "2-gray":
				return "2-gray";
				break;
				
			case "3":
				return "3";
				break;
				
			case "4":
				return "4";
				break;
		}
	}
	
	return $value;
});


add_filter('get_data_shop_sidebar', function($value)
{
	if($shop_sidebar = get('shop_sidebar'))
	{
		if($shop_sidebar == 'right')
			return "Show Sidebar on Right";
			
		if($shop_sidebar == 'left')
			return "Show Sidebar on Left";
	}
	
	return $value;
});


add_filter('get_data_shop_single_sidebar', function($value)
{
	if(cookie('shop_single_sidebar'))
	{
		return cookie('shop_single_sidebar');
	}
	
	return $value;
});


add_filter('get_data_cart_ribbon_image', function($value)
{
	if(cookie('cart_ribbon_image'))
	{
		return cookie('cart_ribbon_image');
	}
	
	return $value;
});


add_filter('get_data_shop_item_preview_type', function($value)
{
	if(cookie('shop_item_preview_type'))
	{
		return cookie('shop_item_preview_type');
	}
	
	return $value;
});


add_filter('get_data_blog_sidebar_position', function($value)
{
	if(cookie('blog_sidebar_position'))
	{
		return cookie('blog_sidebar_position');
	}
	
	return $value;
});


add_filter('get_data_sidebar_menu_position', function($value)
{
	if(cookie('menu_position') && cookie('menu_position') == 'right')
	{
		return '0';
	}
	
	return $value;
});


add_filter('get_data_sidebar_menu_links_display', function($value)
{
	if(cookie('menu_expanded'))
	{
		switch(cookie('menu_expanded'))
		{
			case "1":
				return "Expanded";
		
			case "1":
				return "Collapsed";	
		}
	}
	
	return $value;
});


# Font
$font_type = isset($_COOKIE['font_type']) ? $_COOKIE['font_type'] : '';

switch($font_type)
{
	case "Arimo:Arvo":
		add_filter('get_data_font_primary',   function(){ return "Arimo"; });
		add_filter('get_data_font_secondary', function(){ return "Arvo"; });
		add_filter('get_data_font_size_base', function(){ return 12; });
		break;
		
		
	case "OpenSans:RobotoSlab":
		add_filter('get_data_font_primary',   function(){ return "Open Sans"; });
		add_filter('get_data_font_secondary', function(){ return "Roboto Slab"; });
		add_filter('get_data_font_size_base', function(){ return 12; });
		break;
		
		
	case "PTSans:Raleway":
		add_filter('get_data_font_primary',   function(){ return "PT Sans"; });
		add_filter('get_data_font_secondary', function(){ return "Raleway"; });
		add_filter('get_data_font_size_base', function(){ return 12; });
		break;
}


add_action('wp_footer', function()
{
	if($header_type = get('header_type')):
		
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				Cookies.set('header_type', '<?php echo $header_type; ?>');
			});
		</script>
		<?php
		
	endif;
	
	$product_url = get_permalink(225);
	
	$blog_url = home_url("blog/");
	
	$cart_icon_1 = THEMEASSETS . 'images/cart-icon-1-black.png';
	$cart_icon_2 = THEMEASSETS . 'images/cart-icon-2-black.png';
	$cart_icon_3 = THEMEASSETS . 'images/cart-icon-3-black.png';
	$cart_icon_4 = THEMEASSETS . 'images/cart-icon-4-black.png';
	
	?>
	<div class="theme-switcher-overlay">
		<div class="loader">
			<strong><?php _e('Loading...', TD); ?></strong>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	
	<section class="theme-switcher<?php echo cookie('ts_open') == 1 ? ' open' : ''; ?>">
		
		<a href="#" class="toggle"></a>
		
		<div class="ts-inner">
		
			<h2>Customize Theme</h2>
			
			<h3>Header Type</h3>
			
			<ul>
				<li>
					<a href="#"<?php echo labdemo_active('header_type', array(2, '2-gray', 3, 4)); ?>>
						<i class="entypo-down-open"></i>
						Top Menu
					</a>
					
					<ul>
						<li>
							<a href="<?php echo get('header_type') ? home_url() : '#'; ?>" data-prop="header_type" data-value="2"<?php echo labdemo_active('header_type', 2); ?>>Bottom Nav (White)</a>
						</li>
						<li>
							<a href="<?php echo get('header_type') ? home_url() : '#'; ?>" data-prop="header_type" data-value="2-gray"<?php echo labdemo_active('header_type', '2-gray'); ?>>Bottom Nav (Grey)</a>
						</li>
						<li>
							<a href="<?php echo get('header_type') ? home_url() : '#'; ?>" data-prop="header_type" data-value="3"<?php echo labdemo_active('header_type', 3); ?>>Right Nav</a>
						</li>
						<li>
							<a href="<?php echo get('header_type') ? home_url() : '#'; ?>" data-prop="header_type" data-value="4"<?php echo labdemo_active('header_type', 4); ?>>Centered Nav</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"<?php echo labdemo_active('header_type', 1); ?>>
						<i class="entypo-down-open"></i>
						Sidebar Menu
					</a>
					
					<ul>
						<li>
							<a href="#"<?php echo labdemo_active('menu_position', 'left'); ?>>
								<i class="entypo-down-open"></i>
								Left Menu
							</a>
							
							<ul>
								<li>
									<a href="#" data-prop="header_type,menu_expanded,menu_position" data-value="1,0,left"<?php echo labdemo_active('header_type,menu_expanded,menu_position', '1,0,left'); ?>>Collapsed Submenus</a>
								</li>
								<li>
									<a href="#" data-prop="header_type,menu_expanded,menu_position" data-value="1,1,left"<?php echo labdemo_active('header_type,menu_expanded,menu_position', '1,1,left'); ?>>Expanded Submenus</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#"<?php echo labdemo_active('menu_position', 'right'); ?>>
								<i class="entypo-down-open"></i>
								Right Menu
							</a>
							
							<ul>
								<li>
									<a href="#" data-prop="header_type,menu_expanded,menu_position" data-value="1,0,right"<?php echo labdemo_active('header_type,menu_expanded,menu_position', '1,0,right'); ?>>Collapsed Submenus</a>
								</li>
								<li>
									<a href="#" data-prop="header_type,menu_expanded,menu_position" data-value="1,1,right"<?php echo labdemo_active('header_type,menu_expanded,menu_position', '1,1,right'); ?>>Expanded Submenus</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			
			<h3>Shop</h3>
			
			<ul>
				<li>
					<a href="#"<?php echo labdemo_active('shop_item_preview_type', array('Product Gallery Slider', 'Second Image on Hover', 'None')); ?>>
						<i class="entypo-down-open"></i>
						On Product Hover
					</a>
					
					<ul>
						<li>
							<a href="<?php echo SHOPURL; ?>" data-prop="shop_item_preview_type" data-value="Product Gallery Slider"<?php echo labdemo_active('shop_item_preview_type', 'Product Gallery Slider'); ?>>Product Gallery Slider</a>
						</li>
						<li>
							<a href="<?php echo SHOPURL; ?>" data-prop="shop_item_preview_type" data-value="Second Image on Hover"<?php echo labdemo_active('shop_item_preview_type', 'Second Image on Hover'); ?>>Second Image on Hover</a>
						</li>
						<li>
							<a href="<?php echo SHOPURL; ?>" data-prop="shop_item_preview_type" data-value="None"<?php echo labdemo_active('shop_item_preview_type', 'None'); ?>>No Hover Effect</a>
						</li>
					</ul>
				</li>
				
				<li>
					<a href="#"<?php echo labdemo_active('shop_single_sidebar', array('Show Sidebar on Right', 'Show Sidebar on Left', 'Hide Sidebar')); ?>>
						<i class="entypo-down-open"></i>
						Single Product
					</a>
					
					<ul>
						<li>
							<a href="<?php echo $product_url; ?>" data-prop="shop_single_sidebar" data-value="Show Sidebar on Right"<?php echo labdemo_active('shop_single_sidebar', 'Show Sidebar on Right'); ?>>Show Sidebar on Right</a>
						</li>
						<li>
							<a href="<?php echo $product_url; ?>" data-prop="shop_single_sidebar" data-value="Show Sidebar on Left"<?php echo labdemo_active('shop_single_sidebar', 'Show Sidebar on Left'); ?>>Show Sidebar on Left</a>
						</li>
						<li>
							<a href="<?php echo $product_url; ?>" data-prop="shop_single_sidebar" data-value="Hide Sidebar"<?php echo labdemo_active('shop_single_sidebar', 'Hide Sidebar'); ?>>Show No Sidebar</a>
						</li>
					</ul>
				</li>
				
				<li>
					<a href="#"<?php echo labdemo_active('cart_ribbon_image', array($cart_icon_1, $cart_icon_2, $cart_icon_3, $cart_icon_4)); ?>>
						<i class="entypo-down-open"></i>
						Cart Ribbon Icon
					</a>
					
					<ul>
						<li>
							<a href="#" data-prop="cart_ribbon_image" data-value="<?php echo $cart_icon_1; ?>"<?php echo labdemo_active('cart_ribbon_image', $cart_icon_1); ?>>Icon 1</a>
						</li>
						<li>
							<a href="#" data-prop="cart_ribbon_image" data-value="<?php echo $cart_icon_2; ?>"<?php echo labdemo_active('cart_ribbon_image', $cart_icon_2); ?>>Icon 2</a>
						</li>
						<li>
							<a href="#" data-prop="cart_ribbon_image" data-value="<?php echo $cart_icon_3; ?>"<?php echo labdemo_active('cart_ribbon_image', $cart_icon_3); ?>>Icon 3</a>
						</li>
						<li>
							<a href="#" data-prop="cart_ribbon_image" data-value="<?php echo $cart_icon_4; ?>"<?php echo labdemo_active('cart_ribbon_image', $cart_icon_4); ?>>Icon 4</a>
						</li>
					</ul>
				</li>
			</ul>
			
			<h3>Blog</h3>
			
			<ul>
				<li>
					<a href="#"<?php echo labdemo_active('blog_sidebar_position', array('Right', 'Left', 'Hide')); ?>>
						<i class="entypo-down-open"></i>
						Blog Sidebar
					</a>
					
					<ul>
						<li>
							<a href="<?php echo $blog_url; ?>" data-prop="blog_sidebar_position" data-value="Right"<?php echo labdemo_active('blog_sidebar_position', 'Right'); ?>>Show Sidebar on Right</a>
						</li>
						<li>
							<a href="<?php echo $blog_url; ?>" data-prop="blog_sidebar_position" data-value="Left"<?php echo labdemo_active('blog_sidebar_position', 'Left'); ?>>Show Sidebar on Left</a>
						</li>
						<li>
							<a href="<?php echo $blog_url; ?>" data-prop="blog_sidebar_position" data-value="Hide"<?php echo labdemo_active('blog_sidebar_position', 'Hide'); ?>>Show No Sidebar</a>
						</li>
					</ul>
				</li>
			</ul>
			
			<h3>Typography <span>New</span></h3>
			
			<ul>
				<li>
					<a href="#" data-prop="font_type" data-value=""<?php echo labdemo_active('font_type', ''); ?>>Roboto + Roboto Condensed</a>
				</li>
				
				<li>
					<a href="#" data-prop="font_type" data-value="Arimo:Arvo"<?php echo labdemo_active('font_type', 'Arimo:Arvo'); ?>>Arimo + Arvo</a>
				</li>
				
				<li>
					<a href="#" data-prop="font_type" data-value="OpenSans:RobotoSlab"<?php echo labdemo_active('font_type', 'OpenSans:RobotoSlab'); ?>>Open Sans + Roboto Slab</a>
				</li>
				
				<li>
					<a href="#" data-prop="font_type" data-value="PTSans:Raleway"<?php echo labdemo_active('font_type', 'PTSans:Raleway'); ?>>PT Sans + Raleway</a>
				</li>
			</ul>
			
			<a href="#" class="reset" data-vars="ts_open,blog_sidebar_position,cart_ribbon_image,shop_single_sidebar,shop_item_preview_type,header_type,menu_expanded,menu_position,font_type">Reset All Styles</a>
		
		</div>
		
	</section>
	<?php
});