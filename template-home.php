<?php
/**
 * Template Name: Home Page
 *
 * @package horatiusava
 */

get_header( 'background-image' );

?>
    <?php
        $gallery = get_field( 'slider_nextgen_gallery' );
        $galID = $gallery[0]['ngg_id'];
        $imageGallery = new nggdb();
        $images = $imageGallery->get_gallery( $galID );
    ?>
	<main id="primary" class="site-main">     
        <div class="slickSlider">
             <?php
                foreach ( $images as $image ):
                    if ( !$image->hidden ) :  ?>
                       <div class="slider-item header_background_image" style="background-image: url(<?php echo $image->imageURL; ?>)"></div>               
            <?php endif; 
            endforeach;
            ?> 
        </div>
	</main><!-- #main -->

<?php
get_footer();
