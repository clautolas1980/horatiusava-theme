<?php
/**
 * Template Name: About
 *
 * @package horatiusava
 */

get_header(); 
?>

<main id="primary" class="site-main">
    <!--About section-->
    <div id="about" class="main_section">                 
        <div class="container-fluid">      
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 col-xs-12 about_description"> 
                            <div class="author_description">
                                <?php echo get_field( 'about_description' ); ?> 
                            </div>
                            <!--Exhibitions section-->
                            <div class="publications_section_title section">
                                <?php echo mb_strtoupper( get_field( 'exhibitions _section_title' ) ); ?> 
                            </div>
                            <?php $exhibitions = get_field( 'exhibitions' ); 
                                if ( $exhibitions ) :
                                    foreach ( $exhibitions as $exhibition ) : ?>
                                        <div class="exhibition_section">
                                            <div class="title">
                                                 <?php echo $exhibition['exhibition_title']; ?>
                                            </div>
                                            <div class="date">
                                                 <?php echo $exhibition['exhibition_date']; ?>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>  
                            <!-- End Exhibitions section-->
                            
                            <!--Publications section-->
                            <div class="publications_section_title section">
                                <?php echo mb_strtoupper( get_field( 'publications_section_title' ) ); ?> 
                            </div>
                            <?php $publications = get_field( 'publications' );
                                if ( $publications ) :
                                    foreach ( $publications as $publication ) : ?>
                                        <div class="publication_section">
                                            <div class="title">
                                                 <?php echo $publication['publication_title']; ?>
                                            </div>
                                            <div class="date">
                                                 <?php echo $publication['publication_date']; ?>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>  
                            <!-- End Publications section-->
                        </div>
                        <div class="col-lg-4 col-sm-12 col-xs-12 right_content_column"> 
                            <div class="author_image">
                                <img src="<?php echo get_field( 'author_image' )['url']; ?>" alt="Horatiu Sava"> 
                            </div>
                            <div class="about_right_content">
                                <?php echo get_field( 'about_right_content' ); ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End About section-->
</main><!-- #main -->
<?php
get_footer();