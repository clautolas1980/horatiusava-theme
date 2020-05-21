<?php
/**
 * Template Name: Social
 *
 * @package horatiusava
 */

get_header(); 

?>

<main id="primary" class="site-main">
    <!--Social section-->
    <div id="social" class="main_section">                 
        <div class="container-fluid">      
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0">
                    <div id="tabs">
                        <ul>
                          <li><a href="#instagram_content">Instagram</a></li>
                          <li><a href="#flickr_content">Flickr</a></li>
                        </ul>
                        <!--The next row will be populated by instagram images through the Instagram API Ajax call-->
                        <div id="instagram_content">
                          <?php echo do_shortcode( '[instagram-feed showfollow=false]' ); ?>
                        </div>
                        <!--The next row will be populated by flickr images through the Flickr API Ajax call-->
                        <div id="flickr_content">
                            <div class="row" id="flickr_images"></div>
                            <div class="row">  
                                <div class="col-sm-12 more_flickr_row">
                                    <span id="more_flickr"><?php _e( 'Load more', 'horatiusava' ); ?></span>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Social section-->
</main><!-- #main -->
<?php
get_footer();