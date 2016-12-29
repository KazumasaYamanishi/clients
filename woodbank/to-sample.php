<div class="wrap-footer-contents">

<h2 class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/img/top-contents-title.png" alt="contents"></h2>
<div class="row row-10">
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/personal_maintenance"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/bnr-sesyumente.png" alt="施主様向けメンテナンス" class="lr-center"></a>
    </div>
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/manual"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/komutenmanyu.png" alt="工務店様向け施工マニュアル" class="lr-center"></a>
    </div>
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/alert_works"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/bnr-komusekou.png" alt="工務店様向け施工に際して" class="lr-center"></a>
    </div>
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/att_deck"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/bnr-deki.png" alt="デッキ材の施工" class="lr-center"></a>
    </div>
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/faq"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/bnr-faq.png" alt="よくあるご質問" class="lr-center"></a>
    </div>
    <div class="col-sm-2 col-xsxs-4">
        <a href="<?php echo home_url(); ?>/carry"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/09/bnr-soryo.png" alt="送料・運賃表" class="lr-center"></a>
    </div>
</div>

</div>

<div class="to-sample"><a href="<?php echo home_url(); ?>/sample"><img src="<?php echo get_template_directory_uri(); ?>/img/sample.png" alt="サンプル・送料すべて無料！"></a></div>

<div class="wrap-info-cts">

	<div class="row">
		<div class="col-sm-10 col-sm-push-1">
			<div class="row">
	<div class="col-sm-6"><a href="<?php echo home_url(); ?>/dl"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-dl-footer.png" alt="注文書ダウンロード"></a></div>
	<div class="col-sm-6"><a href="<?php echo home_url(); ?>/contact"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-mail-footer.png" alt="メールお問い合わせ"></a></div>
			</div>
		</div>
	</div>

	<div class="row mt16">
		<div class="col-sm-10 col-sm-push-1">
			<div class="row">
	<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/btn-fax-footer.png" alt="FAX注文"></div>
	<div class="col-sm-6"><img src="<?php echo get_template_directory_uri(); ?>/img/bnr-tel-footer.png" alt="電話受付"></div>
			</div>


		</div>
	</div>

</div>
<?php if(is_mobile()): ?>
<?php else: ?>
	<nav class="navbar wrap-gnav" style="margin-top:20px;">
		<?php
			wp_nav_menu(array(
				'theme_location' 	=> 'g_menu1',
				'container_id'    	=> 'gnav',
				'container_class' 	=> 'collapse navbar-collapse',
				'menu' 				=> 'g_menu_1',
				'menu_class' 		=> 'nav navbar-nav list-inline text-center',
				'walker' 			=> new wp_bootstrap_navwalker()
			));
		?>
	</nav>
<?php endif; ?>
