(function($) {
  $(function() {
    // Setup Materialize Side Navs
    $( '.sidebar-trigger' ).sideNav();

    // Setup Masonry grid
    $( 'body.home > .main' ).append( $( '<div class="sizer"></div>' ) );
    if ( $( 'body' ).hasClass( 'home' ) ) {
      $grid = $( 'body > .main' );
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
  });
})(jQuery);
