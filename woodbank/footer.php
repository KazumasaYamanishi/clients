<footer id="footer" class="clearfix">
	<div class="container text-center">
		<p class="company-name">WOOD BANK ウッドバンク</p>
		<p class="company-info">〒897-1123 <br class="visible-xs-block" />鹿児島県南さつま市加世田高橋1963-5<br class="visible-xs-block" /> TEL 0120-022-730<br class="visible-xs-block" /> FAX 0993-53-8308</p>
		<p class="copy">Copyright &copy; <?php echo date('Y'); ?> WOOD BANK ウッドバンク<span class="hidden-xs"> All Rights Reserved.</span></p>
	</div>
</footer>
<!-- end of #wrapper --></div>
<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>

<?php wp_footer(); ?>

	<?php if(is_page('access')): ?>
		<script src="//maps.googleapis.com/maps/api/js?key="></script>
		<script src="<?php bloginfo('template_url'); ?>/js/map.js"></script>
	<?php endif; ?>

<?php //ソート・フィルター ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.mixitup.js"></script>
<script>
$(function(){
  $('#item-container').mixItUp({
    load: {
      filter: 'all' 
//filter: ".zaiko",
//sort: "itemno:asc"
    },
    controls: {
      toggleFilterButtons: true,
      toggleLogic: 'and'
    },
    callbacks: {
      onMixEnd: function(state){
        console.log(state.activeFilter)
      }
    }
  });
});
</script>


<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>

<?php if(is_page('sample')): ?>
<script>
$(".dist").prop('disabled', true);
</script>

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

<script type="text/javascript">
jQuery(function( $ ) {
    jQuery( 'input[name="zip2"]' ).keyup( function( e ) {
        AjaxZip3.zip2addr('zip1','zip2','address1','address2');
    } )
} );
</script>

<?php endif; ?>

<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.offcanvas.min.js"></script>
<script>
//リサイズ・回転時メニュー表示クラスを外す
$(document).ready(function(){
	window.onresize = function(){
		$('#navbar-toggle').removeClass('is-open');
		$('body').removeClass('offcanvas-stop-scrolling');
	};
});
</script>


</body>
</html>