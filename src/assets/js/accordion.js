$(function() {
  $('.accordion').accordion();
});

// Reflow after WC's ajax call
jQuery( document ).on('updated_checkout', function() {
  $('.accordion').accordion();
});
