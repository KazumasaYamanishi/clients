<div class="side col-sm-3">



	<?php get_search_form(); ?>



	<div class="side-list">
		<h1>フローリング</h1>
		<h2>Flooring</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_flooring'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_flooring/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="side-list">
		<h1>羽目板</h1>
		<h2>Paneling</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_paneling'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_paneling/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="side-list">
		<h1>デッキ材</h1>
		<h2>Decking</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_decking'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_decking/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="side-list">
		<h1>その他</h1>
		<h2>Other</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_other'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_other/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="wrap-widget">
		<ul>
			<?php dynamic_sidebar( 'category_widget' ); ?>
		</ul>
	</div>



</div>