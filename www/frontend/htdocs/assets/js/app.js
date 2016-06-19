$( document ).ready(function() {
  $('a').each(function() {
    var self = new RegExp('/' + window.location.host + '/');
    if (!self.test(this.href) && $(this).hasClass('internal') !== true ) {
      $(this).attr("target","_blank");
    }
  });
});