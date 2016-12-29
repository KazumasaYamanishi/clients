<?php if(is_mobile()): ?>
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#search-modal">
	<i class="fa fa-search fa-fw" aria-hidden="true"></i>&nbsp;記事検索
</button>
<?php else: ?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url('/') ); ?>">
	<input type="search" placeholder="記事の検索" name="s" class="searchfield" value="">
	<input type="submit" value="&#xf002;" alt="検索" title="検索" class="searchsubmit">
</form>
<?php endif; ?>