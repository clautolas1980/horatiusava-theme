<?php
/**
 * Template Name: Datenschutz & Impressum
 *
 * @package horatiusava
 */

get_header(); 
?>

<main id="primary" class="site-main">
    <!--Impressum/Datenschutz section-->
    <div id="impressum" class="main_section">                 
        <div class="container-fluid">      
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <!--End Impressum/Datenschutz section-->
</main><!-- #main -->
<?php
get_footer();