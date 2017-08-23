(function ($) {
  Drupal.behaviors.mockup = { 
    attach: function(context, settings) {
      $(document).ready(function() {
        // Accordion effect to blocks in sidebar 
        $('.region--title').unbind('click');
        $('.region--title').click(function () {
          $(this).removeClass('is-active');

          if (!(false == $(this).next().is(':visible'))) {
            $(this).addClass('is-active');
          }   
          $(this).next().slideToggle(300);
        });
      });
    }
  }
})(jQuery);  
