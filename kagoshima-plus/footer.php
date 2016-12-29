<aside>
	<div class="wrap-sns bg-base-sns">
		<div class="container">
			<ul class="list-inline text-center">
				<li>
					<a href="https://twitter.com/tj_kagoshima" target="blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<li>
					<a href="http://www.facebook.com/TJKagoshima" target="blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<li>
					<a href="https://instagram.com/explore/tags/tj%E3%82%AB%E3%82%B4%E3%82%B7%E3%83%9E/" target="blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="wrap-footer-bnr">
		<div class="container">
			<?php dynamic_sidebar('footer-widget'); ?>
		</div>
	</div>
	<?php if(!is_mobile()) : ?>
		<div class="wrap-footer-page-link">
			<div class="container">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'g_menu_company',
						'container_id'    => 'f_menu_company',
						'container_class' => '',
						'menu' => 'f_menu_company',
						'menu_id' => '',
						'menu_class'=> 'nav navbar-nav',
						'walker' => new wp_bootstrap_navwalker(),
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					));
				?>
			</div>
		</div>
	<?php endif; ?>
</aside>
<footer>
	<div class="container">
		<p class="copy">COPYRIGHT 2016 kagoshima plus</p>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>



<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/slider.js"></script>
<?php // Infinite Scroll ?>
<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/select-event.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/jquery.infinitescroll.min.js"></script> -->



</body>
</html>