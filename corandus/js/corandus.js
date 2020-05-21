var $ = jQuery.noConflict();

$( document ).ready(function( $ ) { 
    $( "#tabs" ).tabs();
    /* Load the flicker images from the Flickr API */
    var paged = 1;
    getFlickerImages( paged );
    
    /* Load more images from the Flickr API, 20 per page */
    $( '#more_flickr' ).click(function( e ) {
        paged++;
        getFlickerImages( paged );
    });   
    /* End Load the flicker images from the Flickr API */

    /* Language switcher */
    $( '.en_lang' ).click(function( e ) {
		e.preventDefault();
		if( $(this).attr( 'data-current' ) == "de" ) {
			window.location.href = window.location.origin + "/en" + window.location.pathname;
		}
	});
    
	$( '.de_lang' ).click(function( e ) {
		e.preventDefault();
		if( $(this).attr( 'data-current' ) == "en" ) {
			var pathname = window.location.pathname;
			pathname = pathname.replace('/en/','/');
			window.location.href = window.location.origin + pathname;
		}
	});  
    /* End Language switcher */
    
    /* Click the desktop menu icon, show the desktop menu */
    $( "#desktop_menu_icon" ).click(function() {
		var menuIcon = $( this );
        menuIcon.hide( "slow" );
        $( "#site-navigation" ).addClass( 'show' ); 
        
		setTimeout(function() {
            menuIcon.show( 'slow' );
            $( "#site-navigation" ).removeClass( 'show' ); 
		}, 10000);
	});
    /* End Click the desktop menu icon, show the desktop menu */
    
    /* Mobile Menu Icon Click Action */   
    $( "#mobile_menu_btn" ).click(function() {
		$( "#menu_mobile, .image_background_header .site-header, #desktop_menu_icon" ).toggleClass( 'opened' );
        $( this ).toggleClass( 'opened' );
	} );
    /* End Mobile Menu Icon Click Action */
    
    /* Home page slider functionality */  
    $( '.slickSlider' ).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: '<div class="btn_right"></div>',
		prevArrow: '<div class="btn_left"></div>',
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true, 
        cssEase: 'ease-out',
        speed: 500,
        fade: true,
        pauseOnHover: false,
        pauseOnFocus: false
    });
     
    /* On after slide change */
    $( '.slickSlider' ).on('afterChange', function( event, slick, currentSlide ){
        if( $( '.header_background_image' ).length ) {
            BackgroundCheck.refresh();
        } 
    } );    
    /* End Home page slider functionality */ 

    /* Work page pop up */
    $( '.open-popup-link' ).attr( 'first-clicked', '0' );
    $( '.open-popup-link' ).on( 'click' , function(e) {
        /* Treat the hover effect on mobile devices, first click hover, second click open pop up window */
        if( isMobile() && $( this ).attr('first-clicked')== '0' ) {
            $('.open-popup-link').attr('first-clicked','0');
            $(this).attr('first-clicked','1');
 		} else {
            if($(this).next().hasClass('work_slider')) {
                $(this).next().magnificPopup('open');
            }
            $('.open-popup-link').attr('first-clicked','0');
 		}
        /* End Treat the hover effect on mobile devices, first click hover, second click open pop up window */
    });
    
    var workOverviewText = language == "de" ? "Übersicht" : "Overview";
    var loadingText = language == "de" ? "Wird geladen..." : "Loading...";
    $( '.work_slider' ).each(function () {
        $( this ).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnBgClick: false,
            fixedContentPos: true,
            fixedBgPos: true,
            showCloseBtn: false,
            preload: [1,2], 
            tLoading: loadingText,
            gallery: {
                enabled: true,
                navigateByImgClick: true
            },
            image: {
				tError: 'Image not loaded.',
				markup: '<div class="mfp-figure">' +
							'<div class="popup_close"></div>' +
							'<figure>' +
								'<div class="mfp-img"></div>' +  
								'<figcaption>' +
									'<div class="mfp-bottom-bar">' +
										'<div class="mfp-title"></div>' +
										'<div class="mfp-counter"></div>' +
									'</div>'+
									'<div class="more_info work_overview">' + workOverviewText + '</div>' +
									'<div class="more_info work_info">Info</div>' +
							  '</figcaption>' +
						    '</figure>' +
						'</div>',
                titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
                verticalFit: true // Fits image in area vertically
			},
            mainClass: 'work_slider_popup',
            callbacks: {
                open: function( e, f) {
                    var magnificPopup = $.magnificPopup.instance; // save instance in magnificPopup variable
                    var target = $( magnificPopup.st.mainEl[0] ).attr( 'data-target' );
                    var backgroundClass = $( magnificPopup.st.mainEl[0] ).attr( 'data-background' );
                    this.wrap.addClass( backgroundClass );
                    $( 'body' ).addClass( 'noscroll' );
                    
                    $( '.popup_close' ).click(function() { 
                        magnificPopup.close();
                    });

                    /* Click the overview pop up for each project */
                    $( '.work_overview' ).on('click', function() {              
                        $.magnificPopup.close();
                        $.magnificPopup.open({
                            items: {
                              src: '#overview_' + target,
                              type: 'inline'
                            },
                            showCloseBtn: false,
                            mainClass: 'work_overview_popup',
                            fixedContentPos: true,
                            fixedBgPos: true,
                            closeOnBgClick: false,
                            callbacks: {
                                open: function( e, f ) {   
                                    $( '.work_info_close' ).click(function() { 
                                       $.magnificPopup.close();
                                    }); 
                                    
                                    /* Create a pop up for the overview gallery */
                                    $( '.image_gallery a' ).on('click', function() {
                                        $.magnificPopup.close();

                                        $( '.image_gallery' ).magnificPopup({
                                            delegate: 'a', 
                                            type: 'image',
                                            closeOnBgClick: false,
                                            fixedContentPos: true,
                                            fixedBgPos: true,
                                            showCloseBtn: false,
                                            preload: [1,2],
                                            gallery: {
                                                enabled: true,
                                                navigateByImgClick: true
                                            },
                                            image: {
                                                tError: 'Image not loaded.',
                                                markup: '<div class="mfp-figure">' +
                                                            '<div class="popup_close"></div>' +
                                                            '<figure>' +
                                                                '<div class="mfp-img"></div>' +  
                                                                '<figcaption>' +
                                                                    '<div class="mfp-bottom-bar">' +
                                                                        '<div class="mfp-title"></div>' +
                                                                        '<div class="mfp-counter"></div>' +
                                                                    '</div>' +
                                                                    '<div class="more_info work_overview">' + workOverviewText + '</div>' +
                                                                    '<div class="more_info work_info">Info</div>' +
                                                              '</figcaption>' +
                                                            '</figure>' +
                                                        '</div>',
                                                titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
                                                verticalFit: true // Fits image in area vertically
                                            },
                                            mainClass: 'work_slider_popup',
                                            callbacks: {
                                                open: function(e, f) {
                                                    $( '.popup_close' ).click(function() { 
                                                        $.magnificPopup.close();
                                                    });
                                                    
                                                    /* Go back to the overview pop up, from the image gallery */
                                                    $( '.work_overview' ).on('click', function() { 
                                                        openPopupTarget( '#overview_' + target, 'work_overview_popup' );                  
                                                    });
                                                    /* End Go back to the overview pop up, from the image gallery */
                                                    
                                                    /* Click the info pop up from the image gallery pop up */
                                                    $( '.work_info' ).on('click', function() {
                                                        openPopupTarget( '#info_' + target, 'info_overview_popup' );            
                                                    });
                                                    /* End Click the info pop up from the image gallery pop up */
                                                }
                                            }
                                       }).magnificPopup('open');
                                    }); 
                                    /* End pop up for the overview gallery images */
                                }
                            }
                        });                       
                    });                   
                    /* End Click the overview pop up for each project */
                    
                    /* Click the info pop up for each project */
                    $( '.work_info' ).on('click', function() {
                        openPopupTarget( '#info_' + target, 'info_overview_popup' );                      
                    });
                    /* End Click the info pop up for each project */
                },
                close: function() {
					$( 'body' ).removeClass( 'noscroll' );	
				}
            }
        });
    }); 
    /* End Work page pop up */
    
    /* Work single overview pop up, triggered from the info pop up */
    $( '.open-work-overview' ).magnificPopup({
        type:'inline',
        mainClass: 'work_overview_popup',
        showCloseBtn: false,
        closeOnBgClick: false,
        fixedContentPos: true,
        fixedBgPos: true,
        callbacks: {
            open: function( e, f ) {
                $( '.work_info_close' ).click(function () { 
                   $.magnificPopup.close();
                });
            }
        }
    });
    /* End Work single overview pop up, triggered from the info pop up */
    
    /* Work single info pop up, triggered from the overview pop up */
    $( '.open-info-overview' ).magnificPopup({
        type:'inline',
        mainClass: 'info_overview_popup',
        fixedContentPos: true,
        fixedBgPos: true,
        showCloseBtn: false,
        closeOnBgClick: false,
        callbacks: {
            open: function( e, f ) {
                $( '.work_info_close' ).click(function () { 
                    $.magnificPopup.close();
                });
            }
        }
    });
    /* End Work single info pop up, triggered from the overview pop up */
      
	$( window ).resize(function() {
        /* Refresh the header colors (black/white) based on the background header image */
        if( $( '.header_background_image' ).length ) {
            BackgroundCheck.refresh();
        } 
        /* End Refresh the header colors (black/white) based on the background header image */
	});
    
	$( window ).scroll(function() {
        if( $( window ).scrollTop() > 1 ) {
                $( '#tobottom' ).addClass( 'scrolled' );
        } else {
                $( '#tobottom' ).removeClass( 'scrolled' );
        }
        
		if( $( window ).scrollTop() > window.innerHeight ) {
			$( '#totop' ).addClass( 'scrolled' );
		} else {
			$( '#totop' ).removeClass( 'scrolled' );
		}		
	});
});

