(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-educational_zone_options-';
		
		// Label
		function educational_zone_customizer_label( id, title ) {

			// Colors

			if ( id === 'educational_zone_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Welcome text

			if ( id === 'educational_zone_welcome_text' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'educational_zone_preloader_hide' || id === 'educational_zone_sticky_header' || id === 'educational_zone_scroll_hide' || id === 'educational_zone_products_per_row' || id === 'educational_zone_scroll_top_position' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'educational_zone_social_icon_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' || id === 'header_banner_title_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Our Course

			if ( id === 'educational_zone_section_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'educational_zone_footer_text_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'educational_zone_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'educational_zone_single_post_cat' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-educational_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

		// Colors
		educational_zone_customizer_label( 'educational_zone_theme_color', 'Theme Color' );
		educational_zone_customizer_label( 'background_color', 'Colors' );
		educational_zone_customizer_label( 'background_image', 'Image' );

		// Site Identity
		educational_zone_customizer_label( 'custom_logo', 'Logo Setup' );
		educational_zone_customizer_label( 'site_icon', 'Favicon' );

		// Welcome text
		educational_zone_customizer_label( 'educational_zone_welcome_text', 'Welcome text' );

		// General Setting
		educational_zone_customizer_label( 'educational_zone_preloader_hide', 'Preloader' );
		educational_zone_customizer_label( 'educational_zone_sticky_header', 'Sticky Header' );
		educational_zone_customizer_label( 'educational_zone_scroll_hide', 'Scroll To Top' );
		educational_zone_customizer_label('educational_zone_products_per_row', 'Woocommerce Setting');
		educational_zone_customizer_label( 'educational_zone_scroll_top_position', 'Scroll to top Position' );

		// Social Icon
		educational_zone_customizer_label( 'educational_zone_social_icon_setting', 'Social Links' );

		//Header Image
		educational_zone_customizer_label( 'header_image', 'Header Image' );
		educational_zone_customizer_label( 'header_banner_title_setting', 'Banner' );

		//Our Course
		educational_zone_customizer_label( 'educational_zone_section_title', 'Our Course' );

		//Footer
		educational_zone_customizer_label( 'educational_zone_footer_text_setting', 'Footer' );

		//Post Setting
		educational_zone_customizer_label( 'educational_zone_post_page_title', 'Post Setting' );

		//Single Post Setting
		educational_zone_customizer_label( 'educational_zone_single_post_cat', 'Single Post Setting' );
	

	});

})( jQuery );
