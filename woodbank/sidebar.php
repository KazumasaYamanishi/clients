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
		<h1>フリー板</h1>
		<h2>Free</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_free'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_free/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="side-list">
		<h1>框・踏板・巾木</h1>
		<h2>Decking</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_frame'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_frame/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
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
	<div class="side-list">
		<h1>ファニチャー</h1>
		<h2>Furniture</h2>
		<ul class="list-unstyled">
			<?php
				$taxonomies = array(
					'cat_furniture'
				);
				$args = array(
					'get' => 'all'
				);
				$terms = get_terms($taxonomies, $args);
				foreach($terms as $key => $value):
			?>
				<li><a href="<?php echo home_url() . '/cat_furniture/' . $value->slug; ?>"><?php echo $value->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="wrap-widget">
		<ul>
			<?php dynamic_sidebar( 'category_widget' ); ?>
		</ul>
	</div>



</div>