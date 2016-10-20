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
/* --------------------------------------------------
  Infinite Scroll
-------------------------------------------------- */
jQuery(document).ready(function($){
	$('.row').infinitescroll({
		loading: {
			finishedMsg: "<span class='finished_message'>すべてのコンテンツを読み込みました。</span>",
			img: "http://www.tjkagoshima.com/plus/wp-content/themes/addas/img/loading.gif",
			msgText: "<p class='text-center'>読込中</p>"
		},
		navSelector  : ".pagenavi", 		// ナビゲーション要素を指定
		nextSelector : ".pagenavi a", 		// ナビゲーションの「次へ」の要素を指定
		itemSelector : ".col-sm-3", 		// 表示させる要素を指定
	});
});