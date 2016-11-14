<?php
	/*
		Template Name: アーカイブ グルメ
	*/

			function DB_account() {
				$value['url'] 	= 'localhost';
				$value['user'] 	= '0068-5252';
				$value['pass'] 	= 'emulator709';
				$value['db'] 	= 'database';
				return $value;
			}
			function DB_connect() {
				$account 	= DB_account();
				$link 		= mysql_connect( $account['url'], $account['user'], $account['pass'] ) or die( "MySQLへの接続に失敗しました。" );
				$selectdb 	= mysql_select_db( $account['db'], $link ) or die( "データベースの選択に失敗しました。" );
				return $link;
			}
			function query( $query ) {
				$db 	= DB_connect();
				$query 	= mb_convert_kana( $query, "asKV" );
				$retun 	= mysql_query( $query, $db );
				if( mysql_errno( $db ) ) return False;
				return $retun;
			}


			$postID = array();
			$i = 0;
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$postID[$i] = get_the_ID();
					$postID[$i]['status'] = post_custom('member-status');
					$i++;
				endwhile;
			endif;
			// 今日の日付を取得
			$today = date("Y-m-d H:i:s");
			$i = 0;
			foreach ($postID as $value) {
				$date = query( "SELECT * FROM wpf0uwxjbk_postmeta WHERE post_id = $value AND `meta_key` = 'gourmet-rand'" );
				// ステータス取得
				$setRandom = mt_rand( 1, 5000 );
				if( $date && mysql_num_rows( $date ) ) {
					while( $ary = mysql_fetch_array( $date ) ) {

						// echo '<pre>';
						// echo var_dump($ary);
						// echo '</pre>';
						// randomdate（ランダムの数値を入れた日付）を取得
						$randomdate = $ary['gourmet-date'];
						if( $randomdate != $today ) {
							$setDate 		= $today;
							$sql 			= "UPDATE wpf0uwxjbk_postmeta SET `meta_value` = $setRandom WHERE post_id = $value AND `meta_key` = 'gourmet-rand'";
							$result_flag 	= mysql_query( $sql );
							if( !$result_flag ) {
								die( 'INSERTクエリーに失敗しました。' . mysql_error() );
							}
						}
					}
				}
			}
?>

<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">

	<div id="debug-area"></div>

	<?php
		// 検索フォーム
		// ==================================================
		// 1．詳細検索ボタンをクリック
		// 2．Bootstrapのモーダル画面
		// 3．入力後、検索ボタンをクリック
		// 4．検索結果ページ（search.php）を表示
	?>

	<div class="wrap-search-detail">
		<div class="row row-0">
			<div class="col-xs-8">
				<select name="select-gourmet" id="select-gourmet" class="form-control">
					<option value="default" selected>おすすめ順</option>
					<option value="keyword-c">クーポンあり</option>
					<option value="keyword-l">ランチ</option>
					<option value="area-kagoshima">鹿児島市エリア</option>
					<option value="area-aira">姶良エリア</option>
					<option value="area-kirishima">霧島エリア</option>
					<option value="area-hokusatsu">北薩エリア</option>
					<option value="area-nakasatsu">中薩エリア</option>
					<option value="area-nansatsu">南薩エリア</option>
					<option value="area-osumi">大隅エリア</option>
					<option value="area-rito">離島エリア</option>
				</select>
			</div>
			<div class="col-xs-4">
				<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">詳細検索</button>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">詳細検索</h4>
				</div>
				<div class="modal-body">
					<form method="get" action="<?php echo home_url('/'); ?>">
						<?php echo do_shortcode('[cftsearch format=1 search_label="上記内容で検索する"]'); ?>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="extra-error alert alert-danger">お探しの記事が見つかりませんでした。</div>
	<div id="extra-area">
	<?php

		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

			echo '<p>' . get_the_title() . '</p>';
			echo '<p>' . post_custom('gourmet-rand') . '</p>';

			endwhile;
		endif;
	?>
	</div>

</div>

<?php get_footer(); ?>