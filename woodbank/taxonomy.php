<?php get_header(); ?>

<?php //サンプル商品削除
if(isset($_POST['itemdel'])) {
	//echo '削除';
	//echo $_POST['itemdel'];
	foreach ($_SESSION['sample'] as $key => $val) {
		if($val['id'] == $_POST['itemdel']){
			//削除実行
			unset($_SESSION['sample'][$key]);
		}
	}
	//Indexを詰める
	array_values($_SESSION['sample']);
}
?>

<?php //全削除
if(isset($_POST['sedel'])) {unset($_SESSION['sample']);} 
?>

<?php //echo 'ticket:'.$_SESSION['ticket'].' / post ticket:'.$_POST['ticket'];?>
<?php
//リロードで再登録されるの防止
if (isset($_POST['sample'], $_SESSION['ticket'], $_POST['ticket']) && $_SESSION['ticket'] === $_POST['ticket']) {
	unset($_SESSION['ticket']);
	//同じ商品がないか確認
	if(isset($_SESSION['sample'])){
	$w_flg = 0;
		foreach ($_SESSION['sample'] as $key => $val) {
			if($val['id'] == $_POST['item_id']){
				$w_flg++;
				$w_no = $_POST['item_id'];
			}
		}
	}

	if($w_flg == 0){
		if(isset($_POST['item_id'], $_POST['item_name'])) $_SESSION['sample'][] = array('id' => $_POST['item_id'], 'name' => $_POST['item_name'], 'image' => $_POST['item_image']);
	}
}
?>


<?php 
//一回こっきりのチケット
//この値でリロードなのかどうか判定
$_SESSION['ticket'] = md5(uniqid().mt_rand()); 
?>



<?php
//	==================================================
//
//	各タームの商品一覧
//
//	==================================================
?>
<?php

	$taxonomyName 	= get_query_var( 'taxonomy' ); 									// タクソノミー名を取得
	$termName 		= get_query_var( 'term' ); 										// ターム名を取得
	$termNum 		= get_term_by( 'slug', $termName, $taxonomyName )->term_id; 	// ターム名からタームIDを取得

?>

<?php
$title = get_tax_title($taxonomyName);
$cat_info = get_current_term();
$cat_jname = esc_html($cat_info->name);
?>
<div class="category_header text-center">
	<h1><?php echo $title[0];?></h1>
	<h2><span class="title-b"><?php echo $title[0];?></span><span class="title-w"><?php echo $title[1];?></span></h1>
	<h3><?php echo $cat_jname; ?></h2>
	<?php the_term_info($title[0], $cat_jname);?>
</div>


<?php
$order_key="i-number"; $order_jyun="ASC"; $order_by ="meta_value";
/*
if($_GET['sort2']) {$order_key="i-case"; $order_by ="meta_value_num"; $order_jyun="DESC";}
if($_GET['sort3']) {$order_key="i-case"; $order_by ="meta_value_num"; $order_jyun="ASC";}

if($_GET['filter1']) {$order_key="i-case"; $order_by ="meta_value_num"; $order_jyun="ASC";}
*/
	$args 	= array(
		'tax_query' => array(
				array(
					'taxonomy' 	=> $taxonomyName,
					'terms' 	=> array( $termNum ),
				),
		),
		'orderby' => $order_by,
		'meta_key' => $order_key,
		'order' => $order_jyun,
	);

	$query 	= new WP_Query( $args );
	if ( $query->have_posts() ) :
?>



<div class="sort-navi controls">

