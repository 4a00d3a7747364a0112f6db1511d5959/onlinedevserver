<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "pet_options";

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
                'id'       => 'logo-text',
                'type'     => 'text',
                'title'    => __( 'Logo text for your website', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'logo-sub-text',
                'type'     => 'text',
                'title'    => __( 'Logo sub title for your website', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => __( 'Logo for your website', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'logo-foot',
                'type'     => 'media',
                'title'    => __( 'Footer Logo for your website', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'mail',
                'type'     => 'text',
                'title'    => __( 'Email Address', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'copyright',
                'type'     => 'text',
                'title'    => __( 'Copyright information', 'redux-framework-demo' ),
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
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => __( 'Pinterest link', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => __( 'Instagram link', 'redux-framework-demo' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __( 'Home Page Banners', 'redux-framework-demo' ),
        'id'    => 'home-banner-settings',
        'desc'  => __( 'Home page banner section settings', 'redux-framework-demo' ),
        'icon'  => 'el el-edit',
        'fields'     => array(
            array(
                'id'       => 'latest_tab_banner',
                'type'     => 'media',
                'title'    => __( 'Latest Posts Banner', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'latest_tab_banner_content',
                'type'     => 'editor',
                'title'    => __( 'Latest Post Banner Content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'trending_tab_banner',
                'type'     => 'media',
                'title'    => __( 'Trending Posts Banner', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'trending_tab_banner_content',
                'type'     => 'editor',
                'title'    => __( 'Trending Post Banner Content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'editor_tab_banner',
                'type'     => 'media',
                'title'    => __( 'Editor\'s Choice Banner', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'editor_tab_banner_content',
                'type'     => 'editor',
                'title'    => __( 'Editor\'s Choice Banner Content', 'redux-framework-demo' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __( 'Category Title Edits', 'redux-framework-demo' ),
        'id'    => 'category-settings',
        'desc'  => __( 'Category titles for headers', 'redux-framework-demo' ),
        'icon'  => 'el el-edit',
        'fields'     => array(
            array(
                'id'       => 'cat_memorial',
                'type'     => 'text',
                'title'    => __( 'Memorial Page Title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'cat_memorial_banner',
                'type'     => 'media',
                'title'    => __( 'Memorial Tab Banner', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'cat_pampered',
                'type'     => 'text',
                'title'    => __( 'Pampered Page Title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'cat_pampered_banner',
                'type'     => 'media',
                'title'    => __( 'Pampered Tab Banner', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'cat_senior',
                'type'     => 'text',
                'title'    => __( 'Senior Page Title', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'cat_senior_banner',
                'type'     => 'media',
                'title'    => __( 'Senior Tab Banner', 'redux-framework-demo' ),
            ),
        )
    ) );
      

    Redux::setSection( $opt_name, array(
        'title' => __( 'Binky\'s Pet Settings', 'redux-framework-demo' ),
        'id'    => 'binkys-pet-settings',
        //'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-cog',
        'fields'     => array(
            array(
                'id'       => 'binkys-pet-title',
                'type'     => 'editor',
                'title'    => __( 'Binky\'s Pet Content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-in-memorial-btn-text',
                'type'     => 'text',
                'title'    => __( 'In Memorial Button Text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-in-memorial-link',
                'type'     => 'text',
                'title'    => __( 'In Memorial Tab Link', 'redux-framework-demo' ),
                'description' => __('Keep page slug name only i.e. \'in-memorials\'', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'binkys-pampered-pets-btn-text',
                'type'     => 'text',
                'title'    => __( 'Pampered Pets Button Text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-pampered-pets-link',
                'type'     => 'text',
                'title'    => __( 'Pampered Pets Tab Link', 'redux-framework-demo' ),
                'description' => __('Keep page slug name only i.e. \'pampered-pets\'', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'binkys-senior-pet-care-btn-text',
                'type'     => 'text',
                'title'    => __( 'Senior Pet Care Button Text', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-senior-pet-care-link',
                'type'     => 'text',
                'title'    => __( 'Senior Pet Care Tab Link', 'redux-framework-demo' ),
                'description' => __('Keep page slug name only i.e. \'senior-pets-care\'', 'redux-framework-demo'),
            ),

            array(
                'id'       => 'binkys-pet-first-image',
                'type'     => 'media',
                'title'    => __( 'First Image', 'redux-framework-demo' ),
                'description' => __('Image dimension must be: 241 x 183 pixels', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-pet-second-image',
                'type'     => 'media',
                'title'    => __( 'Second Image', 'redux-framework-demo' ),
                'description' => __('Image dimension must be: 341 x 250 pixels', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'binkys-pet-third-image',
                'type'     => 'media',
                'title'    => __( 'Third Image', 'redux-framework-demo' ),
                'description' => __('Image dimension must be: 310 x 206 pixels', 'redux-framework-demo' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __( 'In Memoriam Settings', 'redux-framework-demo' ),
        'id'    => 'memoriam-pet-settings',
        //'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-edit',
        'fields'     => array(
            array(
                'id'       => 'memoriam-pet-content',
                'type'     => 'editor',
                'title'    => __( 'Memoriam Pet Content', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'memoriam-pet-first-image',
                'type'     => 'media',
                'title'    => __( 'In Memoriam First Image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'memoriam-pet-second-image',
                'type'     => 'media',
                'title'    => __( 'In Memoriam Second Image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'memoriam-pet-third-image',
                'type'     => 'media',
                'title'    => __( 'In Memoriam Third Image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'memoriam-pet-fourth-image',
                'type'     => 'media',
                'title'    => __( 'In Memoriam Fourth Image', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'memoriam-pet-fifth-image',
                'type'     => 'media',
                'title'    => __( 'In Memoriam Fifth Image', 'redux-framework-demo' ),
            ),
        )
    ) );


    /*
     * <--- END SECTIONS
     */
