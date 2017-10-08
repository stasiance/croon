var trigger  = $('.switch-account-tabs');
var atab     = $('.account-tab');

trigger.on('click', function(e) {
  e.preventDefault();

  var tab2show = $(this).data('tab');
  tab2show = $('.' + tab2show + '-tab');
  var tabref   = $(this);

  atab.hide();
  trigger.removeClass('active');

  tab2show.fadeIn(300);
  tabref.addClass('active');
});
