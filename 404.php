<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package horatiusava
 */

get_header('background-image');

$errorPageId = 175;

if (ICL_LANGUAGE_CODE == 'en') {
    $errorPageId = 179;
}
?>

	<main id="primary" class="site-main">
		<div class="header_background_image" style="background-image: url(<?php echo get_field('404_image', $errorPageId)['url'];?>)">               
            <div class="container-fluid header_text_container">      
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header_text_div">                  
                                    <?php echo get_field('404_content', $errorPageId); ?> 
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
	</main><!-- #main -->

<?php
get_footer();
