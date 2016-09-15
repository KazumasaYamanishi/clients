<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h5>学校法人丸岡学園 幼保連携型認定こども園<span class="name-footer">やはた幼稚園</span></h5>
				<address>〒890-0056 鹿児島市下荒田4丁目19-10</address>
				<p class="hidden-xs copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
			</div>
			<div class="col-sm-6">
				<p class="tel-footer">099-254-0784</p>
				<p class="">受付時間<br>9時～17時</p>
				<div class="row">
					<div class="col-sm-4">
						<ul>
							<li><a href="<?php echo home_url(); ?>/about">学園について</a></li>
							<li><a href="<?php echo home_url(); ?>/about/outline" class="sub-list">学園の概要</a></li>
							<li><a href="<?php echo home_url(); ?>/about/education" class="sub-list">教育方針</a></li>
							<li><a href="<?php echo home_url(); ?>/about/greeting" class="sub-list">ごあいさつ</a></li>
							<li><a href="<?php echo home_url(); ?>/life">園での生活</a></li>
							<li><a href="<?php echo home_url(); ?>/life/events" class="sub-list">年間行事</a></li>
							<li><a href="<?php echo home_url(); ?>/life/oneday" class="sub-list">園での1日</a></li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul>
							<li><a href="<?php echo home_url(); ?>/gallery">ギャラリー</a></li>
							<li><a href="<?php echo home_url(); ?>/boshu">入園案内</a></li>
							<li><a href="<?php echo home_url(); ?>/support">一時預かり・延長保育</a></li>
							<li><a href="<?php echo home_url(); ?>/mama">未就園児教室</a></li>
							<li><a href="<?php echo home_url(); ?>/access">アクセス</a></li>
							<li><a href="<?php echo home_url(); ?>/contact">お問い合わせ</a></li>
							<li><a href="<?php echo home_url(); ?>/blog">おしらせ</a></li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul>
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
		<p class="copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>


<?php wp_footer(); ?>
<script src="//webfont.fontplus.jp/accessor/script/fontplus.js?sShks6dWSsw%3D&pm=1&aa=1" charset="utf-8"></script>
<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>
<?php if(is_front_page()): ?>
	<script src="<?php bloginfo('template_url'); ?>/js/superbox.min.js"></script>
	<script>
		$(function() {
		    $('.superbox').SuperBox();
		});
	</script>
<?php endif; ?>
</body>
</html>