$( window ).on('load', function() { 
    /* Change the header colors (black/white) based on the background header image */
    if( $( '.header_background_image' ).length ) {
        BackgroundCheck.init({
            targets: '.site-header, .slick-arrow',
            images: '.header_background_image'
        });
    }
    /* End Change the header colors (black/white) based on the background header image */
    
    $( '#totop' ).click(function(){
		scrollToTop();
	});
});

function scrollToTop(){
	$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
}
  
function doubleclickHoverMobile() {
    $( '.social_column_background_image a' ).attr( 'first-clicked' , '0' );
    $( '.social_column_background_image a' ).on('click', function(e) {
        if( isMobile() && $( this ).attr( 'first-clicked') == '0' ) {
            $( '.social_column_background_image a' ).attr( 'first-clicked', '0' );
            e.preventDefault();
            $( this ).attr( 'first-clicked', '1' );
 		} else {            
            $( '.social_column_background_image a' ).attr( 'first-clicked', '0' );
 		}  
    });
}  

/**
 * Check if the cuurent device is a mobile device.
 * 
 */
function isMobile() {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
		return true;
	}
    return false;
}

/**
 * Open the targetetd magnific pop up.
 * @param {string} popupTarget to be opened.
 * @param {string} popupClass to be added as main class.
 */
