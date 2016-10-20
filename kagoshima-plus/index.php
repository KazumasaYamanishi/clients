<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">
	<?php if(function_exists('create_searchform')){ ?>
		<div id="feas-result">
			<?php if(is_search()){ ?>
				<?php if($add_where !=null || $w_keyword !=null): ?>
					「<?php search_result(); ?>」の条件による検索結果 <?php feas_count_posts(); ?> 件
				<?php else: ?>
					<h3>検索条件が指定されていません。</h3>
				<?php endif; ?>
			<?php } else { ?>
				現在の登録件数：<?php feas_count_posts(); ?> 件
			<?php } ?>
		</div>
	<?php } ?>
</div>

<?php get_footer(); ?>