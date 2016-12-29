

<?php
//リロードで再登録されるの防止

/*
echo 'ID:'.$_GET['item_id'] .'<br>';
echo 'NAME:'.$_GET['item_name'] .'<br>';
echo 'IMAGE:'.$_GET['item_image'] .'<br>';
*/
	if(isset($_GET['item_id'], $_GET['item_name'])){
	if(isset($_SESSION['sample'])){
	$w_flg = 0;
		foreach ($_SESSION['sample'] as $key => $val) {
			if($val['id'] == $_GET['item_id']){
				$w_flg++;
				$w_no = $_GET['item_id'];
			}
		}
	}


	if($w_flg > 0){
		echo '<script>alert("同じ商品が選択されています '.$w_no.'"); </script>';
	}

	if($w_flg == 0){
		if(isset($_GET['item_id'], $_GET['item_name'])) $_SESSION['sample'][] = array('id' => $_GET['item_id'], 'name' => $_GET['item_name'], 'image' => $_GET['item_image']);
	}
}
?>





<?php //サンプル商品削除

$self_url = home_url().'/sample/';

//echo ' ITEM:'.$_POST['itemdel'];
if(isset($_GET['itemdel'])) {
	foreach ($_SESSION['sample'] as $key => $val) {
		if($val['id'] == $_GET['itemdel']){
			//削除実行
			unset($_SESSION['sample'][$key]);
		}
	}
	//Indexを詰める
	array_values($_SESSION['sample']);
}
?>




<?php //商品が選ばれていない場合
if(isset($_SESSION['sample']) and count($_SESSION['sample']) > 3 ) {
echo '<div class="alert alert-info text-center" role="alert"><p>カットサンプルは３枚までとなっております。</p></div>';
}
?>

<?php //商品が選ばれていない場合
if(!isset($_SESSION['sample']) or !$_SESSION['sample'] ) {
echo '<div class="alert alert-info text-center" role="alert"><p>サンプル商品をお選び下さい</p></div>';
?>
<div id="sample-cart" class="row">

	<div class="col-sm-6 item-list">
		<h1><span class="title-b">フローリング</span><span class="title-w">Flooring</span></h1>
		
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
				<li><a href="<?php echo home_url() . '/cat_flooring/' . $value->slug; ?>"><?php echo $value->name; ?><span class="badge"><?php echo $value->count; ?></span></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="col-sm-6 item-list">
		<h1><span class="title-b">羽目板</span><span class="title-w">Paneling</span></h1>
		
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
				<li><a href="<?php echo home_url() . '/cat_paneling/' . $value->slug; ?>"><?php echo $value->name; ?><span class="badge"><?php echo $value->count; ?></span></a></li>
			<?php endforeach; ?>
		</ul>

		<h1><span class="title-b">デッキ材</span><span class="title-w">Decking</span></h1>
		
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
				<li><a href="<?php echo home_url() . '/cat_decking/' . $value->slug; ?>"><?php echo $value->name; ?><span class="badge"><?php echo $value->count; ?></span></a></li>
			<?php endforeach; ?>
		</ul>

		<h1><span class="title-b">その他</span><span class="title-w">Other</span></h1>
		
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
				<li><a href="<?php echo home_url() . '/cat_other/' . $value->slug; ?>"><?php echo $value->name; ?><span class="badge"><?php echo $value->count; ?></span></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<?php
}
?>

<?php
if($_GET['fm']==1) {
	echo '<style>#sample-form{display:block;} #sample-link{display:none;}</style>';
}else{
	echo '<style>#sample-form{display:none;} #sample-link{display:block;}</style>';
}
?>
<?php
// ==================================================
//	セッションに保存されている内容を表示
// ==================================================
if(isset($_SESSION['sample']) && $_SESSION['sample']){
	echo '<div id="sample-cart" class="clearfix">';
	echo '<table class="table sample-table"><thead><tr><th class="td-image">画像</th><th class="td-id">ID</th><th>商品名</th><th class="td-del">削除</th></tr></thead>';
	echo '<tbody>';
	$opcnt=1;
	foreach ($_SESSION['sample'] as $key=>$val){
		echo '<tr><td><img class="sample-image" src="'.$val['image'].'"></td>';
		echo '<td>'.$val['id'].'</td>';
		echo '<td>'.$val['name'].'</td>';
		echo '<td class="text-center">';
		echo '<a  class="btn btn-danger btn-mini" href="'.$self_url.'?itemdel='.$val['id'].'"><i class="fa fa-times fa-fw" aria-hidden="true"></i>削除</a>';
		echo '</td></tr>';
		if($opcnt==1) $opt = '&s1i='.$val['id'].'&s1n='.$val['name'];
		if($opcnt==2) $opt .= '&s2i='.$val['id'].'&s2n='.$val['name'];
		if($opcnt==3) $opt .= '&s3i='.$val['id'].'&s3n='.$val['name'];
		$opcnt++;
	}
	echo '</tbody>';
	echo '</table>';
?>

<?php
if(isset($_SESSION['sample']) and count($_SESSION['sample']) > 3 ) {
echo '<div class="alert alert-info text-center" role="alert"><p>カットサンプルは３枚までとなっております。</p></div>';
}else{
?>
<a id="sample-link" class="btn btn-block btn-info" href="<?php echo $self_url; ?>?fm=1<?php echo $opt;?>">上記商品のカットサンプルを請求する</a>
<?php
}
?>

	</div>
<?php
}
?>
