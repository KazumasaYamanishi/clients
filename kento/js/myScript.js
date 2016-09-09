/* --------------------------------------------------
  スムーススクロール
-------------------------------------------------- */
jQuery(document).ready(function($) {
	// #で始まるアンカーをクリックした場合に処理
	$('a[href^=#]').click(function() {
		// スクロールの速度
		var speed = 600; // ミリ秒
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
  郵便番号自動入力
-------------------------------------------------- */
jQuery(document).ready(function($){
	$('#zip').keyup(function(event){
		AjaxZip3.zip2addr(this,'','addr','addr');
	});
});
/* --------------------------------------------------
  高さを揃える
-------------------------------------------------- */
jQuery(document).ready(function($){
	$('.height-some').matchHeight();
	$('.height-some h4').matchHeight();
});
