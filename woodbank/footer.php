<footer class="clearfix">
	<div class="container text-center">
		<p class="company-name">WOOD BANK ウッドバンク</p>
		<p class="company-info">〒897-1123 鹿児島県南さつま市加世田高橋1963-5 TEL 0120-022-730 FAX 0993-53-8308</p>
		<p class="copy">Copyright &copy; <?php echo date('Y'); ?> WOOD BANK ウッドバンク All Rights Reserved.</p>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>
<?php wp_footer(); ?>



	<?php if(is_page('access')): ?>
		<script src="//maps.googleapis.com/maps/api/js?key="></script>
		<script src="<?php bloginfo('template_url'); ?>/js/map.js"></script>
	<?php endif; ?>



<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>


<?php if(is_page('sample')): ?>
	<script type="text/javascript">

		// "削除"がクリックされたら、その行ごと削除する
		function delThisTR(val){
		    $(val).closest("tr").fadeOut(300, function() { $(this).remove(); });
		}

		// セッションに保存されているその配列を削除する
		(function($){
			$( '.btn-remove' ).on( 'click', function(){

				var trnum 		= $(this).parents('tr');
				var itemName 	= trnum.find('td:eq(0)').html();

			    $.ajax({
			        type: 'POST',
			        url: ajaxurl,
			        data: {
			            'action' : 'my_ajax_get_posts',
			            'itemName' : itemName,
			        },
			        success: function( response ){
			            // alert( response );
			        }
			    });
			    return false;
			});
		})(jQuery)
	</script>
<?php endif; ?>


</body>
</html>