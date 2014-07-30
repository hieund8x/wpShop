/*
	Oxygen Theme Switcher
*/

;(function($, window, undefined)
{
	$(document).ready(function()
	{
		var $theme_switcher = $(".theme-switcher"),
			$theme_switcher_ol = $(".theme-switcher-overlay"),
			$reset = $theme_switcher.find('.reset'),
			$last_opened = null;
		
		$theme_switcher.find(".toggle").on('click', function(ev)
		{
			ev.preventDefault();
			
			$theme_switcher.toggleClass('open');
			
			Cookies.set('ts_open', $theme_switcher.hasClass('open') ? 1 : -1);
		});
		
		$theme_switcher.find("ul li:has(ul)").each(function(i, el)
		{
			var $li 	= $(el),
				$a      = $li.find('> a'),
				$ul     = $li.find('> ul');
			
			$a.on('click', function(ev)
			{
				ev.preventDefault();
				
				$li.parent().children().not($li).each(function(i, el)
				{
					$(el).removeClass('opened');
					$(el).find('> ul').slideUp('fast');
				});
				
				$ul.stop().slideToggle('fast');
				$li.toggleClass('opened');
			});
		});
		
		$theme_switcher.find('a[data-prop][data-value]').click(function(ev)
		{
			ev.preventDefault();
			
			showLoading();
			
			var $this = $(this),
				href = $this.attr('href'),
				prop = $this.data('prop').toString(),
				value = $this.data('value').toString();
			
			if(prop)
			{	
				prop = prop.split(',');
				value = value.split(',');
				
				for(var i=0; i<prop.length; i++)
				{
					Cookies.set(prop[i], value[i]);
				}
				
				if(href == '#')
				{
					location.reload();
				}
				else
				{
					window.location.href = href;
				}
			}
		});
		
		$reset.click(function(ev)
		{
			ev.preventDefault();
			
			showLoading();
			
			var values = $(this).data('vars').split(',');
			
			$.each(values, function(i, val)
			{
				Cookies.set(val, '');
			});
			
			location.reload();
		});
		
		var showLoading = function()
		{
			$theme_switcher_ol.fadeIn('fast');
		};
	});
	
})(jQuery, window);