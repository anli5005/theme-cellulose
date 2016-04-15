(function($) {
  var $grid;

  // Featured image clipping function
  function clipFeaturedImages() {
    $( '.post.has-post-thumbnail > .card-image' ).each(function() {
      var $image = $( this );
      var $img   = $image.find( 'img' );
      var threshold = 0.6;
      if ( $img.height() > 0.6 * $( window ).height() ) {
        var height = $img.height();
        var maxHeight = 0.6 * $( window ).height();
        var clipPoints = { start: ( height - maxHeight ) / 2, end: ( height + maxHeight ) / 2 };
        var clip = 'rect('+clipPoints.start+'px,auto,'+clipPoints.end+'px,auto)';
        $img.css({
          position: 'absolute',
          top: -clipPoints.start + 'px',
          left: 0,
          clip: clip
        });
        $image.height( maxHeight )
      }
    });
    if ( $( 'body' ).hasClass( 'masonry' ) ) {
      $grid.masonry( 'layout' );
    }
  }

  // Chip clipping function
  function clipChips( selector ) {
    $( selector ).find( '.placeholder-chip' ).remove();
    $( selector ).each(function() {
      var $allChips     = $( this ).find( '.chip' ).removeClass( 'clipped-chip screen-reader-text' );
      var $clippedChips = $( this ).find( '.chip' ).filter(function( index ) {
        return $allChips.eq( 0 ).position().top != $allChips.eq( index < $allChips.size() - 1 ? index + 1 : index ).position().top;
      }).addClass( 'clipped-chip screen-reader-text' );
      if ( $clippedChips.size() > 0 ) {
        var $placeholder = $( '<span class="chip placeholder-chip" aria-hidden="true"></span>' ).text( $clippedChips.size() ).appendTo( $( this ) );
        $placeholder.prepend( $( '<span class="material-icons">more_horiz</span>' ) );
        var tooltip = '';
        $clippedChips.each(function( index ) {
          tooltip += $( this ).clone().find( '.material-icons' ).remove().end().text();
          if ( index < $clippedChips.size() - 1 ) {
            tooltip += ', ';
          }
        });
        $placeholder.attr( 'data-tooltip', tooltip ).tooltip({delay: 0, position: 'bottom'});
        $placeholder.click(function() {
          $( this ).parent().find( '.clipped-chip' ).toggleClass( 'screen-reader-text' ).end().end().find( '.material-icons' ).text( $( this ).parent().find( '.clipped-chip' ).hasClass( 'screen-reader-text' ) ? 'more_horiz' : 'chevron_left' );
          $( 'body.masonry > .main' ).masonry( 'layout' );
        });
      }
    });
    $( 'body.masonry > .main' ).masonry( 'layout' );
  }

  function paginateTabs() {
    var $nav = $( '.site-navigation > ul li' );
    var paginationAdded = $nav.eq( 0 ).find( 'i.material-icons' ).length > 0;
    var width = 0;
    for (var i = 0; i < $nav.length; i++) {
      width += $nav.eq( i ).outerWidth();
    }
    if ( width > $( '.site-navigation' ).innerWidth() ) {
      console.log("Moo");
      if ( !paginationAdded ) {
        var $left  = $( '<li><i class="material-icons"></i></li>' ).css({position: 'absolute', top: 0, height: '100%', display: 'block'});
        var $right = $left.clone();
        $left.find( '.material-icons' ).text( 'chevron_left' ).end().click(function() {
          $( this ).parent().scrollLeft( $( this ).parent().scrollLeft() - ( 0.5 * $( window ).width() ) );
        }).css( 'left', 0 ).prependTo( $( 'body > header > nav > ul' ) );
        $right.find( '.material-icons' ).text( 'chevron_right' ).end().click(function() {
          $( this ).parent().scrollLeft( $( this ).parent().scrollLeft() + ( 0.5 * $( window ).width() ) );
        }).css( 'right', 0 ).appendTo( $( 'body > header > nav > ul' ) );
      }
    } else {
      if ( paginationAdded ) {
        $nav.eq( $nav.length - 1 ).remove();
        $nav.eq( 0 ).remove();
      }
    }
  }

  $(function() {
    // Setup Materialize Side Navs
    $( '.sidebar-trigger[data-activates="cellulose-sidebar"]' ).attr( 'href', '#' );
    $( '#cellulose-sidebar' ).css( 'transition', 'none' );
    $( 'a#sidenav-overlay' ).remove();
    $( '.sidebar-trigger' ).sideNav();

    // Setup Masonry grid
    $( 'body.masonry' ).children( '.main' ).append( $( '<div class="sizer"></div>' ) );
    if ( $( 'body' ).hasClass( 'masonry' ) ) {
      $grid = $( 'body > .main' ).addClass( 'masonry-grid' ).masonry({
        itemSelector: 'article.card, div.cellulose-pagination',
        columnWidth: 'body > .main > .sizer',
        percentPosition: true,
        gutter: 10
      });
      $grid.imagesLoaded().progress(function() {
        $grid.masonry( 'layout' );
      })
    }
    $( '.entry-content .gallery .gallery-item' ).each(function() {
      $( this ).width( $( this ).find( 'img' ).width() ).find( 'img' ).width( '100%' ); // HACK:0 Refactor gallery styles
      // TODO: Gallery captions are not responsive
    });
    $( '.entry-content .gallery' ).children( 'br' ).remove().end().masonry({
      gutter: 10
    });

    // Colorize captions
    $( '.wp-caption' ).imagesLoaded().progress(function( instance, image ) {
      var colorThief = new ColorThief();
      var background = colorThief.getColor( image.img );
      var isLight    = brightness( background ) > 170;
      var textColor  = isLight ? 'rgba(0, 0, 0, 0.54)' : 'rgba(255, 255, 255, 0.7)';
      var linkColor  = isLight ? 'rgba(0, 0, 0, 0.46)' : 'rgba(255, 255, 255, 0.5)';
      $( image.img ).parent().siblings( '.wp-caption-text' ).css( 'background-color', rgbtohex( background ) ).css( 'color', textColor ).find( 'a' ).css( 'color', linkColor );
    });
    $( '.gallery-icon' ).imagesLoaded().progress(function( instance, image ) {
      $( '.entry-content .gallery' ).masonry( 'layout' );
      var colorThief = new ColorThief();
      var background = colorThief.getColor( image.img );
      var isLight    = brightness( background ) > 170;
      var textColor  = isLight ? 'rgba(0, 0, 0, 0.54)' : 'rgba(255, 255, 255, 0.7)';
      var linkColor  = isLight ? 'rgba(0, 0, 0, 0.46)' : 'rgba(255, 255, 255, 0.5)';
      $( image.img ).parent().parent().siblings( '.wp-caption-text' ).css( 'background-color', rgbtohex( background ) ).css( 'color', textColor ).find( 'a' ).css( 'color', linkColor );
    }); // TODO: Refactor this, because why not?

    $( window ).resize( clipFeaturedImages );
    $( '.post.has-post-thumbnail > .card-image img' ).imagesLoaded().progress(function( instance, image ) {
      clipFeaturedImages();
    });

    var chipSelector = 'body:not(.chip-clipping-off) .entry-taxonomies > div';
    $( chipSelector ).resize(function() {
      clipChips( chipSelector );
    });

    $( window ).resize(function() {
      paginateTabs();
    });
    paginateTabs();
  });

  $( window ).load(function() {
    var chipSelector = 'body:not(.chip-clipping-off) .entry-taxonomies > div';
    clipChips( chipSelector );
  });
})(jQuery);
