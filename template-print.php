<?php
/**
 * Template Name: Print
 *
 * @package horatiusava
 */

get_header(); 
?>

<main id="primary" class="site-main">
    <!--Print section-->
    <div id="print" class="main_section">                 
        <div class="container-fluid">      
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12 offset-xs-0">
                    <div class="row books-row">
                        <?php $books = get_field( 'books' ); 
                        
                        if ( $books ) :
                            foreach ( $books as $book ) : ?>
                                <div class="col-lg-4 col-sm-5 col-xs-12 column">
                                    <div class="book_image">
                                        <img src="<?php echo $book['book_cover_image']['url']; ?>" alt="transsilvanien"> 
                                    </div>
                                    <div class="book_details">
                                        <div class="book_title">     
                                            <?php echo $book['book_title']; ?>
                                        </div>
                                        <div class="book_description">
                                            <?php echo $book['book_description']; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>  
                        <div class="col-lg-4 col-sm-5 col-xs-12">          
                            <?php echo get_field( 'order_contact_info' ); ?>               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Print section-->
</main><!-- #main -->
<?php
get_footer();