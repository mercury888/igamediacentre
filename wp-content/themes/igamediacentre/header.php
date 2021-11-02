<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>  >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />

        <?php wp_head(); ?>

    </head>
	<style>
	.last.hide {
    text-align: center;
    font-size: 25px;
    text-transform: uppercase;
    font-weight: 700;
    color: #f0ece6;
    padding-top: 15%;
}
	</style>
    <body <?php
    echo (is_page('6') ? ' id="home-page"' : '');
    echo (is_page('16') ? ' id="media-page"' : '');
    echo (is_page('21') ? ' id="contact-page"' : '');
    echo (is_page('335') ? ' id="supplier-page"' : '');
    echo (is_page('339') ? ' id="starthere-page"' : '');
    echo (is_page('397') ? ' id="thankyou-page"' : '');
    echo (is_single() ? ' id="postid'. get_the_ID() .'"' : ''); ?>>

        <?php
            /** mobile navigation */
            echo '<div class="mobile_menu visible-mobile">' .
                '<a href="#" class="close-btn"></a>' .
                '<div class="mob-appntmtn">' .
                  request_button() .
                '</div>' .
                '<div class="inner">' .
                    main_navigation() .
                '</div>' .
           '</div>';


       function siteLoader() {
            ob_start();
                echo '<div class="site-loader position-fixed pin-t pin-l bg-white cell-12 h-100">' .
                    '<div class="bounce-animation bounce">' .
                        brand_logo() .
                        '<h2 class="text-center">' . 'Loading ...' . '</h2>' .
                    '</div>' .
                '</div>';
            return ob_get_clean();
        }
        // echo siteLoader();

        ?>


        <div class="main-block">
        <div id="wrapper" class="sticky-header">

            <?php
                /** Brand Logo Function Start */
                function brand_logo(){
                    ob_start();
                    if( has_custom_logo() ){
                        $desktopBrandLogoID = get_theme_mod( 'custom_logo' ); //Desktop Main brand Logo ID
                        $desktopBrandLogoImage = wp_get_attachment_image( $desktopBrandLogoID , 'full', '', ["class" => "transition"] ); //Desktop Main brand Logo Image
                        echo '<div class="header-logo">' .
                            '<a href="' . get_option('home') . '" class="cell-12 transition position-relative">' .
                                ( $desktopBrandLogoID ? $desktopBrandLogoImage : '' ) .
                            '</a>' .
                        '</div>';
                    }
                    return ob_get_clean();
                }
                /** Brand Logo Function End */

                echo '<div class="top-header-banner">'.
                '<header id="myHeader" class=" d-block cell-12 transition '. ( is_user_logged_in() ? 'logged_in' : '' ) .'">' .
                '<div class="wrapper d-flex align-items-center justify-content-between">' .
                   brand_logo() .
                    '<div class="quick-links d-flex justify-content-end cell-12 height-auto">'.
                       '<a class="navbar-toggle" href="javascript:void(0)"><span class="navbar-toggle__icon-bar"> <span class="icon-bar"></span> <span class="icon-bar"></span> </span> </a>'.
                    '</div>' .
                    (
                        my_wp_is_mobile() == 1
                        ? ''
                        : '<div class="main-navigation cell-12 height-auto d-flex justify-content-end position-relative pt-30 transition">' .
                            (
                                has_nav_menu( 'main-navigation' )
                                ? '<nav id="site-navigation" class="" aria-label="' . esc_attr( 'Top Menu', 'thelocalgrocer' ) . '">' .
                                  main_navigation() .
                               '</nav>'
                                : ''
                            ) .
                            request_button() .
                        '</div>'
                    ) .
                '</div>' .
            '</header>' ;
