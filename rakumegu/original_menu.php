<?php



// ==================================================
//
//	ログインしているユーザーの各情報を格納する
//
// ==================================================
	global $current_user;
	global $companies;

	get_currentuserinfo();
	$agrName 	= $current_user->user_login;	// ログインしているユーザー名
	$agrLevel 	= $current_user->user_level;	// ログインしているユーザーの権限レベル
	$agrID 		= $current_user->ID;			// ログインしているユーザーID



// ==================================================
//
//	すべての投稿記事をループ
//
// ==================================================
	$args 				= array();
	$argsNews 			= array();
	$rrHotel 			= array();
	$rrPlace 			= array();
	$rrTicket 			= array();

	// タクシー・レンタカー会社のユーザー情報を格納
	// --------------------------------------------------
	$users 		= get_users( array( 'role'=>'Author', 'meta_key'=>'company_kana', 'orderby'=>'meta_value', 'order'=>'ASC' ) ); // 投稿者権限のユーザーをカスタムフィールド「よみがな」で並べ替え
	foreach($users as $user) {

		$uName 	= get_user_meta( $user->ID , 'company_name' , true ); 	// 会社名
		$uNN 	= $user->user_nicename; 								// ユーザー名
		$uID 	= $user->ID; 											// ユーザーID
		$uMail 	= $user->user_email; 									// メールアドレス
		$uSite 	= $user->user_url; 										// ウェブサイト
		$uCom 	= get_user_meta( $user->ID , 'type_com' , true ); 		// 企業種別
		$uKana 	= get_user_meta( $user->ID , 'company_kana' , true ); 	// よみがな
		$uZip 	= get_user_meta( $user->ID , 'zip' , true ); 			// 郵便番号
		// $uPref 	= get_user_meta( $user->ID , 'thestate' , true ); 		// 県
		$uPref 	= get_user_meta( $user->ID , 'pref' , true ); 		// 県
		$uCity 	= get_user_meta( $user->ID , 'city' , true ); 			// 市町村
		$uAdrs 	= get_user_meta( $user->ID , 'addr1' , true ); 			// 市町村以降の住所
		$uTel 	= get_user_meta( $user->ID , 'phone1' , true ); 		// TEL

		$rrTicket[] 				= $uNN;
		$rrTicket[$uNN]["name"] 	= $uName;
		$rrTicket[$uNN]["id"] 		= $uID;
		$rrTicket[$uNN]["kana"] 	= $uKana;
		$rrTicket[$uNN]["email"] 	= $uMail;
		$rrTicket[$uNN]["site"] 	= $uSite;
		$rrTicket[$uNN]["style"] 	= $uCom;
		$rrTicket[$uNN]["zip"] 		= $uZip;
		$rrTicket[$uNN]["pref"] 	= $uPref;
		$rrTicket[$uNN]["city"] 	= $uCity;
		$rrTicket[$uNN]["address"] 	= $uAdrs;
		$rrTicket[$uNN]["tel"] 		= $uTel;

	}

	$args = array(
		'post_type'			=> 'post',
		'post_status'		=> 'publish',
		'category_name'		=> 'hotel, place, ticket',
		'posts_per_page'	=> -1,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		// $userID 			= get_the_author_meta('ID'); 		// 記事の投稿者ID

		$category 			= get_the_category();
		$categoryID 		= $category[0]->term_id;
		$postID 			= get_the_ID();

		$postName 			= get_the_title(); 					// ホテル・観光地名
		$postKana 			= post_custom( 'Yomigana' ); 		// よみがな
		$postZip 			= post_custom( 'Zip' ); 			// 郵便番号
		$postPref 			= post_custom( 'City' ); 			// 市町村
		$postAdrs 			= post_custom( 'Address' ); 		// 市町村以降の住所
		$postTel 			= post_custom( 'TEL' ); 			// TEL
		$postFax 			= post_custom( 'FAX' ); 			// FAX
		$postMail 			= post_custom( 'E-mail' ); 			// メールアドレス
		$postWeb 			= post_custom( 'Web' ); 			// ホームページ
		$postStaff 			= post_custom( 'Staff' ); 			// 担当者名

		$postDate 			= post_custom( 'Date' ); 			// 回収日
		$postHotel 			= post_custom( 'Hotel' ); 			// ホテル名
		$postCity01 		= post_custom( 'City01' ); 			// 観光地の市町村（1回目）
		$postSightseeing01 	= post_custom( 'Sightseeing01' ); 	// 観光地（1回目）
		$postCity02 		= post_custom( 'City02' ); 			// 観光地の市町村（2回目）
		$postSightseeing02 	= post_custom( 'Sightseeing02' ); 	// 観光地（2回目）
		$postPrice 			= post_custom( 'Price' ); 			// 料金

		if( $categoryID === 2 ) {

			// カテゴリー「ホテル」
			// --------------------------------------------------
			$rrHotel[]					= $postID;
			$rrHotel[$postID]["name"]	= $postName;
			$rrHotel[$postID]["kana"] 	= $postKana;
			$rrHotel[$postID]["zip"] 	= $postZip;
			$rrHotel[$postID]["pref"] 	= $postPref;
			$rrHotel[$postID]["adrs"] 	= $postAdrs;
			$rrHotel[$postID]["tel"] 	= $postTel;
			$rrHotel[$postID]["fax"] 	= $postFax;
			$rrHotel[$postID]["email"] 	= $postMail;
			$rrHotel[$postID]["web"] 	= $postWeb;
			$rrHotel[$postID]["staff"] 	= $postStaff;

		} elseif( $categoryID === 3 ) {

			// カテゴリー「観光地」
			// --------------------------------------------------
			$rrPlace[]					= $postID;
			$rrPlace[$postID]["name"] 	= $postName;
			$rrPlace[$postID]["kana"] 	= $postKana;
			$rrPlace[$postID]["zip"] 	= $postZip;
			$rrPlace[$postID]["pref"] 	= $postPref;
			$rrPlace[$postID]["adrs"] 	= $postAdrs;
			$rrPlace[$postID]["tel"] 	= $postTel;
			$rrPlace[$postID]["fax"] 	= $postFax;
			$rrPlace[$postID]["email"] 	= $postMail;
			$rrPlace[$postID]["web"] 	= $postWeb;
			$rrPlace[$postID]["staff"] 	= $postStaff;

		} elseif ( $categoryID === 4 ) {

			// カテゴリー「タクシー・レンタカー」
			// --------------------------------------------------

			$uNN 		= get_the_author_meta('user_nicename'); // ユーザー名を取得

			$rrTicket[] 								= $uNN;
			$rrTicket[$uNN]["post"][] 					= $postID;
			$rrTicket[$uNN]["post"][$postID]["date"] 	= post_custom( 'Date' ); 			// 回収日
			$rrTicket[$uNN]["post"][$postID]["hotel"] 	= post_custom( 'Hotel' ); 			// ホテル名
			$rrTicket[$uNN]["post"][$postID]["city01"] 	= post_custom( 'City01' ); 			// 観光地の市町村（1回目）
			$rrTicket[$uNN]["post"][$postID]["ss01"] 	= post_custom( 'Sightseeing01' ); 	// 観光地（1回目）
			$rrTicket[$uNN]["post"][$postID]["city02"] 	= post_custom( 'City02' ); 			// 観光地の市町村（2回目）
			$rrTicket[$uNN]["post"][$postID]["ss02"] 	= post_custom( 'Sightseeing02' ); 	// 観光地（2回目）
			$rrTicket[$uNN]["post"][$postID]["price"] 	= post_custom( 'Price' ); 			// 料金

		}



	endwhile;
	endif;





// ==================================================
//
//	事務局からのおしらせ
//
// ==================================================
	$argsNews = array(
		'post_type'			=> 'post',
		'post_status'		=> 'publish',
		'category_name'		=> 'info',
		'posts_per_page'	=> 1,
	);
	$the_query = new WP_Query( $argsNews );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		echo '<h1>おしらせ</h1>';
		echo '<div class="postbox wrap-news">';
		echo '<h2 class="hndle ui-sortable-handle"><span>事務局からのおしらせ</span></h2>';
		echo '<div class="inside">';
		echo '<p class="news-date">' . get_the_time('Y-m-d') . '</p>';
		echo '<h4>' . get_the_title() . '</h4>';
		echo '<div class="contents">' . get_the_content() . '</div>';
		echo '</div>';
		echo '</div>';

	endwhile;
	endif;




if( $agrLevel >= 7 ) {

// =================================
//
// ログインユーザー・・・管理者
//
// =================================

	$gokei = $gokei11 = $gokei12 = $gokei01 = $num = $num11 = $num12 = $num01 = 0;

	// 現在の予算消化金額、使用されたチケット枚数
	// --------------------------------------------------
	echo '<p>' . date("Y年m月d日") . ' 現在の予算消化金額</p>';
	foreach ($rrTicket as $key1 => $value1) {

		$gokei11_com = $gokei12_com = $gokei01_com = 0;

		foreach ($value1 as $key2 => $value2) {

			foreach ($value2 as $key3 => $value3) {

				if (array_key_exists('price', $value3)) {

					$gokei += $value3['price'];
					$nn = get_the_author_meta('user_nicename');;
					$num++;

					$postDateF = date ('Ymd', strtotime($value3['date'])); // 日付フォーマット
					if( '20161101' <= $postDateF && $postDateF <= '20161130' ) {
						$gokei11 += $value3['price'];
						$rrTicket[$nn]['gokei11'] += $value3['price'];
						$num11++;
					} elseif( '20161201' <= $postDateF && $postDateF <= '20161231' ) {
						$gokei12 += $value3['price'];
						$rrTicket[$nn]['gokei12'] += $value3['price'];
						$num12++;
					} elseif( '20170101' <= $postDateF && $postDateF <= '20170131' ) {
						$gokei01 += $value3['price'];
						$rrTicket[$nn]['gokei01'] += $value3['price'];
						$num01++;
					}

				}
			}
		}
	}



	echo '<h1>集計</h1>';
	echo '<p>' . number_format ($gokei) . '<span class="small">円</span></p>';
	echo '<p>使用されたチケット枚数</p>';
	echo '<p>' . number_format ($num) . '<span class="small">枚</span></p>';

	// 表、棒グラフ
	// --------------------------------------------------
	echo '<table class="wp-list-table widefat fixed striped posts"><thead><tr><th>月</th><th>枚</th><th>金額</th></tr></thead>';
	echo '<tfoot>';
	echo '<tr>';
	echo '<th>合計</th><td>' . number_format ($num) . '</td><td>' . number_format ($gokei) . '</td>';
	echo '</tr>';
	echo '</tfoot><tbody>';
	echo '<tr>';
	echo '<td>11月</td><td>' . number_format ($num11) . '</td><td>' . number_format ($gokei11) . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>12月</td><td>' . number_format ($num12) . '</td><td>' . number_format ($gokei12) . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>1月</td><td>' . number_format ($num01) . '</td><td>' . number_format ($gokei01) . '</td>';
	echo '</tr>';
	echo '</tbody></table>';

	echo '<h2>月別<span class="small">タクシー・レンタカー会社</span></h2>';
	echo '<table class="wp-list-table widefat fixed striped posts"><thead><tr><th>会社名</th><th>11月</th><th>12月</th><th>1月</th><th>合計</th></tr></thead>';
	echo '<tbody>';
	echo '<tr>';
	echo '<td>会社名</td><td>11月</td><td>12月</td><td>1月</td><td>合計</td>';
	echo '</tr>';
	echo '</tbody></table>';

	echo '<h2>月別<span class="small">観光地</span></h2>';








} else {

// =================================
//
// ログインユーザー・・・各タクシー・レンタカー会社
//
// =================================

	echo '<h1>集計</h1>';

	// 現在の予算消化金額、使用されたチケット枚数
	// --------------------------------------------------
	echo '<p>' . date("Y年m月d日") . ' 現在の予算消化金額</p>';
	echo '<p>' . number_format( intval( $rakuraku["4"][$userID]['gokei'] ) ) . '<span class="small">円</span></p>';
	echo '<p>使用されたチケット枚数</p>';
	$cnt = $rakuraku["4"][$userID]["ticket"]["11"] +
		   $rakuraku["4"][$userID]["ticket"]["12"] +
		   $rakuraku["4"][$userID]["ticket"]["01"];
    echo '<p>' . number_format( $cnt ) . '<span class="small">枚</span></p>';

    // 月毎の合計金額と枚数
	// --------------------------------------------------
    echo '<table class="wp-list-table widefat fixed striped posts"><thead><tr><th>月</th><th>枚</th><th>金額</th></tr></thead>';
	echo '<tfoot>';
	echo '<tr>';
	echo '<th>合計</th><td>' . number_format( $cnt ) . '</td><td>' . number_format( intval( $rakuraku["4"][$userID]['gokei'] ) ) . '</td>';
	echo '</tr>';
	echo '</tfoot><tbody>';
	echo '<tr>';
	echo '<td>11月</td><td>' . number_format( $rakuraku["4"][$userID]["ticket"]["11"] ) . '</td><td>' . number_format( $rakuraku["4"][$userID]["gokei11"] ) . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>12月</td><td>' . number_format( $rakuraku["4"][$userID]["ticket"]["12"] ) . '</td><td>' . number_format( $rakuraku["4"][$userID]["gokei12"] ) . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>1月</td><td>' . number_format( $rakuraku["4"][$userID]["ticket"]["01"] ) . '</td><td>' . number_format( $rakuraku["4"][$userID]["gokei01"] ) . '</td>';
	echo '</tr>';
	echo '</tbody></table>';


}



	echo '<h1>配列の中身</h1>';
	echo '<h2>ホテル</h2>';
	echo '<pre>';
	echo var_dump($rrHotel);
	echo '</pre>';
	echo '<h2>観光地</h2>';
	echo '<pre>';
	echo var_dump($rrPlace);
	echo '</pre>';
	echo '<h2>チケット</h2>';
	echo '<pre>';
	echo var_dump($rrTicket);
	echo '</pre>';




// 元の投稿データを復元
wp_reset_postdata();