<?php
if(is_mobile()){
$tab01="品番順▲";
$tab02="C/S単価▼";
$tab03="C/S単価▲";
$tab04="在庫あり";
$tab05="床暖房用";
}else{
$tab01="品番順";
$tab02="ケース単価高い順";
$tab03="ケース単価安い順";
$tab04="在庫あり";
$tab05="床暖房用";
}
?>
<!--
	<button class="sort btn" data-sort="itemno:asc" onclick="setCookie( 'cookie_itemno', '1', 1 );"><?php echo $tab01;?></button>
	<button class="sort btn" data-sort="tanka:desc" onclick="setCookie( 'cookie_tankad', '1', 1 );"><?php echo $tab02;?></button>
	<button class="sort btn" data-sort="tanka:asc" onclick="setCookie( 'cookie_tankaa', '1', 1 );"><?php echo $tab03;?></button>
	<button class="filter btn" data-filter=".zaiko" onclick="setCookie( 'cookie_zaiko', '1', 1 );"><?php echo $tab04;?></button>
	<button class="filter btn" data-filter=".yukadan" onclick="setCookie( 'cookie_yukadan', '1', 1 );"><?php echo $tab05;?></button>
-->
	<button class="sort btn" data-sort="itemno:asc"><?php echo $tab01;?></button>
	<button class="sort btn" data-sort="tanka:desc"><?php echo $tab02;?></button>
	<button class="sort btn" data-sort="tanka:asc"><?php echo $tab03;?></button>
	<button class="filter btn" data-filter=".zaiko"><?php echo $tab04;?></button>
	<button class="filter btn" data-filter=".yukadan"><?php echo $tab05;?></button>



<!-- <button class="filter btn" onclick="$('#item-container').mixItUp('filter','all')">Reset</button> -->
<!-- <button class="filter btn active" data-filter="all">すべて</button> -->


</div>

<div id="item-container" class="item-container">
	<div class="fail-message"><span>お探しの商品は見つかりませんでした。</span></div>
<?php

	while ( $query->have_posts() ) : $query->the_post();

		$iImg 		= SCF::get( 'i-image' );
		$size 		= "full"; // (thumbnail, medium, large, full or custom size)
		$image 		= wp_get_attachment_image_src( $iImg, $size );

		$ttl 		= get_the_title();
		$iNumber 	= SCF::get( 'i-number' );
		$iColor 	= SCF::get( 'i-color' );
		$iDetail 	= SCF::get( 'i-detail' );
		$iGrade 	= SCF::get( 'i-grade' );
		$iPaint 	= SCF::get( 'i-paint' );
		$iSizeD 	= SCF::get( 'i-size-d' );
		$iSizeW 	= SCF::get( 'i-size-w' );
		$iSizeH 	= SCF::get( 'i-size-h' );
		$iCaseU 	= SCF::get( 'i-case-u' );
		$iCaseW 	= SCF::get( 'i-case-w' );
		$iCaseM 	= SCF::get( 'i-case-m' );
		$iCase 		= SCF::get( 'i-case' );
		$iMeter 	= SCF::get( 'i-meter' );
		$iStock 	= SCF::get( 'i-stock' );
		$iNote 		= SCF::get( 'i-note' );
?>


<?php
//	==================================================
//
//	商品の出力
//
//	==================================================

?>
	<article  id="<?php echo $iNumber; ?>" class="mix<?php if(isset($iStock) and $iStock=='あり') echo ' zaiko'; ?><?php if(isset($iStock) and $iStock!='あり') echo ' no-zaiko'; ?><?php if(strpos($ttl,'床暖用') !== false) echo ' yukadan'; ?> clearfix" data-itemno="<?php echo $iNumber; ?>" data-tanka="<?php echo $iCase; ?>">
	<!-- <article> -->
		<h1 class="item-title"><?php echo $ttl;?></h1>
		<div class="row">
			<div class="col-sm-4 col-xsxs-12">
<?php if($image[0]): ?>
		<img src="<?php echo $image[0]; ?>" alt="<?php echo $ttl; ?>" class="lr-center">
<?php else: ?>
		<img src="<?php echo get_template_directory_uri(); ?>/img/items/default.jpg" alt="<?php echo $ttl; ?>" class="lr-center">
<?php endif; ?>

