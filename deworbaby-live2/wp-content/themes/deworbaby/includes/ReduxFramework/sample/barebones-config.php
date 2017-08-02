<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "deworbaby_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    /*$args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );*/

    // Panel Intro text -> before the form
    /*if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );*/

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'  => __( 'General Settings', 'redux-framework-demo' ),
        'id'     => 'general-setting',
        'desc'   => __( 'General settings section for your site', 'redux-framework-demo' ),
        'icon'   => 'el el-cog',
        'fields' => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => __( 'Logo for your website', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'instagram_text',
                'type'     => 'text',
                'title'    => __( 'Instagram caption', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'instagram_profile_link',
                'type'     => 'text',
                'title'    => __( 'Instagram profile link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'copyright',
                'type'     => 'text',
                'title'    => __( 'Copyright information', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'get_in_touch_mail',
                'type'     => 'text',
                'title'    => __( 'Email Address (Get in Touch) ', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'whole_sale_link',
                'type'     => 'text',
                'title'    => __( 'Interest in Wholesale (Link)', 'redux-framework-demo' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Banner Settings', 'redux-framework-demo' ),
        'id'    => 'banner-settings',
        'desc'  => __( 'Banner settings section for your site', 'redux-framework-demo' ),
        'icon'  => 'el el-photo',
        'fields'     => array(
            array(
                'id'       => 'banner_image',
                'type'     => 'media',
                'title'    => __( 'Banner image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'banner_content',
                'type'     => 'editor',
                'title'    => __( 'Banner content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'banner_btn_text',
                'type'     => 'text',
                'title'    => __( 'Button text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'banner_btn_link',
                'type'     => 'text',
                'title'    => __( 'Button link', 'redux-framework-demo' ),
            ),            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Social Media', 'redux-framework-demo' ),
        'id'    => 'social-settings',
        'desc'  => __( 'Social media links for your site', 'redux-framework-demo' ),
        'icon'  => 'el el-globe',
        'fields'     => array(
            array(
                'id'       => 'display_social',
                'type'     => 'radio',
                'title'    => __( 'Display social media links?', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Yes', 
                    '2' => 'No'
                ),
                'default' => '1'
            ),

            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => __( 'Pinterest link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => __( 'Facebook link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => __( 'Twitter link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => __( 'Instagram link', 'redux-framework-demo' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Our Diapers', 'redux-framework-demo' ),
        'id'    => 'diaper-settings',
        'desc'  => __( 'Our diapers section', 'redux-framework-demo' ),
        'icon'  => 'el el-child',
        'fields'     => array(
            array(
                'id'       => 'diaper_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'diaper_button_text',
                'type'     => 'text',
                'title'    => __( 'Button text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'diaper_button_link',
                'type'     => 'text',
                'title'    => __( 'Button link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'diaper_section_image',
                'type'     => 'media',
                'title'    => __( 'Diaper image', 'redux-framework-demo' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Shop Settings', 'redux-framework-demo' ),
        'id'    => 'shop-msg-settings',
        'desc'  => __( 'Home page shop message', 'redux-framework-demo' ),
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'shop_msg_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_msg_content',
                'type'     => 'editor',
                'title'    => __( 'Brief content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_msg_button_text',
                'type'     => 'text',
                'title'    => __( 'Button text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_msg_button_link',
                'type'     => 'text',
                'title'    => __( 'Button link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_size_chart',
                'type'     => 'media',
                'title'    => __( 'Size Chart', 'redux-framework-demo' ),
                'description'    => __( 'This size chart will be displayed in single product page', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_size_chart_text',
                'type'     => 'text',
                'title'    => __( 'Size Chart link text', 'redux-framework-demo' ),
                'description'    => __( 'This size chart will be displayed in single product page', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_page_banner',
                'type'     => 'media',
                'title'    => __( 'Shop page banner image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shop_page_banner_content',
                'type'     => 'editor',
                'title'    => __( 'Shop page banner content', 'redux-framework-demo' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __( 'Our Story Settings', 'redux-framework-demo' ),
        'id'    => 'story-settings',
        'desc'  => __( 'Our story section for your site', 'redux-framework-demo' ),
        'icon'  => 'el el-smiley',
        'fields'     => array(
            /*array(
                'id'       => 'story_title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'story_content',
                'type'     => 'editor',
                'title'    => __( 'Section content', 'redux-framework-demo' ),
            ),*/

            array(
                'id'       => 'story_btn_text',
                'type'     => 'text',
                'title'    => __( 'Button text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'story_btn_link',
                'type'     => 'text',
                'title'    => __( 'Button link', 'redux-framework-demo' ),
                'description' => __( 'Keep page slug or full URL of the page', 'redux-framework-demo' ),
            ),            
        )
    ) );


    /*Redux::setSection( $opt_name, array(
        'title' => __( 'FAQ Settings', 'redux-framework-demo' ),
        'id'    => 'faq-settings',
        'desc'  => __( 'FAQ icons and links', 'redux-framework-demo' ),
        'icon'  => 'el el-question-sign',
        'fields'     => array(
            array(
                'id'       => 'about_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'about_icon',
                'type'     => 'media',
                'title'    => __( 'Section icon', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'product_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'product_icon',
                'type'     => 'media',
                'title'    => __( 'Section icon', 'redux-framework-demo' ),
            ),  

            array(
                'id'       => 'shipping_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'shipping_icon',
                'type'     => 'media',
                'title'    => __( 'Section icon', 'redux-framework-demo' ),
            ),   

            array(
                'id'       => 'payment_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'payment_icon',
                'type'     => 'media',
                'title'    => __( 'Section icon', 'redux-framework-demo' ),
            ),  

            array(
                'id'       => 'return_title',
                'type'     => 'text',
                'title'    => __( 'Section title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'return_icon',
                'type'     => 'media',
                'title'    => __( 'Section icon', 'redux-framework-demo' ),
            ),     
        )
    ) );*/
    
/*
 * <--- END SECTIONS
 */
