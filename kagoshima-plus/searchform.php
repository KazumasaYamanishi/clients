<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">詳細検索</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">詳細検索</h4>
            </div>
            <div class="modal-body">
                <form method="get" action="<?php echo home_url('/'); ?>">

                	<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        			<input type="submit" class="btn btn-primary" id="submit" name="s" value="検索する">
                </form>
            </div>
        </div>
    </div>
</div>