<?php if(!is_mobile()): ?>
				<div class="wrap-btn">
					<form action="" method="post" style="display:none;">
						<input type="hidden" name="item_id" value="<?php echo $iNumber; ?>" />
						<input type="hidden" name="item_name" value="<?php echo $ttl;?>" />
						<input type="hidden" name="item_image" value="<?php echo $image[0]; ?>">
						<input type="hidden" name="ticket" value="<?php echo $_SESSION['ticket']; ?>">
						<button  class="btn btn-primary btn-block btn-lg" type='submit' name='sample' val='1'>サンプル請求</button>
					</form>
					<a  class="btn btn-primary btn-block btn-lg" 
					href="<?php echo home_url(); ?>/sample/?item_id=<?php echo $iNumber; ?>
					&item_name=<?php echo $ttl; ?>
					&item_image=<?php echo $image[0]; ?>
					">サンプル請求</a>
					<a  class="btn btn-default btn-block btn-lg" 
					href="<?php echo home_url(); ?>/contact-item/?s1i=<?php echo $iNumber; ?>
					&s1n=<?php echo $ttl; ?>
					"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>この商品についてお問い合わせ</a>
				</div>
<?php endif; ?>

			</div>
			<div class="col-sm-8 col-xsxs-12">
				<table class="table catitem-list">
					<tbody>
						<tr>
							<th>商品番号</th>
							<td><?php echo $iNumber; ?></td>
						</tr>
						<tr>
							<th>グレード</th>
							<td><?php echo $iGrade; ?></td>
						</tr>
						<tr>
							<th>塗装状態</th>
							<td><?php echo $iPaint; ?></td>
						</tr>
						<tr>
							<th>サイズ</th>
							<td>長さ<?php if(!empty($iSizeD)) echo number_format($iSizeD); ?>mm × 巾<?php if(!empty($iSizeW)) echo number_format($iSizeW); ?>mm × 厚さ<?php if(!empty($iSizeH)) echo number_format($iSizeH); ?>mm</td>
						</tr>
						<tr>
							<th><?php if(is_mobile()): echo "C/Sあたりの<br>入数･重量･平米"; else: echo "1ケースあたりの<br>入数・重量・平米"; endif;?></th>
							<td><?php if(!empty($iCaseU)) echo number_format($iCaseU); ?>枚 <?php if(!empty($iCaseW)) echo number_format($iCaseW); ?>kg <?php if(!empty($iCaseM)) echo number_format($iCaseM); ?>m<sup>2</sup></td>
						</tr>
						<tr>
							<th>在庫</th>
							<td><?php echo $iStock; ?><?php if(!empty($iNote)): ?> <span class="text-danger">※<?php echo $iNote; ?></span><?php endif; ?></td>
						</tr>
						<tr>
							<th>
<?php 
if(is_mobile()){ 
	echo "C/S単価"; 
	if(!empty($iMeter)) echo '<br>(&#13217;単価)';
} else { 
	echo "ケース単価"; 
	if(!empty($iMeter)) echo '(平米単価)';
}
?>

</th>

							<td class="text-danger"><strong><?php if(!empty($iCase)) echo number_format($iCase); ?>円<br class="visible-xs-block" /><?php if(!empty($iMeter)) echo '('.number_format($iMeter).'円)'; ?></strong></td>
						</tr>
					</tbody>
				</table>

<?php if(is_mobile()): ?>
				<div class="wrap-btn">
					<form action="" method="post" style="display:none;">
						<input type="hidden" name="item_id" value="<?php echo $iNumber; ?>" />
						<input type="hidden" name="item_name" value="<?php echo $ttl;?>" />
						<input type="hidden" name="item_image" value="<?php echo $image[0]; ?>">
						<input type="hidden" name="ticket" value="<?php echo $_SESSION['ticket']; ?>">
						<button  class="btn btn-primary btn-block btn-lg" type='submit' name='sample' val='1'>サンプル請求</button>
					</form>
					<a  class="btn btn-primary btn-block btn-lg" 
					href="<?php echo home_url(); ?>/sample/?item_id=<?php echo $iNumber; ?>
					&item_name=<?php echo $ttl; ?>
					&item_image=<?php echo $image[0]; ?>
					"><i class="fa fa-truck fa-fw" aria-hidden="true"></i>サンプル請求</a>
					<a  class="btn btn-default btn-block btn-lg" 
					href="<?php echo home_url(); ?>/contact-item/?s1i=<?php echo $iNumber; ?>
					&s1n=<?php echo $ttl; ?>
					"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>商品お問い合わせ</a>
				</div>
