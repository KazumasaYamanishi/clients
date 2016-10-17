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
	$rrTaxi 			= array();
	$rrRentalcar 		= array();
	$rrStamp			= array();

	// タクシー・レンタカー会社のユーザー情報を格納
	// ※権限が投稿者のみの情報をループして集めている
	// --------------------------------------------------
	$users 		= get_users( array( 'role'=>'Author', 'meta_key'=>'company_kana', 'orderby'=>'meta_value', 'order'=>'ASC' ) ); // 投稿者権限のユーザーをカスタムフィールド「よみがな」で並べ替え
	foreach($users as $user) {

		$uName 	= get_user_meta( $user->ID , 'company_name' , true ); 	// 会社名
		$uLogin = $user->user_login; 									// ログイン名
		$uNN 	= $user->user_nicename; 								// ユーザー名
		$uID 	= $user->ID; 											// ユーザーID
		$uMail 	= $user->user_email; 									// メールアドレス
		$uSite 	= $user->user_url; 										// ウェブサイト
		$uCom 	= get_user_meta( $user->ID , 'type_com' , true ); 		// 企業種別
		$uKana 	= get_user_meta( $user->ID , 'company_kana' , true ); 	// よみがな
		$uZip 	= get_user_meta( $user->ID , 'zip' , true ); 			// 郵便番号
		$uPref 	= get_user_meta( $user->ID , 'pref' , true ); 			// 県
		$uCity 	= get_user_meta( $user->ID , 'city' , true ); 			// 市町村
		$uAdrs 	= get_user_meta( $user->ID , 'addr1' , true ); 			// 市町村以降の住所
		$uTel 	= get_user_meta( $user->ID , 'phone1' , true ); 		// TEL

		if( $uCom === 'taxi' ) {
			// $rrTaxi[] 					= $uNN;
			$rrTaxi[$uNN]["name"] 		= $uName;
			$rrTaxi[$uNN]["login"] 		= $uLogin;
			$rrTaxi[$uNN]["id"] 		= $uID;
			$rrTaxi[$uNN]["kana"] 		= $uKana;
			$rrTaxi[$uNN]["email"] 		= $uMail;
			$rrTaxi[$uNN]["site"] 		= $uSite;
			$rrTaxi[$uNN]["zip"] 		= $uZip;
			$rrTaxi[$uNN]["pref"] 		= $uPref;
			$rrTaxi[$uNN]["city"] 		= $uCity;
			$rrTaxi[$uNN]["address"] 	= $uAdrs;
			$rrTaxi[$uNN]["tel"] 		= $uTel;
		} elseif( $uCom === 'rentalcar' ) {
			// $rrRentalcar[] 					= $uNN;
			$rrRentalcar[$uNN]["name"] 		= $uName;
			$rrRentalcar[$uNN]["login"] 		= $uLogin;
			$rrRentalcar[$uNN]["id"] 		= $uID;
			$rrRentalcar[$uNN]["kana"] 		= $uKana;
			$rrRentalcar[$uNN]["email"] 		= $uMail;
			$rrRentalcar[$uNN]["site"] 		= $uSite;
			$rrRentalcar[$uNN]["zip"] 		= $uZip;
			$rrRentalcar[$uNN]["pref"] 		= $uPref;
			$rrRentalcar[$uNN]["city"] 		= $uCity;
			$rrRentalcar[$uNN]["address"] 	= $uAdrs;
			$rrRentalcar[$uNN]["tel"] 		= $uTel;
		}
	}

	// 宿泊施設情報
	// --------------------------------------------------
	$argsHotel = array(
		'post_type'			=> 'stay',
		'post_status'		=> 'publish',
		'meta_key' 			=> 'Yomigana',
		'orderby' 			=> 'meta_value',
		'order' 			=> 'ASC',
		'posts_per_page'	=> -1,
	);
	$the_query = new WP_Query( $argsHotel );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		// $category 			= get_the_category();
		// $categoryID 		= $category[0]->term_id;
		$postID 			= get_the_ID();

		$postName 			= get_the_title(); 					// 宿泊施設
		$postKana 			= post_custom( 'Yomigana' ); 		// よみがな
		$postArea 			= post_custom( 'Area' ); 			// 施設エリア
		$postZip 			= post_custom( 'Zip' ); 			// 郵便番号
		$postPref 			= post_custom( 'Pref' ); 			// 県
		$postCity 			= post_custom( 'City' ); 			// 市町村
		$postAdrs 			= post_custom( 'Address' ); 		// 市町村以降の住所
		$postTelCon 		= post_custom( 'TEL-contact' ); 	// TEL（事務連絡用）
		$postTelPub 		= post_custom( 'TEL-public' ); 		// TEL（広報サイト用）
		$postFax 			= post_custom( 'FAX' ); 			// FAX
		$postMail 			= post_custom( 'E-mail' ); 			// メールアドレス
		$postWeb 			= post_custom( 'Web' ); 			// ホームページ
		$postStaff 			= post_custom( 'Staff' ); 			// 担当者名

		//$rrHotel["ID"]					= $postID; 		// 記事ID（宿泊施設ID）

		$rrHotel[$postID]["name"]		= $postName; 	// 宿泊施設名（記事タイトル）
		$rrHotel[$postID]["kana"]		= $postKana; 	// 宿泊施設名（カタカナ） ※半角カナを全角に。空白を削除。英数字、記号を半角に。
		$rrHotel[$postID]["area"]		= $postArea; 	// 施設エリア
		$rrHotel[$postID]["zip"]		= $postZip; 	// 郵便番号
		$rrHotel[$postID]["pref"]		= $postPref; 	// 県
		$rrHotel[$postID]["city"]		= $postCity; 	// 市町村
		$rrHotel[$postID]["address"]	= $postAdrs; 	// 市町村以降の住所
		$rrHotel[$postID]["tel-con"]	= $postTelCon; 	// TEL（事務連絡用）
		$rrHotel[$postID]["tel-pub"]	= $postTelPub; 	// TEL（広報サイト用）
		$rrHotel[$postID]["fax"]		= $postFax; 	// FAX
		$rrHotel[$postID]["mail"]		= $postMail; 	// メールアドレス
		$rrHotel[$postID]["web"]		= $postWeb; 	// ホームページ
		$rrHotel[$postID]["staff"]		= $postStaff; 	// 担当者名

	endwhile;
	endif;

	// 観光施設情報
	// --------------------------------------------------
	$argsPlace = array(
		'post_type'			=> 'spot',
		'post_status'		=> 'publish',
		'meta_key' 			=> 'Yomigana',
		'orderby' 			=> 'meta_value',
		'order' 			=> 'ASC',
		'posts_per_page'	=> -1,
	);
	$the_query = new WP_Query( $argsPlace );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		$postID 			= get_the_ID();
		$postName 			= get_the_title(); 					// 観光施設
		$postKana 			= post_custom( 'Yomigana' ); 		// よみがな
		$postArea 			= post_custom( 'Area' ); 			// 施設エリア
		$postZip 			= post_custom( 'Zip' ); 			// 郵便番号
		$postPref 			= post_custom( 'Pref' ); 			// 県
		$postCity 			= post_custom( 'City' ); 			// 市町村
		$postAdrs 			= post_custom( 'Address' ); 		// 市町村以降の住所
		$postTelCon 		= post_custom( 'TEL-contact' ); 	// TEL（事務連絡用）
		$postTelPub 		= post_custom( 'TEL-public' ); 		// TEL（広報サイト用）
		$postFax 			= post_custom( 'FAX' ); 			// FAX
		$postMail 			= post_custom( 'E-mail' ); 			// メールアドレス
		$postWeb 			= post_custom( 'Web' ); 			// ホームページ
		$postStaff 			= post_custom( 'Staff' ); 			// 担当者名

		$rrPlace[$postID]["name"]		= $postName; 	// 観光施設名（記事タイトル）
		$rrPlace[$postID]["kana"]		= $postKana; 	// 宿泊施設名（カタカナ） ※半角カナを全角に。空白を削除。英数字、記号を半角に。
		$rrPlace[$postID]["area"]		= $postArea; 	// 施設エリア
		$rrPlace[$postID]["zip"]		= $postZip; 	// 郵便番号
		$rrPlace[$postID]["pref"]		= $postPref; 	// 県
		$rrPlace[$postID]["city"]		= $postCity; 	// 市町村
		$rrPlace[$postID]["address"]	= $postAdrs; 	// 市町村以降の住所
		$rrPlace[$postID]["tel-con"]	= $postTelCon; 	// TEL（事務連絡用）
		$rrPlace[$postID]["tel-pub"]	= $postTelPub; 	// TEL（広報サイト用）
		$rrPlace[$postID]["fax"]		= $postFax; 	// FAX
		$rrPlace[$postID]["mail"]		= $postMail; 	// メールアドレス
		$rrPlace[$postID]["web"]		= $postWeb; 	// ホームページ
		$rrPlace[$postID]["staff"]		= $postStaff; 	// 担当者名

	endwhile;
	endif;

	// すべての証明書情報
	// --------------------------------------------------
	$argsStamp = array(
		'post_type'			=> 'stamp',
		'post_status'		=> 'publish',
		'posts_per_page'	=> -1,
	);
	$the_query = new WP_Query( $argsStamp );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

		$userName 			= get_the_author(); 				// 投稿者名
		$userType 			= get_the_author_meta('type_com'); 	// taxi or rentalcar

		$stampID 			= get_the_ID();
		$stampName 			= get_the_title(); 					// 証明書番号
		$stampStatus 		= post_custom( 'CheckKCR' );		// 確認ステータス
		$stampKokai 		= get_the_time(); 					// 公開日
		$stampDay 			= post_custom( 'kaishu' ); 			// 回収日
		$stampBefore 		= post_custom( 'UseBefore' ); 		// 利用開始日
		$stampAfter 		= post_custom( 'UseAfter' ); 		// 利用終了日
		$stampSpotDay1 		= post_custom( 'Date01' ); 			// 観光施設訪問日（1回目）
		$stampSpotName1 	= post_custom( 'Sightseeing01' ); 	// 観光施設名（1回目）
		$stampSpotDay2 		= post_custom( 'Date02' ); 			// 観光施設訪問日（2回目）
		$stampSpotName2 	= post_custom( 'Sightseeing02' ); 	// 観光施設名（1回目）
		$stampHotelArea 	= post_custom( 'HotelArea' ); 		// 宿泊施設エリア
		$stampPriceBefore 	= post_custom( 'PriceBefore' ); 	// 割引前の利用料金
		$stampPriceAfter 	= post_custom( 'PriceAfter' ); 		// 割引後の利用料金
		$stampQ1 			= post_custom( 'Q1' ); 				// 性別をお教えください
		$stampQ2 			= post_custom( 'Q2' ); 				// 年齢をお教えください
		$stampQ3 			= post_custom( 'Q3' ); 				// お住まいはどちらかお教えください
		$stampQ4 			= post_custom( 'Q4' ); 				// 今回、タクシー・レンタカーは、代表者を含めて何人で利用したかお教えください
		$stampQ5 			= post_custom( 'Q5' ); 				// 鹿児島県まではどの交通手段で来られましたか
		$stampQ5Content 	= post_custom( 'Q5content' ); 		// その他の交通手段
		$stampQ6 			= post_custom( 'Q6' ); 				// 今回、鹿児島県を旅行しようと思ったのは次のうちどちらですか
		$stampQ7 			= post_custom( 'Q7' ); 				// かごしまらくめぐりを何がきっかけで知りましたか
		$stampQ7Content 	= post_custom( 'Q7content' ); 		// その他のきっかけ
		$stampQ8 			= post_custom( 'Q8' ); 				// 今回はパンフレットに記載の地域のうち、どこを旅行されましたか（複数回答可）
		$stampQ9 			= post_custom( 'Q9' ); 				// 今回の旅行で、1人当たりどのくらいの金額を使用しましたか（宿泊費・交通費・飲食代・お土産・入場料）
		$stampQ10 			= post_custom( 'Q10' ); 			// 今回、かごしまらくめぐりを利用した感想・鹿児島県を旅行した感想をお聞かせください
		$stampQ10Content 	= post_custom( 'Q10content' ); 		// 改善して欲しいところ

		if( $userType == 'taxi' ) {

			// $rrTaxi[$userName]['stamp']['name'] 						= $stampName;
			$rrTaxi[$userName]['stamp'][$stampName]['id'] 				= $stampID;
			$rrTaxi[$userName]['stamp'][$stampName]['status'] 			= $stampStatus;
			$rrTaxi[$userName]['stamp'][$stampName]['kokai'] 			= $stampKokai;
			$rrTaxi[$userName]['stamp'][$stampName]['day'] 				= $stampDay;
			$rrTaxi[$userName]['stamp'][$stampName]['usebefore'] 		= $stampBefore;
			$rrTaxi[$userName]['stamp'][$stampName]['useafter'] 		= $stampAfter;
			$rrTaxi[$userName]['stamp'][$stampName]['spotday1'] 		= $stampSpotDay1;
			$rrTaxi[$userName]['stamp'][$stampName]['spotname1'] 		= $stampSpotName1;
			$rrTaxi[$userName]['stamp'][$stampName]['spotday2'] 		= $stampSpotDay2;
			$rrTaxi[$userName]['stamp'][$stampName]['spotname2'] 		= $stampSpotName2;
			$rrTaxi[$userName]['stamp'][$stampName]['hotelarea'] 		= $stampHotelArea;
			$rrTaxi[$userName]['stamp'][$stampName]['pricebefore'] 		= $stampPriceBefore;
			$rrTaxi[$userName]['stamp'][$stampName]['priceafter'] 		= $stampPriceAfter;

			$rrTaxi[$userName]['stamp'][$stampName]['q1'] 				= $stampQ1;
			$rrTaxi[$userName]['stamp'][$stampName]['q2'] 				= $stampQ2;
			$rrTaxi[$userName]['stamp'][$stampName]['q3'] 				= $stampQ3;
			$rrTaxi[$userName]['stamp'][$stampName]['q4'] 				= $stampQ4;
			$rrTaxi[$userName]['stamp'][$stampName]['q5'] 				= $stampQ5;
			$rrTaxi[$userName]['stamp'][$stampName]['q5con'] 			= $stampQ5Content;
			$rrTaxi[$userName]['stamp'][$stampName]['q6'] 				= $stampQ6;
			$rrTaxi[$userName]['stamp'][$stampName]['q7'] 				= $stampQ7;
			$rrTaxi[$userName]['stamp'][$stampName]['q7con'] 			= $stampQ7Content;
			$rrTaxi[$userName]['stamp'][$stampName]['q8'] 				= $stampQ8;
			$rrTaxi[$userName]['stamp'][$stampName]['q9'] 				= $stampQ9;
			$rrTaxi[$userName]['stamp'][$stampName]['q10'] 				= $stampQ10;
			$rrTaxi[$userName]['stamp'][$stampName]['q10con'] 			= $stampQ10Content;

		} elseif( $userType == 'rentalcar' ) {

			// $rrRentalcar[$userName]['stamp']['name'] 						= $stampName;
			$rrRentalcar[$userName]['stamp'][$stampName]['id'] 				= $stampID;
			$rrRentalcar[$userName]['stamp'][$stampName]['status'] 			= $stampStatus;
			$rrRentalcar[$userName]['stamp'][$stampName]['kokai'] 			= $stampKokai;
			$rrRentalcar[$userName]['stamp'][$stampName]['day'] 			= $stampDay;
			$rrRentalcar[$userName]['stamp'][$stampName]['usebefore'] 		= $stampBefore;
			$rrRentalcar[$userName]['stamp'][$stampName]['useafter'] 		= $stampAfter;
			$rrRentalcar[$userName]['stamp'][$stampName]['spotday1'] 		= $stampSpotDay1;
			$rrRentalcar[$userName]['stamp'][$stampName]['spotname1'] 		= $stampSpotName1;
			$rrRentalcar[$userName]['stamp'][$stampName]['spotday2'] 		= $stampSpotDay2;
			$rrRentalcar[$userName]['stamp'][$stampName]['spotname2'] 		= $stampSpotName2;
			$rrRentalcar[$userName]['stamp'][$stampName]['hotelarea'] 		= $stampHotelArea;
			$rrRentalcar[$userName]['stamp'][$stampName]['pricebefore'] 	= $stampPriceBefore;
			$rrRentalcar[$userName]['stamp'][$stampName]['priceafter'] 		= $stampPriceAfter;

			$rrRentalcar[$userName]['stamp'][$stampName]['q1'] 				= $stampQ1;
			$rrRentalcar[$userName]['stamp'][$stampName]['q2'] 				= $stampQ2;
			$rrRentalcar[$userName]['stamp'][$stampName]['q3'] 				= $stampQ3;
			$rrRentalcar[$userName]['stamp'][$stampName]['q4'] 				= $stampQ4;
			$rrRentalcar[$userName]['stamp'][$stampName]['q5'] 				= $stampQ5;
			$rrRentalcar[$userName]['stamp'][$stampName]['q5con'] 			= $stampQ5Content;
			$rrRentalcar[$userName]['stamp'][$stampName]['q6'] 				= $stampQ6;
			$rrRentalcar[$userName]['stamp'][$stampName]['q7'] 				= $stampQ7;
			$rrRentalcar[$userName]['stamp'][$stampName]['q7con'] 			= $stampQ7Content;
			$rrRentalcar[$userName]['stamp'][$stampName]['q8'] 				= $stampQ8;
			$rrRentalcar[$userName]['stamp'][$stampName]['q9'] 				= $stampQ9;
			$rrRentalcar[$userName]['stamp'][$stampName]['q10'] 			= $stampQ10;
			$rrRentalcar[$userName]['stamp'][$stampName]['q10con'] 			= $stampQ10Content;

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



	// **************************************************
	// $agrName に投稿者名（ユーザー名）
	// $agrID に投稿者ID（ユーザーID）
	// **************************************************



	// **************************************************
	// ログインしているユーザーはタクシー会社かレンタカー会社かの判断
	// **************************************************
	$userID 	= $current_user->ID;
	$user_info 	= get_userdata($agrID);
	$userType 	= $user_info->type_com; // $userType に taxi or rentalcar

	if ( $userType === 'taxi' ) {

		// 配列のカウント
		// ----------------------------------------
			$aryNum 	= count( $rrTaxi[$agrName]['stamp'] );
			$aryStamp 	= $rrTaxi[$agrName]['stamp'];

			$stp11 = 0;
			$stp12 = 0;
			$stp01 = 0;

			foreach ( $aryStamp as $value ) {
				$stpDay = intval ( str_replace ( "-", "", $value['useafter'] ) ); // 数値に変換
				if ( $stpDay >= 20161101 && $stpDay <= 20161130 ) {
					// 11月の証明書集計
					// ----------------------------------------
					$stp11++;
					echo $stp11;

				} elseif ( $stpDay >= 20161201 && $stpDay <= 20161231 ) {
					// 12月の証明書集計
					// ----------------------------------------
					$stp12++;
					echo $stp12;

				} elseif ( $stpDay >= 20170101 && $stpDay <= 20170131 ) {
					// 1月の証明書集計
					// ----------------------------------------
					$stp01++;
					echo '<p>' . $stp01 . '</p>';

				}
			}


		// echo '<pre>';
		// echo var_dump($rrTaxi[$agrName]['stamp']);
		// echo '</pre>';
	} else {
		// echo '<pre>';
		// echo var_dump($rrRentalcar[$agrName]['stamp']);
		// echo '</pre>';
	}



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

	// echo '<h1>配列の中身</h1>';
	// echo '<h2>宿泊施設</h2>';
	// echo '<pre>';
	// echo var_dump($rrHotel);
	// echo '</pre>';
	// echo '<h2>観光施設</h2>';
	// echo '<pre>';
	// echo var_dump($rrPlace);
	// echo '</pre>';
	// echo '<h2>テスト</h2>';
	// echo '<pre>';
	// echo var_dump($ppp);
	// echo '</pre>';
	// echo '<h2>タクシー会社</h2>';
	// echo '<pre>';
	// echo var_dump($rrTaxi);
	// echo '</pre>';
	// echo '<h2>レンタカー会社</h2>';
	// echo '<pre>';
	// echo var_dump($rrRentalcar);
	// echo '</pre>';


// 元の投稿データを復元
wp_reset_postdata();