function openPopupTarget( popupTarget, popupClass ) {
    $.magnificPopup.close();
    $.magnificPopup.open({
        items: {
          src: popupTarget,
          type: 'inline'
        },
        showCloseBtn: false,
        mainClass: popupClass,
        fixedContentPos: true,
        fixedBgPos: true,
        closeOnBgClick: false,
        callbacks: {
            open: function ( e, f ) {
                $( '.work_info_close' ).click(function() { 
                    $.magnificPopup.close();
                });   
            }
        }
    });
}

/**
 * Load the flicker images from the Flickr API
 * @param {number} paged Pagination page to query
 */
function getFlickerImages( paged ) {
    var flickerAPI = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username=Horatiu Sava&format=json&api_key=d23689e140774de88ab07b68fffa7a4f&jsoncallback=?";

    $.getJSON( flickerAPI, function( data ) {  
        var user_id = data.user.nsid;
        $.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + user_id + "&format=json&api_key=d23689e140774de88ab07b68fffa7a4f&per_page=20&page=" + paged + "&extras=url_n,description&jsoncallback=?").done(function( data ) { 
            if( data ) {
                /* Disable the load more button when there are no more images to load */
                var numberPages = data.photos.pages;
                if( numberPages <= paged ) {
                    $( '#more_flickr' ).addClass( 'disable_button' );
                }
                
                $.each( data.photos.photo, function ( num, photo ) {
                    var photo_author = photo.owner;
                    var photo_title = photo.title;
                    var photo_src = photo.url_n;
                    var photo_id = photo.id;
                    var photo_description = photo.description._content;
                    var photo_url = "https://www.flickr.com/photos/" + photo_author + "/" + photo_id;

                    /* Use this display for larger Flickr images */
                    var flickrLargeImagesHtml = '<div class="social_column_background_image">' + 
                        '<a href="' + photo_url + '" target="_blank">' +
                             '<div class="image_shape" style="background-image: url( ' + photo_src + ' )">' +
                                '<div class="image_content_wrapper">' +
                                    '<div class="image_content">'+
                                        '<div>' + photo_title + '</div>' +
                                        '<div>' + photo_description + '</div>' + 
                                    '</div>' +
                                '</div>' + 
                                '</div>' +
                            '</a>' +
                        '</div>'; 

                    $( '#flickr_images' ).append( flickrLargeImagesHtml );
                });
                
                /* Treat the hover effect on mobile devices, first click hover, second click open pop up window */
                doubleclickHoverMobile();
                /* End Treat the hover effect on mobile devices, first click hover, second click open pop up window */
            }        
        });
    });
}

