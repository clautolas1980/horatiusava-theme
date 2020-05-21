<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package horatiusava
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo site_url()."/wp-content/themes/horatiusava/corandus/images/new-favicon.ico"; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700&display=swap" rel="stylesheet">
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="totop">
	<img class="totop-img noprint" src="<?php echo get_template_directory_uri().'/corandus/images/HS_back-to-top_black.svg'; ?>" alt="Go to top" />
</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'horatiusava' ); ?></a>
	<header id="masthead" class="site-header">
        <div id="menu_mobile">
            <nav>
                <div id="mobile_menu_close"></div>
                <?php wp_nav_menu( array(
                     'menu_class' => 'nav mobile-menu',
                     'theme_location' => 'mobile-menu',
                     'menu_id'        => 'mobile_menu',
                     'depth' => 2,
                     'container' => false,
                     'menu_class' => 'navbar-nav nav mobile-menu',
                     'walker' => new description_walker()
                 )); 
                
                get_template_part( 'template-parts/content', 'language-switcher' );
                ?>
           </nav>
       </div>
		<div class="container-fluid">           
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-sm-4 header_logo" >
                            <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">                  
                                <img src="<?php echo get_template_directory_uri() . '/corandus/images/HS_Logo_black.svg' ?>" alt="Horatiu Sava">
                            </a>  
                        </div>
                        <div id="mobile_menu_btn"></div>
                        <div class="col-sm-8 desktop_menu"> 
                            <nav id="site-navigation" class="navbar navbar-expand-md navbar-light">	
                                <?php                     
                                   wp_nav_menu( array(
                                       'theme_location' => 'menu-1',
                                       'menu_id'        => 'primary-menu',
                                       'depth' => 2,
                                       'container' => false,
                                       'menu_class' => 'nav desktop-menu',
                                       'walker' => new description_walker()
                                   ) );
                                   
                                   get_template_part( 'template-parts/content', 'language-switcher' );
                                ?>                                             
                            </nav>
                            <div id="desktop_menu_icon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
	</header><!-- #masthead -->