<?php endif; ?>

			</div>
		</div>
	</article>
<?php
	endwhile;
?>
<div class="gap"></div>
<div class="gap"></div>

</div><!-- #item-container .item-container -->


<?php
	endif;
	wp_reset_query();
?>


<?php
//	==================================================
//
//	注文書 & お問い合わせ
//
//	==================================================
?>
<?php get_template_part( 'to-sample' ); //サンプル請求バナー等表示 to-sample.php ?>

</div><!-- end of main -->
<div class="side s-height-some"><?php get_sidebar(); ?></div>
</div><!-- .container main-container -->


<script type="text/javascript">
function setCookie( $cookieName, $cookieValue, $days ){
    var $dateObject = new Date();
    $dateObject.setTime( $dateObject.getTime() + ( $days*24*60*60*1000 ) );
    var $expires = "expires=" + $dateObject.toGMTString();
    document.cookie = $cookieName + "=" + $cookieValue + "; " + $expires;
}

function getCookie( $cookieName ){
    var $cookies = document.cookie.split(';');
    for( var $i=0; $i < $cookies.length; $i++ ){
        var $cookie = $cookies[$i].trim().split( '=' );
        if( $cookie[0] == $cookieName ){
            return $cookie[1];
        }
    }
    return "";
}

function deleteCookie( $cookieName ){
    document.cookie = $cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

function displayCookie( $cookieName, $output ){
    var $cookieValue = getCookie( $cookieName );
    document.getElementById( $output ).innerHTML = $cookieValue;
}
</script>

<?php //↓サンプル表示用で追加 ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.3.1/jquery.cookie.min.js"></script>
<!--
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.utility-kit.js"></script>
<script>
$('form , .sort-menu').keepPosition();
</script>
-->
<style>
/*
body {animation: fadeIn 0.5s ease 0s 1 normal;-webkit-animation: fadeIn 0.5s ease 0s 1 normal;}
@keyframes fadeIn {0% {opacity: 0} 100% {opacity: 1}}
@-webkit-keyframes fadeIn {0% {opacity: 0}100% {opacity: 1}}
*/
</style>

<?php //アラート
	if($w_flg > 0){
		echo '<script>alert("同じ商品が選択されています '.$w_no.'"); </script>';
	}
	if($over_flg == 1){
		echo '<script>alert("サンプル請求は３枚までとなっております"); </script>';
	}
?>

<script type="text/javascript">
function setCookie( $cookieName, $cookieValue, $days ){
    var $dateObject = new Date();
    $dateObject.setTime( $dateObject.getTime() + ( $days*24*60*60*1000 ) );
    var $expires = "expires=" + $dateObject.toGMTString();
    document.cookie = $cookieName + "=" + $cookieValue + "; " + $expires;
}

function getCookie( $cookieName ){
    var $cookies = document.cookie.split(';');
    for( var $i=0; $i < $cookies.length; $i++ ){
        var $cookie = $cookies[$i].trim().split( '=' );
        if( $cookie[0] == $cookieName ){
            return $cookie[1];
        }
    }
    return "";
}

function deleteCookie( $cookieName ){
    document.cookie = $cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

function displayCookie( $cookieName, $output ){
    var $cookieValue = getCookie( $cookieName );
    document.getElementById( $output ).innerHTML = $cookieValue;
}
</script>
<?php 
echo $_GET['jid'];
?>
<?php if($_GET['jid']):?>

<script>
$(function(){
setTimeout(function(){
var position = $("<?php echo "#".$_GET['jid'];?>").offset().top;
$("html,body").animate({
    scrollTop : position-100
}, {
    queue : false
});
},800);
});
</script>
<?php endif;?>


<?php // ↑サンプル表示用で追加 ?>

<?php get_footer(); ?>

