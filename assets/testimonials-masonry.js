(function($){
    'use strict';
  
    function initMasonry($wrap) {
      var $grid = $wrap.find('.tm-grid');
  
      // Ensure Masonry runs after images load for correct heights
      $grid.imagesLoaded(function() {
        $grid.masonry({
          itemSelector: '.tm-item',
          columnWidth: '.tm-sizer',
          gutter: '.tm-gutter-sizer',
          percentPosition: true,
          originLeft: $('html').attr('dir') !== 'rtl' // support RTL
        });
      });
  
      // Re-layout on custom events (e.g., tabs, accordions)
      $(window).on('resize', function(){
        $grid.masonry('layout');
      });
    }
  
    $(function(){
      $('.tm-wrap').each(function(){ initMasonry($(this)); });
    });
  
  })(jQuery);