(function($) {
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
    if ( ! ( $( 'body' ).hasClass( 'single' ) ) ) {
      $grid.masonry( 'layout' );
    }
  }

  // Chip clipping function
  function clipChips( selector ) {
    $( selector ).find( '.placeholder-chip' ).remove();
    $( selector ).each(function() {
      var $allChips     = $( this ).find( '.chip' ).removeClass( 'clipped-chip screen-reader-only' );
      var $clippedChips = $( this ).find( '.chip' ).filter(function( index ) {
        return $allChips.eq( 0 ).position().top != $allChips.eq( index < $allChips.size() - 1 ? index + 1 : index ).position().top;
      }).addClass( 'clipped-chip screen-reader-only' );
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
      }
    });
    $( 'body:not(.single) > .main' ).masonry( 'layout' );
  }

  $(function() {
    // Setup Materialize Side Navs
    $( '.sidebar-trigger' ).sideNav();

    // Setup Masonry grid
    $( 'body:not(.single) > .main' ).append( $( '<div class="sizer"></div>' ) );
    if ( ! ( $( 'body' ).hasClass( 'single' ) ) ) {
      var $grid = $( 'body > .main' );
      $grid.masonry({
        itemSelector: 'article.card, div.cellulose-pagination',
        columnWidth: 'body > .main > .sizer',
        percentPosition: true,
        gutter: 10
      });
      $grid.imagesLoaded().progress(function() {
        $grid.masonry( 'layout' );
      })
    }

    // Colorize captions
    $( '.wp-caption' ).imagesLoaded().progress(function( instance, image ) {
      var colorThief = new ColorThief();
      var background = colorThief.getColor( image.img );
      var isLight    = brightness( background ) > 170;
      var textColor  = isLight ? 'rgba(0, 0, 0, 0.54)' : 'rgba(255, 255, 255, 0.7)';
      var linkColor  = isLight ? 'rgba(0, 0, 0, 0.46)' : 'rgba(255, 255, 255, 0.5)';
      $( image.img ).parent().siblings( '.wp-caption-text' ).css( 'background-color', rgbtohex( background ) ).css( 'color', textColor ).find( 'a' ).css( 'color', linkColor );
    });

    $( window ).resize( clipFeaturedImages );
    $( '.post.has-post-thumbnail > .card-image img' ).imagesLoaded().progress(function( instance, image ) {
      clipFeaturedImages();
    });

    var chipSelector = '.entry-taxonomies > div';
    $( window ).resize(function() {
      clipChips( chipSelector );
    });
  });

  $( window ).load(function() {
    var chipSelector = '.entry-taxonomies > div';
    clipChips( chipSelector );
  })
})(jQuery);
