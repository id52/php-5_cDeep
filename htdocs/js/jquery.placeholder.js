/**
 * jQuery Placeholder 2.2.2 - jQuery plugin
 * 
 * Copyright (c) 2010 Pavel Virskiy - me@pashinblog.ru http://pashinblog.ru 
 * 
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 * 
 * To enable, simply set attribute "placeholder" for default value.
 *
 * Example: <input type="text" class="someClassForInput" placeholder="Default value" />
 *
 */
$(function(){
	if ($.browser.safari) return; // Webkit has own placeholder, so we are free
	
	$('<style>.jqueryPlaceholder{color:#a9a9a9!important;}</style>').appendTo('head'); // Create placeholder class
	
	$('input[placeholder]').each(function(){ //Processing placeholders for input.texts
		if($(this).val() == '' || $(this).val() == $(this).attr('placeholder')){ // (Mozzi refresh fix)
			$(this)
				.addClass('jqueryPlaceholder')
				.val($(this).attr('placeholder'));
		}
		
		$(this).focus(function(){
			if($(this).val() == $(this).attr('placeholder')){
				$(this)
					.removeClass('jqueryPlaceholder')
					.val('');
			}
		});
		
		$(this).blur(function(){
			if($(this).val() == ''){
				$(this)
					.addClass('jqueryPlaceholder')
					.val($(this).attr('placeholder'));
			}
		});
	});
	
	$('textarea[placeholder]').each(function(){ //Processing placeholders for textareas
		if(this.value == '' || this.value == $(this).attr('placeholder')){ // (Mozzi refresh fix)
			$(this).addClass('jqueryPlaceholder');
			this.value = $(this).attr('placeholder');
		};
		$(this).focus(function(){
			if(this.value == $(this).attr('placeholder')){
				$(this).removeClass('jqueryPlaceholder');
				this.value = '';
			}
		});
		$(this).blur(function(){
			if(this.value == ''){
				$(this).addClass('jqueryPlaceholder');
				this.value = $(this).attr('placeholder');
			}
		});
	});
	
	$('form').each(function(){ //Processing "clear on submit"
		$(this).submit(function(){
			$(this).find("input").each(function(){
				if($(this).val() == $(this).attr('placeholder')) $(this).val('');
			});
			$(this).find("textarea").each(function(){
				if(this.value == $(this).attr('placeholder')) this.value = '';
			});
		});				
	});
});