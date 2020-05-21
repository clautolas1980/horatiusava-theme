<?php
/**
 * Template Name: Work Before image gallery pop up
 *
 * @package horatiusava
 */

get_header(); 
?>

<main id="primary" class="site-main">
    <!--Projects section-->
    <div id="work">                 
        <div class="container-fluid">      
            <div class="row">         
                <?php 
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'order'   => 'DESC'
                );

                $my_posts = new WP_Query( $args );
                if ( $my_posts->have_posts() ) : 
                     while ( $my_posts->have_posts() ) : $my_posts->the_post(); 
                        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
                        $imageTitle = get_post(get_post_thumbnail_id())->post_title; //The Title
                        $overlayColor = get_field('overlay_color', $post->ID) == 'white' ? get_field('overlay_color', $post->ID) : '';
                    ?>
                    <div class="work_column <?php echo $overlayColor; ?>"> 
                        <div class="open-popup-link">
                            <img src="<?php echo $url; ?>" alt="<?php echo $imageTitle; ?>" />
                            <div class="image_content_wrapper">
                                <div class="image_content">
                                    <div class="project_headline">
                                       <?php echo get_field('project_headline', $post->ID); ?>
                                    </div>
                                    <div>
                                       <?php echo get_field('project_location', $post->ID); ?>
                                    </div>
                                    <div>
                                       <?php echo get_field('project_date', $post->ID); ?>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <?php 
                            $gallery = get_field('project_gallery', $post->ID);
                            
                            if($gallery) :   
                                $galID = $gallery[0]['ngg_id'];
                                $imageGallery = new nggdb();
                                $images = $imageGallery->get_gallery($galID);    
                                $galleryOverlayColor = get_field('gallery_overlay_color', $post->ID) == 'black' ? get_field('gallery_overlay_color', $post->ID) : '';
                        ?>
                        <div id="work_slider_<?php echo $post->post_name; ?>" class="work_slider mfp-hide" data-background="<?php echo $galleryOverlayColor; ?>" data-target="<?php echo $post->post_name; ?>">
                            <?php foreach ($images as $image):
                                    if ( !$image->hidden ) :  ?>
                                        <a href="<?php echo $image->imageURL;  ?>" title="<?php echo $image->alttext; ?>" ></a>
                                   <?php  endif;
                                endforeach; 
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>  
                <div id="overview_<?php echo $post->post_name; ?>" data-target="<?php echo $post->post_name; ?>" class="mfp-hide">
                    <div class="work_single main_section">                 
                        <div class="container-fluid">      
                            <div class="row">
                                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0 content">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-12">
                                            <?php the_title(); ?>
                                            <div class="project_details"><?php echo get_field('project_subtitle', $post->ID); ?></div>
                                        </div>
                                        <div class="work_info_close"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 info_content image_gallery">
                                            <?php if ($gallery) : 
                                                    foreach ($images as $image):
                                                        if ( !$image->hidden ) : ?>
                                                           <img class="overview_image" src="<?php echo $image->imageURL; ?>" alt="<?php echo $image->alttext; ?>" />
                                                        <?php  endif;
                                                    endforeach; ?>     
                                            <?php endif;?>
                                        </div>
                                    </div>  
                                    <div class="row bottom_menu_row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="overview bottom_menu_item"><?php _e( 'overview', 'horatiusava' ); ?></div>
                                            <a href="#info_<?php echo $post->post_name; ?>" class="open-info-overview bottom_menu_item"><?php _e( 'info', 'horatiusava' ); ?></a>
                                        </div>
                                    </div>			
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="info_<?php echo $post->post_name; ?>" data-target="<?php echo $post->post_name; ?>" class="mfp-hide">
                    <div class="work_single main_section">                 
                        <div class="container-fluid">      
                            <div class="row">
                                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0 content">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-12">
                                            <?php the_title(); ?>
                                            <div class="project_details"><?php echo get_field('project_subtitle', $post->ID); ?></div>
                                        </div>
                                        <div class="work_info_close"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-12 info_content">
                                            <?php the_content(); ?> 
                                        </div>
                                    </div>  
                                    <div class="row bottom_menu_row">
                                        <div class="col-sm-12 col-xs-12">
                                             <a href="#overview_<?php echo $post->post_name; ?>" class="open-work-overview bottom_menu_item"><?php _e( 'overview', 'horatiusava' ); ?></a>
                                             <div class="info bottom_menu_item"><?php _e( 'info', 'horatiusava' ); ?></div>
                                        </div>
                                    </div>			
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; 
                wp_reset_postdata(); //reset global post variable. After this point, we are back to the Main Query object
                endif; 
                ?>
            </div>
        </div>
    </div>
    <!--End Projects section-->
</main><!-- #main -->
<?php
get_footer();