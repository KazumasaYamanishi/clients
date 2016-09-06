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
  Formタグに class form-horizontal を追加
-------------------------------------------------- */
jQuery(document).ready(function($){
  $('.page-id-19 form').addClass('form-horizontal');
});
/* --------------------------------------------------
  郵便番号自動入力
-------------------------------------------------- */
jQuery(document).ready(function($){
  $('.page-id-19 #zip').jpostal({
    postcode : [
      '#zip'
    ],
    address : {
      '#pref' : '%3',
      '#city' : '%4%5'
    }
  });
});
/* --------------------------------------------------
  高さを揃える
-------------------------------------------------- */
jQuery(document).ready(function($){
  $('.height-some').matchHeight();
  $('.height-some h4').matchHeight();
});
