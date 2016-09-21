<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<h5 class="clearfix">かわなべ薬品<span class="tel-footer tel_link">TEL.099-267-5058</span></h5>
				<address>〒891-0141 鹿児島県鹿児島市谷山中央7-25-5</address>
				<p><span class="strong">営業時間</span>9:00～19:00<span class="strong">定休日</span>日曜・祝日</p>
				<p><span class="strong">バス</span>本町バス停より徒歩5分<span class="strong">JR</span>慈眼寺駅より徒歩10分<span class="strong">駐車場</span>4台</p>
			</div>
			<div class="col-sm-4 wrap-btn">
				<div class="row row-10">
					<div class="col-xs-6">
						<a href="<?php echo home_url(); ?>/contact" class="btn btn-block">お問い合わせ</a>
					</div>
					<div class="col-xs-6">
						<a href="<?php echo home_url(); ?>/access" class="btn btn-block">アクセス</a>
					</div>
				</div>
			</div>
			<div class="hidden-xs col-sm-4">
				<div class="row">
					<div class="col-sm-6">
						<ul>
							<li><a href="<?php echo home_url(); ?>">HOME</a></li>
							<li><a href="<?php echo home_url(); ?>/cause">不妊の原因</a></li>
							<li><a href="<?php echo home_url(); ?>/about">妊活について</a></li>
							<li><a href="<?php echo home_url(); ?>/feature">かわなべ薬品の特徴</a></li>
							<li><a href="<?php echo home_url(); ?>/first">初めての方</a></li>
							<li><a href="<?php echo home_url(); ?>/faq">Q&amp;A</a></li>
						</ul>
					</div>
					<div class="col-sm-6">
						<ul>
							<li><a href="<?php echo home_url(); ?>/voice">ご利用者の声</a></li>
							<li><a href="<?php echo home_url(); ?>/info">インフォメーション</a></li>
							<li><a href="<?php echo home_url(); ?>/access">アクセス</a></li>
							<li><a href="<?php echo home_url(); ?>/contact">お問い合わせ</a></li>
							<li><a href="<?php echo home_url(); ?>/privacy">プライバシーポリシー</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<p class="copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>


<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>



<?php
	// 郵便番号による住所の自動入力
	if(is_page('contact')):
?>
<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.autotab.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("input[name='郵便番号[data][0]'], input[name='郵便番号[data][1]']").on('change',function( e ) {
			AjaxZip3.zip2addr( '郵便番号[data][0]', '郵便番号[data][1]','pref', 'city', 'adrs' );
		});
		jQuery('input[type=text]').autotab();
	});
</script>
<?php endif; ?>



</body>
</html>