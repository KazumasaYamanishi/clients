<?php
	/*
		Template Name: アーカイブ グルメ
	*/
?>

<?php get_header(); ?>

<?php
	// タイトル表示
	// ==================================================
	get_template_part( 'title' );
?>

<div class="container">

	<?php
		// 検索フォーム
		// ==================================================
	?>
		<div class="search-form">
			<div class="row row-0">
				<div class="col-xs-5">
					<div class="box-select" id="search01">
						<h4>目的</h4>
						<div class="wrap-search-on-detaile">
							<button type="button" class="close close-icon"><span aria-hidden="true">×</span></button>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="genre01" id="genre0101" value="和食"><label for="genre0101">和食</label></li>
								<li><input type="checkbox" name="genre01" id="genre0102" value="洋食"><label for="genre0102">洋食</label></li>
								<li><input type="checkbox" name="genre01" id="genre0103" value="レストラン"><label for="genre0103">レストラン</label></li>
								<li><input type="checkbox" name="genre01" id="genre0104" value="ホテル・旅館"><label for="genre0104">ホテル・旅館</label></li>
								<li><input type="checkbox" name="genre01" id="genre0105" value="寿司"><label for="genre0105">寿司</label></li>
								<li><input type="checkbox" name="genre01" id="genre0106" value="鹿児島の郷土料理"><label for="genre0106">鹿児島の郷土料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0107" value="郷土料理（鹿児島以外）"><label for="genre0107">郷土料理（鹿児島以外）</label></li>
								<li><input type="checkbox" name="genre01" id="genre0108" value="創作料理"><label for="genre0108">創作料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0109" value="中華料理"><label for="genre0109">中華料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0110" value="韓国料理"><label for="genre0110">韓国料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0111" value="フランス料理"><label for="genre0111">フランス料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0112" value="イタリア料理"><label for="genre0112">イタリア料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0113" value="韓国・アジア・エスニック料理"><label for="genre0113">韓国・アジア・エスニック料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0114" value="居酒屋"><label for="genre0114">居酒屋</label></li>
								<li><input type="checkbox" name="genre01" id="genre0115" value="魚介・海鮮料理"><label for="genre0115">魚介・海鮮料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0116" value="うなぎ"><label for="genre0116">うなぎ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0117" value="天ぷら・串揚げ"><label for="genre0117">天ぷら・串揚げ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0118" value="しゃぶしゃぶ"><label for="genre0118">しゃぶしゃぶ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0119" value="とんかつ"><label for="genre0119">とんかつ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0120" value="焼き鳥・鳥料理"><label for="genre0120">焼き鳥・鳥料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0121" value="焼肉・ホルモン"><label for="genre0121">焼肉・ホルモン</label></li>
								<li><input type="checkbox" name="genre01" id="genre0122" value="もつ鍋・鍋料理"><label for="genre0122">もつ鍋・鍋料理</label></li>
								<li><input type="checkbox" name="genre01" id="genre0123" value="ダイニングバー・お酒"><label for="genre0123">ダイニングバー・お酒</label></li>
								<li><input type="checkbox" name="genre01" id="genre0124" value="餃子"><label for="genre0124">餃子</label></li>
								<li><input type="checkbox" name="genre01" id="genre0125" value="ステーキ"><label for="genre0125">ステーキ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0126" value="食堂"><label for="genre0126">食堂</label></li>
								<li><input type="checkbox" name="genre01" id="genre0127" value="うどん・そば"><label for="genre0127">うどん・そば</label></li>
								<li><input type="checkbox" name="genre01" id="genre0128" value="ラーメン"><label for="genre0128">ラーメン</label></li>
								<li><input type="checkbox" name="genre01" id="genre0129" value="カレー"><label for="genre0129">カレー</label></li>
								<li><input type="checkbox" name="genre01" id="genre0130" value="パスタ・ピザ"><label for="genre0130">パスタ・ピザ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0131" value="お好み焼き・たこ焼き"><label for="genre0131">お好み焼き・たこ焼き</label></li>
								<li><input type="checkbox" name="genre01" id="genre0132" value="カフェ・喫茶店"><label for="genre0132">カフェ・喫茶店</label></li>
								<li><input type="checkbox" name="genre01" id="genre0133" value="ケーキ・スイーツ"><label for="genre0133">ケーキ・スイーツ</label></li>
								<li><input type="checkbox" name="genre01" id="genre0134" value="パン"><label for="genre0134">パン</label></li>
								<li><input type="checkbox" name="genre01" id="genre0135" value="その他"><label for="genre0135">その他</label></li>
							</ul>
							<button type="button" class="close close-btn">閉じる</button>
						</div>
						<button type="button" class="show-ul"><span aria-hidden="true">▼</span></button>
					</div>
				</div>
				<div class="col-xs-2">
					<p>x</p>
				</div>
				<div class="col-xs-5">
					<div class="wrap-search-area">
						<div class="box-select" id="search02">
							<h4>鹿児島市エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area01" id="area0101" value="鹿児島市全域"><label for="area0101">鹿児島市全域</label></li>
								<li><input type="checkbox" name="area01" id="area0102" value="天文館周辺"><label for="area0102">天文館周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0103" value="鹿児島中央駅周辺"><label for="area0103">鹿児島中央駅周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0104" value="鹿児島市役所周辺"><label for="area0104">鹿児島市役所周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0105" value="城南町〜泉町周辺"><label for="area0105">城南町〜泉町周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0106" value="鹿児島駅周辺"><label for="area0106">鹿児島駅周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0107" value="吉野町周辺"><label for="area0107">吉野町周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0108" value="草牟田・伊敷周辺"><label for="area0108">草牟田・伊敷周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0109" value="荒田周辺"><label for="area0109">荒田周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0110" value="鴨池・与次郎周辺"><label for="area0110">鴨池・与次郎周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0111" value="紫原・桜ヶ丘周辺"><label for="area0111">紫原・桜ヶ丘周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0112" value="新栄町・宇宿周辺"><label for="area0112">新栄町・宇宿周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0113" value="中山周辺"><label for="area0113">中山周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0114" value="谷山・平川町周辺"><label for="area0114">谷山・平川町周辺</label></li>
								<li><input type="checkbox" name="area01" id="area0115" value="鹿児島市郊外全般"><label for="area0115">鹿児島市郊外全般</label></li>
							</ul>
							<h4 class="search-off">姶良エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area02" id="area0201" value="姶良市全域"><label for="area0201">姶良市全域</label></li>
								<li><input type="checkbox" name="area02" id="area0202" value="姶良市（旧姶良町）"><label for="area0202">姶良市（旧姶良町）</label></li>
								<li><input type="checkbox" name="area02" id="area0203" value="加治木町"><label for="area0203">加治木町</label></li>
								<li><input type="checkbox" name="area02" id="area0204" value="蒲生町"><label for="area0204">蒲生町</label></li>
							</ul>
							<h4 class="search-off">霧島エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area03" id="area0301" value="霧島市全域"><label for="area0301">霧島市全域</label></li>
								<li><input type="checkbox" name="area03" id="area0302" value="国分（旧国分市）"><label for="area0302">国分（旧国分市）</label></li>
								<li><input type="checkbox" name="area03" id="area0303" value="隼人町"><label for="area0303">隼人町</label></li>
								<li><input type="checkbox" name="area03" id="area0304" value="牧園町"><label for="area0304">牧園町</label></li>
								<li><input type="checkbox" name="area03" id="area0305" value="横川町"><label for="area0305">横川町</label></li>
								<li><input type="checkbox" name="area03" id="area0306" value="溝辺町"><label for="area0306">溝辺町</label></li>
								<li><input type="checkbox" name="area03" id="area0307" value="福山町"><label for="area0307">福山町</label></li>
							</ul>
							<h4 class="search-off">北薩エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area04" id="area0401" value="北薩全域"><label for="area0401">北薩全域</label></li>
								<li><input type="checkbox" name="area04" id="area0402" value="薩摩川内市"><label for="area0402">薩摩川内市</label></li>
								<li><input type="checkbox" name="area04" id="area0403" value="さつま町"><label for="area0403">さつま町</label></li>
								<li><input type="checkbox" name="area04" id="area0404" value="出水市"><label for="area0404">出水市</label></li>
								<li><input type="checkbox" name="area04" id="area0405" value="阿久根市"><label for="area0405">阿久根市</label></li>
								<li><input type="checkbox" name="area04" id="area0406" value="長島町"><label for="area0406">長島町</label></li>
								<li><input type="checkbox" name="area04" id="area0407" value="伊佐市"><label for="area0407">伊佐市</label></li>
								<li><input type="checkbox" name="area04" id="area0408" value="湧水町"><label for="area0408">湧水町</label></li>
							</ul>
							<h4 class="search-off">中薩エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area05" id="area0501" value="中薩全域"><label for="area0501">中薩全域</label></li>
								<li><input type="checkbox" name="area05" id="area0502" value="日置市"><label for="area0502">日置市</label></li>
								<li><input type="checkbox" name="area05" id="area0503" value="いちき串木野市"><label for="area0503">いちき串木野市</label></li>
							</ul>
							<h4 class="search-off">南薩エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area06" id="area0601" value="南薩全域"><label for="area0601">南薩全域</label></li>
								<li><input type="checkbox" name="area06" id="area0602" value="南さつま市"><label for="area0602">南さつま市</label></li>
								<li><input type="checkbox" name="area06" id="area0603" value="南九州市"><label for="area0603">南九州市</label></li>
								<li><input type="checkbox" name="area06" id="area0604" value="指宿市"><label for="area0604">指宿市</label></li>
								<li><input type="checkbox" name="area06" id="area0605" value="枕崎市"><label for="area0605">枕崎市</label></li>
							</ul>
							<h4 class="search-off">大隅エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area07" id="area0701" value="大隅全域"><label for="area0701">大隅全域</label></li>
								<li><input type="checkbox" name="area07" id="area0702" value="鹿屋市"><label for="area0702">鹿屋市</label></li>
								<li><input type="checkbox" name="area07" id="area0703" value="垂水市"><label for="area0703">垂水市</label></li>
								<li><input type="checkbox" name="area07" id="area0704" value="志布志市"><label for="area0704">志布志市</label></li>
								<li><input type="checkbox" name="area07" id="area0705" value="曽於市"><label for="area0705">曽於市</label></li>
								<li><input type="checkbox" name="area07" id="area0706" value="大崎町"><label for="area0706">大崎町</label></li>
								<li><input type="checkbox" name="area07" id="area0707" value="肝付町"><label for="area0707">肝付町</label></li>
								<li><input type="checkbox" name="area07" id="area0708" value="錦江町"><label for="area0708">錦江町</label></li>
								<li><input type="checkbox" name="area07" id="area0709" value="東串良町"><label for="area0709">東串良町</label></li>
								<li><input type="checkbox" name="area07" id="area0710" value="南大隅町"><label for="area0710">南大隅町</label></li>
							</ul>
							<h4 class="search-off">離島エリア</h4>
							<ul class="list-unstyled">
								<li><input type="checkbox" name="area08" id="area0801" value="離島全域"><label for="area0810">離島全域</label></li>
							</ul>
							<button type="button" class="show-ul"><span aria-hidden="true">▼</span></button>
						</div>
					</div>
				</div>
			</div>
			<p class="text-center" id="search-more">もっとくわしく</p>
			<div class="wrap-search-detail box-select" id="search03">
				<h4>キーワード</h4>
				<ul class="list-unstyled">
					<li><input type="checkbox" name="keywords01" id="keywords0101" value="クーポン付き"><label for="keywords0101">クーポン付き</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0102" value="ランチあり"><label for="keywords0102">ランチあり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0103" value="宴会・パーティの予約可"><label for="keywords0103">宴会・パーティの予約可</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0104" value="日曜営業あり"><label for="keywords0104">日曜営業あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0105" value="食べ放題あり"><label for="keywords0105">食べ放題あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0106" value="飲み放題あり"><label for="keywords0106">飲み放題あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0107" value="お子様メニューあり"><label for="keywords0107">お子様メニューあり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0108" value="キッズスペースあり"><label for="keywords0108">キッズスペースあり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0109" value="座敷あり"><label for="keywords0109">座敷あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0110" value="個室あり"><label for="keywords0110">個室あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0111" value="貸切可"><label for="keywords0111">貸切可</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0112" value="大人数の宴会可"><label for="keywords0112">大人数の宴会可</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0113" value="禁煙（分煙を含む）"><label for="keywords0113">禁煙（分煙を含む）</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0114" value="駐車場あり"><label for="keywords0114">駐車場あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0115" value="カード使えます"><label for="keywords0115">カード使えます</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0116" value="身障者対応あり"><label for="keywords0116">身障者対応あり</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0117" value="テイクアウト可"><label for="keywords0117">テイクアウト可</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0118" value="ペット同伴可"><label for="keywords0118">ペット同伴可</label></li>
					<li><input type="checkbox" name="keywords01" id="keywords0119" value="Wi-Fi対応"><label for="keywords0119">Wi-Fi対応</label></li>
				</ul>
				<button class="btn btn-primary" id="close-detail">閉じる</button>
			</div>
		</div>

	<?php

		$rowNum = 0;

		if(have_posts()): while(have_posts()):the_post();

		global $wpdb;
		$query 	= "SELECT meta_id,post_id,meta_key,meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID ORDER BY meta_id ASC";
		$cf 	= $wpdb->get_results($query, ARRAY_A);

		// *** クーポン 値を取得
		$couponName 		= array();
		$couponIntroduction = array();
		$couponAttention 	= array();
		$couponDay 			= array();
		foreach( $cf as $row ){
			if( $row['meta_key'] == "coupon-name" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponName, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-introduction" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponIntroduction, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-attention" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponAttention, $row['meta_value'] );
				}
			}
			if( $row['meta_key'] == "coupon-day" ){
				if ( !empty ( $row['meta_value'] ) ) {
					array_push( $couponDay, $row['meta_value'] );
				}
			}
		}
		$lengthCoupon = count ( $couponName );

		$memberStatus 	= post_custom('member-status'); 	// 会員ステータス
		$tel 			= post_custom('tel'); 				// 電話番号
		$introduction 	= post_custom('introduction'); 		// 店舗紹介
		$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
		$areaAira 		= post_custom('area-aira'); 		// 姶良市・霧島市エリア
		$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
		$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
		$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
		$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
		$genre 			= post_custom('genre'); 			// ジャンル
		$keywords 		= post_custom('keywords'); 			// キーワード

	?>

	<?php
		$rowNum++;
		$reNum = $rowNum % 4;
		if($reNum === 1) echo '<div class="row">';
	?>

	<div class="col-sm-3">
		<article<?php if( $memberStatus == '有料' ) echo ' class="pay-mbr"'; ?>>
			<div class="inner">
				<?php
					// アイキャッチ画像
					echo '<div class="wrap-thumbnail"><a href="' . get_the_permalink() . '"><img src="';
					if ( has_post_thumbnail() ) {
						$image_id = get_post_thumbnail_id ();
						$image_url = wp_get_attachment_image_src ($image_id, true);
						echo $image_url[0];
					} else {
						echo get_bloginfo( 'template_directory' ) . '/img/thumbnail.png';
					}
					echo '" alt="' . get_the_title() . '" class="main-img lr-center"></a>';
					// *** クーポン判定
					if ( $lengthCoupon > 0 ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-q.png" alt="" class="icon-coupon">';
					}
					// *** 有料会員判定
					if ( $memberStatus ) {
						echo '<img src="' . get_template_directory_uri() . '/img/icon-good.png" alt="" class="icon-status">';
					}
					// *** .wrap-thumbnail end
					echo '</div>';
					// 店名＆店舗紹介
					echo '<div class="wrap-name bg-base">';
						// 店名
						echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
						// 店舗紹介
						echo '<div class="wrap-intro">';
						echo esc_html($introduction);
						echo '</div>';
					echo '</div>';
					// エリア
					echo '<div class="wrap-tel-adrs bg-base-light">';
							$areaAll = array();
							if( $areaKagoshima ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>鹿児島市エリア</p>';
							if( $areaAira ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>姶良市・霧島市エリア</p>';
							if( $areaHokusatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>北薩エリア</p>';
							if( $areaNakasatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>中薩エリア</p>';
							if( $areaNansatsu ) 	echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>南薩エリア</p>';
							if( $areaOsumi ) 		echo '<p class="text-center"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>大隅エリア</p>';
					echo '</div>';
					// ジャンル
					echo '<div class="wrap-genre bg-base-light"><ul class="list-inline">';
					if ( is_array ( $genre ) ) {
						foreach ( $genre as $value ) {
							echo '<li>' . $value . '</li>';
						}
					} else {
						echo $genre;
					}
					echo '</ul></div>';
					// キーワード
					echo '<div class="wrap-service bg-base-light"><ul class="list-inline">';
					if ( is_array ( $keywords ) ) {
						foreach ( $keywords as $value ) {
							echo '<li>' . $value . '</li>';
						}
					} else {
						echo '<li>' . $keywords . '</li>';
					}
					echo '</ul></div>';
				?>
			</div>
		</article>
	</div>

	<?php
		// 1行に3つカードが埋まっていれば .row を閉じる
		if($reNum === 0) {
			echo '</div>';
			$endDiv = 'off';
		} else {
			$endDiv = 'on';
		}
		// ループ処理終了
		endwhile; endif;
		// 最終行のカードが4未満なら .row を閉じないといけないための処理
		if($endDiv === 'on') {
			echo '</div>';
		}
	?>

	<div class="pagenavi">
		<?php
			// ページナビ
			posts_nav_link();
		?>
	</div>

</div>

<?php get_footer(); ?>