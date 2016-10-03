<?php
	// =======================================================
	//
	//	3ブロック
	//
	// =======================================================
	if(is_page() && !is_front_page()):
?>
<div class="wrap-pickup">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/support"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-itiji.png" alt="一時預かり・延長保育" class="lr-center"></a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/mama"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-misyu.png" alt="未就園児教室" class="lr-center"></a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo home_url(); ?>/gallery"><img src="<?php echo home_url(); ?>/wp-content/uploads/2016/09/bnr-gall.png" alt="ギャラリー" class="lr-center"></a>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<footer>
	<div class="wrap-line">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h5 class="footer-logo">学校法人丸岡学園 幼保連携型認定こども園<span class="name-footer">やはた幼稚園</span></h5>
					<address>〒890-0056 鹿児島市下荒田4丁目19-10</address>
					<p class="hidden-xs copy">&copy; <?php echo date('Y'); ?> 幼保連携型 認定こども園 やはた幼稚園</p>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-8"><p class="tel-footer">099-254-0784</p></div>
						<div class="col-sm-4"><p class="time-footer"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>受付時間 9時～17時</p></div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<ul class="unit01">
								<li><a href="<?php echo home_url(); ?>/about">学園について</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/about/greeting" class="sub-list">ごあいさつ</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/about/outline" class="sub-list">学園の概要</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/about/education" class="sub-list">教育方針</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/about/faq" class="sub-list">よくあるご質問</a></li>
								<li><a href="<?php echo home_url(); ?>/life">園での生活</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/life/oneday" class="sub-list">園での1日</a></li>
								<li class="child"><a href="<?php echo home_url(); ?>/life/events" class="sub-list">年間行事</a></li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="unit02">
								<li><a href="<?php echo home_url(); ?>/gallery">ギャラリー</a></li>
								<li><a href="<?php echo home_url(); ?>/boshu">入園案内</a></li>
								<li><a href="<?php echo home_url(); ?>/support">一時預かり・延長保育</a></li>
								<li><a href="<?php echo home_url(); ?>/mama">未就園児教室</a></li>
								<li><a href="<?php echo home_url(); ?>/access">アクセス</a></li>
								<li><a href="<?php echo home_url(); ?>/contact">お問い合わせ</a></li>
								<li><a href="<?php echo home_url(); ?>/info">おしらせ</a></li>
								<li><a href="<?php echo home_url(); ?>/blog">やはたブログ</a></li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="unit03">
								<li><a href="<?php echo home_url(); ?>/open">情報公開・苦情相談</a></li>
								<li><a href="<?php echo home_url(); ?>/privacy">プライバシーポリシー</a></li>
								<li><a href="<?php echo home_url(); ?>/download">ダウンロード</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="visible-xs container">
			<p class="copy">&copy; <?php echo date('Y'); ?> 学校法人丸岡学園 認定こども園 やはた幼稚園</p>
		</div>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>


<?php wp_footer(); ?>
<script src="//webfont.fontplus.jp/accessor/script/fontplus.js?sShks6dWSsw%3D&pm=1&aa=1" charset="utf-8"></script>
<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>

<?php if(is_front_page()): ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vegas.min.js"></script>
	<script>
		$(function(){
			$("#wrap-slider").vegas({
				slides: [
					{ src: "<?php echo get_template_directory_uri(); ?>/img/slider01.jpg" },
					{ src: "<?php echo get_template_directory_uri(); ?>/img/slider02.jpg" },
					{ src: "<?php echo get_template_directory_uri(); ?>/img/slider03.jpg" },
					{ src: "<?php echo get_template_directory_uri(); ?>/img/slider04.jpg" },
					{ src: "<?php echo get_template_directory_uri(); ?>/img/slider05.jpg" }
				],
			    delay: 7000,
			    timer: false,
			    overlay: "<?php echo get_template_directory_uri(); ?>/overlays/01.png",
			    transition: "fade2",
			});
		});
	</script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.simpleTicker.js"></script>
	<script>
		$(function() {
			$.simpleTicker($("#newsticker"),{'effectType':'slide'});
		});
	</script>
<?php endif; ?>

<?php if(is_front_page() || in_category('3')): ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/superbox.min.js"></script>
	<script>
		$(function() {
		    $('.superbox').SuperBox();
		});
	</script>
<?php endif; ?>

<?php
	// 雲をゆらゆら動かす
	if(is_page('education')):
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.yurayura.js"></script>
<script type="text/javascript">
	$(function(){
		$('.cloud').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 1000
		});
		$('.cloud02').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 0
		});
		$('.cloud03').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 500
		});
		$('.cloud04').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 250
		});
		$('.cloud05').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 0
		});
		$('.cloud06').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 1000
		});
		$('.cloud07').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 0
		});
		$('.cloud08').yurayura({
			'move' 		: 5,
			'delay' 	: 100,
			'duration' 	: 500
		});
		$('.cloud09').yurayura({
			'move' 		: 5,
			'delay' 	: 250,
			'duration' 	: 0
		});
	});
</script>
<?php endif; ?>

<?php
	// 郵便番号による住所の自動入力
	if(is_page('contact')):
?>
<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.autotab.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("input[name='郵便番号[data][0]'], input[name='郵便番号[data][1]']").on('change',function( e ) {
			AjaxZip3.zip2addr( '郵便番号[data][0]', '郵便番号[data][1]','pref', 'city', 'adrs' );
		});
		jQuery('input[type=text]').autotab();
	});
</script>
<?php endif; ?>

<?php
	// グーグルマップ
	if(is_page('access')):
?>
	<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCiOgpzSjn2dQKlEfwjQVZMWn0m0CYlTh4"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/map.js"></script>
<?php endif; ?>

</body>
</html>