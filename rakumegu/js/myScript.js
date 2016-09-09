/* --------------------------------------------------
  ホバーエフェクト
-------------------------------------------------- */
jQuery(document).ready(function($) {
    $('.wrap-features figure').hover(function() {
        $(this).children('figcaption').addClass('open');
    }, function() {
        $(this).children('figcaption').removeClass('open');
    });
});
/* --------------------------------------------------
  ページトップに戻る
-------------------------------------------------- */
jQuery(document).ready(function($) {
    var pageTop = $('#toPageTop');
    pageTop.hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 600) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function() {
        $('body, html').animate({ scrollTop: 0 }, 500, 'swing');
        return false;
    });
});
/* --------------------------------------------------
  スムーススクロール
-------------------------------------------------- */
jQuery(document).ready(function($) {
    // #で始まるアンカーをクリックした場合に処理
    $('a[href^=#]').click(function() {
        // スクロールの速度
        var speed = 500; // ミリ秒
        // アンカーの値取得
        var href = $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var position = target.offset().top;
        // スムーススクロール
        $('body,html').animate({ scrollTop: position }, speed, 'swing');
        return false;
    });
});
/* --------------------------------------------------
  高さを揃える
-------------------------------------------------- */
jQuery(document).ready(function($) {
    $('.height-some').matchHeight();
    $('.height-some h4').matchHeight();
});
/* --------------------------------------------------
  tel:リンク無効
-------------------------------------------------- */
jQuery(document).ready(function($) {
    var device = navigator.userAgent;
    if ((device.indexOf('iPhone') > 0 && device.indexOf('iPad') == -1) || device.indexOf('iPod') > 0 || device.indexOf('Android') > 0) {
        $('.tel_link').each(function() {
            var str = $(this).text();
            $(this).html($('<a>').attr('href', 'tel:' + str.replace(/-/g, '')).append(str + '</a>'));
        });
    }
});
