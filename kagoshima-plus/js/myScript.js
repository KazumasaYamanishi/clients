/* --------------------------------------------------
  ページトップに戻る
-------------------------------------------------- */
jQuery(document).ready(function($){
    var pageTop = $('#toPageTop');
    pageTop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function () {
        $('body, html').animate({scrollTop:0}, 500, 'swing');
        return false;
    });
});
/* --------------------------------------------------
  高さを揃える
-------------------------------------------------- */
jQuery(document).ready(function($){
  $('.height-some').matchHeight();
  $('.height-some h4').matchHeight();
});
