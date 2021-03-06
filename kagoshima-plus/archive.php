<?php get_header(); ?>
<?php // タイトル表示 ?>
<?php get_template_part( 'title' ); ?>
<?php // ページ内容 ?>
<div class="container">
    <div class="row row-40">
        <div class="col-sm-8">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <article <?php post_class(); ?> id="post-
                <?php the_ID(); ?>">
                <div class="inner">
                    <p class="wrap-blog-meta">
                        <?php the_time('Y.m.d'); ?>
                    </p>
                    <h1 class="title-arc"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    
                </div>

            </article>
  <?php endwhile; endif; ?>
        </div>
       <?php get_sidebar(); ?>
    </div>
   
    <div class="text-center">
        <?php nofx_wp_pagenavi(); ?>
    </div>
</div>
<?php get_footer(); ?>
