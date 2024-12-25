<?php
/**
 * Educational Zone Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Educational Zone
 */

if ( ! defined( 'EDUCTIONAL_ZONE_URL' ) ) {
define('EDUCTIONAL_ZONE_URL',__('https://www.themagnifico.net/themes/education-wordpress-theme','educational-zone'));
}
if ( ! defined( 'EDUCTIONAL_ZONE_BUY_TEXT' ) ) {
    define( 'EDUCTIONAL_ZONE_BUY_TEXT', __( 'Buy Education Zone Pro','educational-zone' ));
}

use WPTRT\Customize\Section\Educational_Zone_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Educational_Zone_Button::class );

    $manager->add_section(
        new Educational_Zone_Button( $manager, 'educational_zone_pro', [
            'title'       => __( 'Education Zone Pro', 'educational-zone' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'educational-zone' ),
            'button_url'  => esc_url( 'https://www.themagnifico.net/themes/education-wordpress-theme', 'educational-zone')
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'educational-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'educational-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function educational_zone_customize_register($wp_customize){

    // Pro Version
    class Educational_Zone_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( EDUCTIONAL_ZONE_BUY_TEXT,'educational-zone' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Educational_Zone_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {

        // Site title
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title',
            'render_callback' => 'educational_zone_customize_partial_blogname',
        ));
    }

    $wp_customize->add_setting('educational_zone_logo_title', array(
        'default' => true,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_logo_title',array(
        'label'          => __( 'Enable Disable Title', 'educational-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'educational_zone_logo_title',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('educational_zone_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'educational-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'educational_zone_theme_description',
        'type'           => 'checkbox',
    )));

    //Logo
    $wp_customize->add_setting('educational_zone_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'educational_zone_sanitize_number_absint'
    ));
    $wp_customize->add_control('educational_zone_logo_max_height',array(
        'label' => esc_html__('Logo Width','educational-zone'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    // General Settings
     $wp_customize->add_section('educational_zone_general_settings',array(
        'title' => esc_html__('General Settings','educational-zone'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('educational_zone_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'educational-zone' ),
        'section'        => 'educational_zone_general_settings',
        'settings'       => 'educational_zone_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'educational_zone_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educational_zone_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','educational-zone'),
        'section' => 'educational_zone_general_settings',
        'settings' => 'educational_zone_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'educational_zone_preloader_dot_1_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educational_zone_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','educational-zone'),
        'section' => 'educational_zone_general_settings',
        'settings' => 'educational_zone_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'educational_zone_preloader_dot_2_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educational_zone_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','educational-zone'),
        'section' => 'educational_zone_general_settings',
        'settings' => 'educational_zone_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('educational_zone_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'educational-zone' ),
        'section'        => 'educational_zone_general_settings',
        'settings'       => 'educational_zone_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('educational_zone_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'educational_zone_sanitize_choices'
    ));
    $wp_customize->add_control('educational_zone_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'educational_zone_general_settings',
        'choices' => array(
            'Right' => __('Right','educational-zone'),
            'Left' => __('Left','educational-zone'),
            'Center' => __('Center','educational-zone')
        ),
    ) );

    $wp_customize->add_setting('educational_zone_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'educational-zone' ),
        'section'        => 'educational_zone_general_settings',
        'settings'       => 'educational_zone_sticky_header',
        'type'           => 'checkbox',
    )));

    // Product Columns
    $wp_customize->add_setting( 'educational_zone_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'educational_zone_sanitize_select',
    ) );

    $wp_customize->add_control('educational_zone_products_per_row', array(
        'label' => __( 'Product per row', 'educational-zone' ),
        'section'  => 'educational_zone_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('educational_zone_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'educational_zone_sanitize_float'
    ));
    $wp_customize->add_control('educational_zone_product_per_page',array(
        'label' => __('Product per page','educational-zone'),
        'section'   => 'educational_zone_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('educational_zone_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'educational-zone' ),
        'section'        => 'educational_zone_general_settings',
        'settings'       => 'educational_zone_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('educational_zone_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'educational_zone_sanitize_choices'
    ));
    $wp_customize->add_control('educational_zone_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','educational-zone'),
        'section' => 'educational_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','educational-zone'),
            'Right Sidebar' => __('Right Sidebar','educational-zone'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('educational_zone_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'educational-zone' ),
        'section'        => 'educational_zone_general_settings',
        'settings'       => 'educational_zone_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('educational_zone_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'educational_zone_sanitize_choices'
    ));
    $wp_customize->add_control('educational_zone_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','educational-zone'),
        'section' => 'educational_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','educational-zone'),
            'Right Sidebar' => __('Right Sidebar','educational-zone'),
        ),
    ) );

     // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'educational_zone_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

    // Theme Color
    $wp_customize->add_section('educational_zone_color_option',array(
        'title' => esc_html__('Theme Color','educational-zone'),
    ));

    $wp_customize->add_setting( 'educational_zone_theme_color', array(
        'default' => '#003e7d',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educational_zone_theme_color', array(
        'label' => esc_html__('Color Option','educational-zone'),
        'section' => 'educational_zone_color_option',
        'settings' => 'educational_zone_theme_color'
    )));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_theme_color', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_theme_color', array(
        'section'     => 'educational_zone_color_option',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

    //welcome text
    $wp_customize->add_section('educational_zone_welcome_textmessage',array(
        'title' => esc_html__('Welcome text ','educational-zone'),
    ));

    $wp_customize->add_setting('educational_zone_welcome_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('educational_zone_welcome_text',array(
        'label' => esc_html__('Welcome text','educational-zone'),
        'section' => 'educational_zone_welcome_textmessage',
        'setting' => 'educational_zone_welcome_text',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_welcome_text_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_welcome_text_setting', array(
        'section'     => 'educational_zone_welcome_textmessage',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

    //social icons
    $wp_customize->add_section('educational_zone_social_icons',array(
        'title' => esc_html__('Social Icons ','educational-zone'),
    ));

    $wp_customize->add_setting('educational_zone_social_icon_setting', array(
        'default' => 0,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'educational_zone_social_icon_setting',array(
        'label'          => __( 'Enable Social Icon', 'educational-zone' ),
        'section'        => 'educational_zone_social_icons',
        'settings'       => 'educational_zone_social_icon_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('educational_zone_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('educational_zone_facebook_url',array(
        'label' => esc_html__('Facebook link','educational-zone'),
        'section' => 'educational_zone_social_icons',
        'setting' => 'educational_zone_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('educational_zone_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('educational_zone_twitter_url',array(
        'label' => esc_html__('Twitter link','educational-zone'),
        'section' => 'educational_zone_social_icons',
        'setting' => 'educational_zone_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('educational_zone_youtube_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('educational_zone_youtube_url',array(
        'label' => esc_html__('Youtube link','educational-zone'),
        'section' => 'educational_zone_social_icons',
        'setting' => 'educational_zone_youtube_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('educational_zone_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('educational_zone_linkedin_url',array(
        'label' => esc_html__('Linkedin link','educational-zone'),
        'section' => 'educational_zone_social_icons',
        'setting' => 'educational_zone_linkedin_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'educational_zone_social_icons',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

    // Banner title
    $wp_customize->add_setting('header_banner_title_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_banner_title_setting', array(
        'label' => __('Banner Title', 'educational-zone'),
        'section' => 'header_image',
        'settings' => 'header_banner_title_setting',
        'type' => 'text'
    )));

    // Banner description
    $wp_customize->add_setting('header_banner_description_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_banner_description_setting', array(
        'label' => __('Banner description', 'educational-zone'),
        'section' => 'header_image',
        'settings' => 'header_banner_description_setting',
        'type' => 'text'
    )));

    // Banner button
    $wp_customize->add_setting('header_banner_button_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'header_banner_button_setting', array(
        'label' => __('Banner button link', 'educational-zone'),
        'section' => 'header_image',
        'settings' => 'header_banner_button_setting',
        'type' => 'url'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_banner_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_banner_setting', array(
        'section'     => 'header_image',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

    //Our Services section
    $wp_customize->add_section( 'educational_zone_services_section' , array(
        'title'      => __( 'Our Course Settings', 'educational-zone' ),
        'priority'   => null
    ) );

    $wp_customize->add_setting('educational_zone_section_title',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('educational_zone_section_title',array(
        'label' => __('Add Section Title','educational-zone'),
        'input_attrs' => array(
            'placeholder' => __( 'Our Course', 'educational-zone' ),
        ),
        'section'=> 'educational_zone_services_section',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('educational_zone_section_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('educational_zone_section_text',array(
        'label' => __('Add Section Text','educational-zone'),
        'input_attrs' => array(
            'placeholder' => __( 'Lorem ipsum is dummy text', 'educational-zone' ),
        ),
        'section'=> 'educational_zone_services_section',
        'type'=> 'text'
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('educational_zone_our_services',array(
        'default'   => 'select',
        'sanitize_callback' => 'educational_zone_sanitize_choices',
    ));
    $wp_customize->add_control('educational_zone_our_services',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Services','educational-zone'),
        'description' => __('Image Size (50 x 50)','educational-zone'),
        'section' => 'educational_zone_services_section',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_services_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_services_setting', array(
        'section'     => 'educational_zone_services_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));


    // Footer
    $wp_customize->add_section('educational_zone_site_footer_section', array(
        'title' => esc_html__('Footer', 'educational-zone'),
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('educational_zone_footer_text_setting', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('educational_zone_footer_text_setting', array(
        'label' => __('Replace the footer text', 'educational-zone'),
        'section' => 'educational_zone_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('educational_zone_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'educational_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control('educational_zone_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','educational-zone'),
        'section' => 'educational_zone_site_footer_section',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Educational_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Educational_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'educational_zone_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'educational-zone' ),
        'description' => esc_url( EDUCTIONAL_ZONE_URL ),
        'priority'    => 100
    )));

     // Post Settings
     $wp_customize->add_section('educational_zone_post_settings',array(
        'title' => esc_html__('Post Settings','educational-zone'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('educational_zone_post_page_title',array(
        'sanitize_callback' => 'educational_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('educational_zone_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'educational-zone'),
        'section'     => 'educational_zone_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'educational-zone'),
    ));

    $wp_customize->add_setting('educational_zone_post_page_meta',array(
        'sanitize_callback' => 'educational_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('educational_zone_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'educational-zone'),
        'section'     => 'educational_zone_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'educational-zone'),
    ));

    $wp_customize->add_setting('educational_zone_post_page_thumb',array(
        'sanitize_callback' => 'educational_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('educational_zone_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'educational-zone'),
        'section'     => 'educational_zone_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'educational-zone'),
    ));

    $wp_customize->add_setting('educational_zone_single_post_cat',array(
        'sanitize_callback' => 'educational_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('educational_zone_single_post_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Category and Tags', 'educational-zone'),
        'section'     => 'educational_zone_post_settings',
        'description' => esc_html__('Check this box to enable post category and tags on single post.', 'educational-zone'),
    ));
}

add_action('customize_register', 'educational_zone_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function educational_zone_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function educational_zone_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function educational_zone_customize_preview_js()
{
    wp_enqueue_script('educational-zone-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'educational_zone_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function educational_zone_panels_js() {
    wp_enqueue_style( 'educational-zone-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'educational-zone-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'educational_zone_panels_js' );

