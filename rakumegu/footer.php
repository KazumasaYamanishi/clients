
<footer>
	<div class="container">
		<?php
			if(is_mobile()){
				echo '<p class="copy container"><i class="fa fa-copyright" aria-hidden="true"></i> ' . date('Y') . ' らくらくかごしま巡り事業</p>';
			} else {
				echo '<p class="copy container"><i class="fa fa-copyright" aria-hidden="true"></i> ' . date('Y') . ' らくらくかごしま巡り事業</p>';
			}
		?>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>
<?php wp_footer(); ?>



	<?php if(is_front_page()): ?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/slider.js"></script>
	<?php elseif(is_page('access')): ?>
		<!-- <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCCIyBkPW5Dnfb0l7vaGT-BjxElRIIuvoc"></script> -->
		<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/map.js"></script> -->
	<?php endif; ?>



<script src="<?php echo get_template_directory_uri(); ?>/js/myScript.js"></script>
</body>
</html>