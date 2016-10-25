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
	$users 		= get_users( array( 'role'=>'Author', 'meta_key'=>'company_kana', 'orderby'=>'meta_value', 'order'=>'ASC' ) );

	// 投稿者権限のユーザーをカスタムフィールド「よみがな」で並べ替え
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

	// echo '<pre>';
	// echo var_dump($rrTaxi);
	// echo '</pre>';

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
		// $stampDay 			= post_custom( 'kaishu' ); 			// 回収日
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

			$rrTaxi[$userName]['stamp'][$stampID]['num'] 				= $stampName;
			$rrTaxi[$userName]['stamp'][$stampID]['status'] 			= $stampStatus;
			$rrTaxi[$userName]['stamp'][$stampID]['kokai'] 				= $stampKokai;
			$rrTaxi[$userName]['stamp'][$stampID]['usebefore'] 			= $stampBefore;
			$rrTaxi[$userName]['stamp'][$stampID]['useafter'] 			= $stampAfter;
			$rrTaxi[$userName]['stamp'][$stampID]['spotday1'] 			= $stampSpotDay1;
			$rrTaxi[$userName]['stamp'][$stampID]['spotname1'] 			= $stampSpotName1;
			$rrTaxi[$userName]['stamp'][$stampID]['spotday2'] 			= $stampSpotDay2;
			$rrTaxi[$userName]['stamp'][$stampID]['spotname2'] 			= $stampSpotName2;
			$rrTaxi[$userName]['stamp'][$stampID]['hotelarea'] 			= $stampHotelArea;
			$rrTaxi[$userName]['stamp'][$stampID]['pricebefore'] 		= $stampPriceBefore;
			$rrTaxi[$userName]['stamp'][$stampID]['priceafter'] 		= $stampPriceAfter;

			$rrTaxi[$userName]['stamp'][$stampID]['q1'] 				= $stampQ1;
			$rrTaxi[$userName]['stamp'][$stampID]['q2'] 				= $stampQ2;
			$rrTaxi[$userName]['stamp'][$stampID]['q3'] 				= $stampQ3;
			$rrTaxi[$userName]['stamp'][$stampID]['q4'] 				= $stampQ4;
			$rrTaxi[$userName]['stamp'][$stampID]['q5'] 				= $stampQ5;
			$rrTaxi[$userName]['stamp'][$stampID]['q5con'] 				= $stampQ5Content;
			$rrTaxi[$userName]['stamp'][$stampID]['q6'] 				= $stampQ6;
			$rrTaxi[$userName]['stamp'][$stampID]['q7'] 				= $stampQ7;
			$rrTaxi[$userName]['stamp'][$stampID]['q7con'] 				= $stampQ7Content;
			$rrTaxi[$userName]['stamp'][$stampID]['q8'] 				= $stampQ8;
			$rrTaxi[$userName]['stamp'][$stampID]['q9'] 				= $stampQ9;
			$rrTaxi[$userName]['stamp'][$stampID]['q10'] 				= $stampQ10;
			$rrTaxi[$userName]['stamp'][$stampID]['q10con'] 			= $stampQ10Content;

		} elseif( $userType == 'rentalcar' ) {

			$rrRentalcar[$userName]['stamp'][$stampID]['num'] 			= $stampName;
			$rrRentalcar[$userName]['stamp'][$stampID]['status'] 		= $stampStatus;
			$rrRentalcar[$userName]['stamp'][$stampID]['kokai'] 		= $stampKokai;
			$rrRentalcar[$userName]['stamp'][$stampID]['usebefore'] 	= $stampBefore;
			$rrRentalcar[$userName]['stamp'][$stampID]['useafter'] 		= $stampAfter;
			$rrRentalcar[$userName]['stamp'][$stampID]['spotday1'] 		= $stampSpotDay1;
			$rrRentalcar[$userName]['stamp'][$stampID]['spotname1'] 	= $stampSpotName1;
			$rrRentalcar[$userName]['stamp'][$stampID]['spotday2'] 		= $stampSpotDay2;
			$rrRentalcar[$userName]['stamp'][$stampID]['spotname2'] 	= $stampSpotName2;
			$rrRentalcar[$userName]['stamp'][$stampID]['hotelarea'] 	= $stampHotelArea;
			$rrRentalcar[$userName]['stamp'][$stampID]['pricebefore'] 	= $stampPriceBefore;
			$rrRentalcar[$userName]['stamp'][$stampID]['priceafter'] 	= $stampPriceAfter;

			$rrRentalcar[$userName]['stamp'][$stampID]['q1'] 			= $stampQ1;
			$rrRentalcar[$userName]['stamp'][$stampID]['q2'] 			= $stampQ2;
			$rrRentalcar[$userName]['stamp'][$stampID]['q3'] 			= $stampQ3;
			$rrRentalcar[$userName]['stamp'][$stampID]['q4'] 			= $stampQ4;
			$rrRentalcar[$userName]['stamp'][$stampID]['q5'] 			= $stampQ5;
			$rrRentalcar[$userName]['stamp'][$stampID]['q5con'] 		= $stampQ5Content;
			$rrRentalcar[$userName]['stamp'][$stampID]['q6'] 			= $stampQ6;
			$rrRentalcar[$userName]['stamp'][$stampID]['q7'] 			= $stampQ7;
			$rrRentalcar[$userName]['stamp'][$stampID]['q7con'] 		= $stampQ7Content;
			$rrRentalcar[$userName]['stamp'][$stampID]['q8'] 			= $stampQ8;
			$rrRentalcar[$userName]['stamp'][$stampID]['q9'] 			= $stampQ9;
			$rrRentalcar[$userName]['stamp'][$stampID]['q10'] 			= $stampQ10;
			$rrRentalcar[$userName]['stamp'][$stampID]['q10con'] 		= $stampQ10Content;

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

		echo '<h1 class="title"><span class="dashicons dashicons-megaphone"></span>おしらせ</h1>';
		echo '<div class="postbox wrap-news mb-base">';
		echo '<h2 class="hndle ui-sortable-handle"><span>事務局からのおしらせ</span></h2>';
		echo '<div class="inside">';
		echo '<h3>' . get_the_title() . '</h3>';
		echo '<p class="news-date"><span class="dashicons dashicons-clock"></span>' . get_the_time('Y-m-d') . '</p>';
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

	$stpTX = array();
	$stpRC = array();

	// echo '<pre>';
	// echo var_dump();
	// echo '</pre>';

	// タクシーの証明書情報をすべて取得
	// --------------------------------------------------
	$stp11ALL 	= 0;
	$stp12ALL 	= 0;
	$stp01ALL 	= 0;
	$stp11ALLt 	= 0;
	$stp12ALLt 	= 0;
	$stp01ALLt 	= 0;
	$stp11ST 	= 0;
	$stp12ST 	= 0;
	$stp01ST 	= 0;
	$stp11STt 	= 0;
	$stp12STt 	= 0;
	$stp01STt 	= 0;
	foreach ( $rrTaxi as $value1 ) {

		// 各タクシー会社ごとにループしている
		$tblNameT 					= $value1["name"];
		$stpTX[$tblNameT]['name'] 	= $tblNameT;

		if ( $value1['stamp'] != "" ) {

			$stpST11 = 0;
			$stpST12 = 0;
			$stpST01 = 0;

			foreach ( $value1['stamp'] as $value2 ) {

				$tblDay	= intval ( str_replace ( "-", "", $value2['useafter'] ) ); 	// 利用終了日
				$tblPB	= intval ( $value2['pricebefore'] ); 						// 割引前の利用料金
				$tblPA	= intval ( $value2['priceafter'] ); 						// 割引後の利用料金

				// 割引金額の算出
				if ( $tblPA == 0 ) {
					$tblPL 	= $tblPB;
				} else {
					$tblPL 	= $tblPB - $tblPA;
				}

				$stpTX[$tblNameT]['name'] = $tblNameT;

				if ( $tblDay >= 20161101 && $tblDay <= 20161130 ) {
					// 11月の証明書集計
					// ----------------------------------------
					$stpST11++;
					$stpTX[$tblNameT]['stp11']['pb'] = intval ( $stpTX[$tblNameT]['stp11']['pb'] ) + $tblPB;
					$stpTX[$tblNameT]['stp11']['pa'] = intval ( $stpTX[$tblNameT]['stp11']['pa'] ) + $tblPA;
					$stpTX[$tblNameT]['stp11']['pl'] = intval ( $stpTX[$tblNameT]['stp11']['pl'] ) + $tblPL;
					$stpTX[$tblNameT]['stp11']['st'] = $stpST11;

					$stp11ALL += $tblPL;
					$stp11ALLt += $tblPL;
					$stp11ST++;
					$stp11STt++;

				} elseif ( $tblDay >= 20161201 && $tblDay <= 20161231 ) {
					// 12月の証明書集計
					// ----------------------------------------
					$stpST12++;
					$stpTX[$tblNameT]['stp12']['pb'] = intval ( $stpTX[$tblNameT]['stp12']['pb'] ) + $tblPB;
					$stpTX[$tblNameT]['stp12']['pa'] = intval ( $stpTX[$tblNameT]['stp12']['pa'] ) + $tblPA;
					$stpTX[$tblNameT]['stp12']['pl'] = intval ( $stpTX[$tblNameT]['stp12']['pl'] ) + $tblPL;
					$stpTX[$tblNameT]['stp12']['st'] = $stpST12;

					$stp12ALL += $tblPL;
					$stp12ALLt += $tblPL;
					$stp12ST++;
					$stp12STt++;

				} elseif ( $tblDay >= 20170101 && $tblDay <= 20170131 ) {
					// 1月の証明書集計
					// ----------------------------------------
					$stpST01++;
					$stpTX[$tblNameT]['stp01']['pb'] = intval ( $stpTX[$tblNameT]['stp01']['pb'] ) + $tblPB;
					$stpTX[$tblNameT]['stp01']['pa'] = intval ( $stpTX[$tblNameT]['stp01']['pa'] ) + $tblPA;
					$stpTX[$tblNameT]['stp01']['pl'] = intval ( $stpTX[$tblNameT]['stp01']['pl'] ) + $tblPL;
					$stpTX[$tblNameT]['stp01']['st'] = $stpST01;

					$stp01ALL += $tblPL;
					$stp01ALLt += $tblPL;
					$stp01ST++;
					$stp01STt++;

				}

			}

			$resultTAXI = $stp11ALLt + $stp12ALLt + $stp01ALLt;
			$nosTAXI 	= $stp11ST + $stp12ST + $stp01ST;

		} else {
			$stpTX[$tblNameT]['stp11']['pb'] = 0;
			$stpTX[$tblNameT]['stp11']['pa'] = 0;
			$stpTX[$tblNameT]['stp11']['pl'] = 0;
			$stpTX[$tblNameT]['stp11']['st'] = 0;
			$stpTX[$tblNameT]['stp12']['pb'] = 0;
			$stpTX[$tblNameT]['stp12']['pa'] = 0;
			$stpTX[$tblNameT]['stp12']['pl'] = 0;
			$stpTX[$tblNameT]['stp12']['st'] = 0;
			$stpTX[$tblNameT]['stp01']['pb'] = 0;
			$stpTX[$tblNameT]['stp01']['pa'] = 0;
			$stpTX[$tblNameT]['stp01']['pl'] = 0;
			$stpTX[$tblNameT]['stp01']['st'] = 0;
		}

	}
	// echo '<pre>';
	// echo var_dump($stpTX);
	// echo '</pre>';


	// レンタカーの証明書情報をすべて取得
	// --------------------------------------------------
	$stp11ALLr 	= 0;
	$stp12ALLr 	= 0;
	$stp01ALLr 	= 0;
	$stp11STr 	= 0;
	$stp12STr 	= 0;
	$stp01STr 	= 0;
	foreach ( $rrRentalcar as $value1 ) {

		// 各レンタカー会社ごとにループしている
		$tblNameR 					= $value1["name"];
		$stpRC[$tblNameR]['name'] 	= $tblNameR;

		if ( $value1['stamp'] != "" ) {

			$stpST11 	= 0;
			$stpST12 	= 0;
			$stpST01 	= 0;

			foreach ( $value1['stamp'] as $value2 ) {

				$tblDay	= intval ( str_replace ( "-", "", $value2['useafter'] ) ); 	// 利用終了日
				$tblPB	= intval ( $value2['pricebefore'] ); 						// 割引前の利用料金
				$tblPA	= intval ( $value2['priceafter'] ); 						// 割引後の利用料金

				// 割引金額の算出
				if ( $tblPA == 0 ) {
					$tblPL 	= $tblPB;
				} else {
					$tblPL 	= $tblPB - $tblPA;
				}

				$stpRC[$tblNameR]['name'] = $tblNameR;

				if ( $tblDay >= 20161101 && $tblDay <= 20161130 ) {
					// 11月の証明書集計
					// ----------------------------------------
					$stpST11++;
					$stpRC[$tblNameR]['stp11']['pb'] = intval ( $stpRC[$tblNameR]['stp11']['pb'] ) + $tblPB;
					$stpRC[$tblNameR]['stp11']['pa'] = intval ( $stpRC[$tblNameR]['stp11']['pa'] ) + $tblPA;
					$stpRC[$tblNameR]['stp11']['pl'] = intval ( $stpRC[$tblNameR]['stp11']['pl'] ) + $tblPL;
					$stpRC[$tblNameR]['stp11']['st'] = $stpST11;

					$stp11ALL += $tblPL;
					$stp11ALLr += $tblPL;
					$stp11ST++;
					$stp11STr++;

				} elseif ( $tblDay >= 20161201 && $tblDay <= 20161231 ) {
					// 12月の証明書集計
					// ----------------------------------------
					$stpST12++;
					$stpRC[$tblNameR]['stp12']['pb'] = intval ( $stpRC[$tblNameR]['stp12']['pb'] ) + $tblPB;
					$stpRC[$tblNameR]['stp12']['pa'] = intval ( $stpRC[$tblNameR]['stp12']['pa'] ) + $tblPA;
					$stpRC[$tblNameR]['stp12']['pl'] = intval ( $stpRC[$tblNameR]['stp12']['pl'] ) + $tblPL;
					$stpRC[$tblNameR]['stp12']['st'] = $stpST12;

					$stp12ALL += $tblPL;
					$stp12ALLr += $tblPL;
					$stp12ST++;
					$stp12STr++;

				} elseif ( $tblDay >= 20170101 && $tblDay <= 20170131 ) {
					// 1月の証明書集計
					// ----------------------------------------
					$stpST01++;
					$stpRC[$tblNameR]['stp01']['pb'] = intval ( $stpRC[$tblNameR]['stp01']['pb'] ) + $tblPB;
					$stpRC[$tblNameR]['stp01']['pa'] = intval ( $stpRC[$tblNameR]['stp01']['pa'] ) + $tblPA;
					$stpRC[$tblNameR]['stp01']['pl'] = intval ( $stpRC[$tblNameR]['stp01']['pl'] ) + $tblPL;
					$stpRC[$tblNameR]['stp01']['st'] = $stpST01;

					$stp01ALL += $tblPL;
					$stp01ALLr += $tblPL;
					$stp01ST++;
					$stp01STr++;

				}

			}

			$resultRENT = $stp11ALLr + $stp12ALLr + $stp01ALLr;
			$nosRENT 	= $stp11STr + $stp12STr + $stp01STr;

		} else {
			$stpRC[$tblNameR]['stp11']['pb'] = 0;
			$stpRC[$tblNameR]['stp11']['pa'] = 0;
			$stpRC[$tblNameR]['stp11']['pl'] = 0;
			$stpRC[$tblNameR]['stp11']['st'] = 0;
			$stpRC[$tblNameR]['stp12']['pb'] = 0;
			$stpRC[$tblNameR]['stp12']['pa'] = 0;
			$stpRC[$tblNameR]['stp12']['pl'] = 0;
			$stpRC[$tblNameR]['stp12']['st'] = 0;
			$stpRC[$tblNameR]['stp01']['pb'] = 0;
			$stpRC[$tblNameR]['stp01']['pa'] = 0;
			$stpRC[$tblNameR]['stp01']['pl'] = 0;
			$stpRC[$tblNameR]['stp01']['st'] = 0;
		}

	}


	// 円グラフ用の集計
	// --------------------------------------------------
	$resultALL 	= $resultTAXI + $resultRENT;	// すべての割引金額
	$nosALL 	= $nosTAXI + $nosRENT;			// すべての証明書枚数


	echo '<h1 class="title" style="padding-left:20px;"><i class="fa fa-pie-chart fa-fw" aria-hidden="true"></i>集計</h1>';

	// 円グラフ
	// --------------------------------------------------
	echo '<div class="displayHidden" style="display:none;">';
		echo '<p id="resultTAXI">' . $resultTAXI . '</p>'; 	// すべてのタクシー会社の割引金額
		echo '<p id="resultRENT">' . $resultRENT . '</p>'; 	// すべてのレンタカー会社の割引金額
		echo '<p id="resultALL">' . $resultALL . '</p>'; 	// すべての割引金額
		echo '<p id="nosTAXI">' . $nosTAXI . '</p>'; 		// すべてのタクシー会社の証明書枚数
		echo '<p id="nosRENT">' . $nosRENT . '</p>'; 		// すべてのレンタカー会社の証明書枚数
		echo '<p id="nosALL">' . $nosALL . '</p>'; 			// すべての証明書枚数
	echo '</div>';

	echo '<div class="clearfix">';
		echo '<div class="wrap-canvas"><h2><i class="fa fa-taxi fa-fw" aria-hidden="true"></i>割引金額 <i class="fa fa-jpy fa-fw" aria-hidden="true"></i>' . number_format( $resultALL ) . '円</h2><canvas id="resGraph" width="350" height="200"></canvas>';
		echo '<h2><i class="fa fa-ticket fa-fw" aria-hidden="true"></i>利用証明書枚数 ' . number_format( $nosALL ) . '枚</h2><canvas id="nosGraph" width="350" height="200"></canvas></div>';
		echo '<div class="wrap-table">';

	// 現在の割引金額総額と利用証明書総枚数
	// --------------------------------------------------
		echo '<h2><i class="fa fa-calendar fa-fw" aria-hidden="true"></i>' . date("Y年m月d日") . ' 現在</h2>';
		echo '<table class="table mb-base"><thead><tr><th>割引金額総額</th><th>利用証明書総枚数</th></tr></thead><tbody><tr>';
		echo '<td>' . number_format( $resultALL ) . '円</td><td>' . number_format( $nosALL ) . '枚</td>';
		echo '</tr></tbody></table>';


		echo '<h2 style="margin-top:70px;"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i>各月の割引金額総額と利用証明書総枚数</h2>';
	    echo '<table class="wp-list-table widefat fixed striped posts mb-base"><thead><tr><th>月</th><th><i class="fa fa-square fa-fw" aria-hidden="true" style="color:#65ace4;"></i>タクシー</th><th><i class="fa fa-square fa-fw" aria-hidden="true" style="color:#a0c238;"></i>レンタカー</th><th>合計</th></tr></thead>';
		echo '<tfoot>';
		echo '<tr>';
		echo '<th>合計</th><td>' . number_format( $resultTAXI ) . '円（' . number_format( $nosTAXI ) . '枚）</td><td>' . number_format( $resultRENT ) . '円（' . number_format( $nosRENT ) . '枚）</td><td>' . number_format( $stp11ALL + $stp12ALL + $stp01ALL ) . '円（' . number_format( $stp11ST + $stp12ST + $stp01ST ) . '枚）</td>';
		echo '</tr>';
		echo '</tfoot><tbody>';
		echo '<tr>';
		echo '<td>11月</td><td>' . number_format( $stp11ALLt ) . '円（' . number_format( $stp11STt ) . '枚）</td><td>' . number_format( $stp11ALLr ) . '円（' . number_format( $stp11STr ) . '枚）</td><td>' . number_format( $stp11ALLt + $stp11ALLr ) . '円（' . number_format( $stp11STt + $stp11STr ) . '枚）</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>12月</td><td>' . number_format( $stp12ALLt ) . '円（' . number_format( $stp12STt ) . '枚）</td><td>' . number_format( $stp12ALLr ) . '円（' . number_format( $stp12STr ) . '枚）</td><td>' . number_format( $stp12ALLt + $stp12ALLr ) . '円（' . number_format( $stp12STt + $stp12STr ) . '枚）</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>1月</td><td>' . number_format( $stp01ALLt ) . '円（' . number_format( $stp01STt ) . '枚）</td><td>' . number_format( $stp01ALLr ) . '円（' . number_format( $stp01STr ) . '枚）</td><td>' . number_format( $stp01ALLt + $stp01ALLr ) . '円（' . number_format( $stp01STt + $stp01STr ) . '枚）</td>';
		echo '</tr>';
		echo '</tbody></table>';

		echo '</div></div>';



	echo '<h1 class="title" style="margin-top:70px;"><span class="dashicons dashicons-awards"></span>各タクシー会社 割引金額<small>（' . count($stpTX) . '社）</small></h1>';
		echo '<table class="wp-list-table widefat fixed striped posts tbl-taxi mb-base"><thead><tr><th>会社名</th><th>11月</th><th>12月</th><th>1月</th><th>合計</th></tr></thead>';
		echo '<tbody>';
		foreach ( $stpTX as $value ) {
			echo '<tr>';
			echo '<td>' . $value["name"] . '</td>
				  <td>' . number_format( $value["stp11"]["pl"] ) . '円（' . number_format ( $value["stp11"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp12"]["pl"] ) . '円（' . number_format ( $value["stp12"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp01"]["pl"] ) . '円（' . number_format ( $value["stp01"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp11"]["pl"] + $value["stp12"]["pl"] + $value["stp01"]["pl"] ) . '円（' . number_format ( $value["stp11"]["st"] + $value["stp12"]["st"] + $value["stp01"]["st"] ) . '枚）</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';

	echo '<h1 class="title"><span class="dashicons dashicons-awards"></span>各レンタカー会社 割引金額<small>（' . count($stpRC) . '社）</small></h1>';
		echo '<table class="wp-list-table widefat fixed striped posts tbl-rental mb-base"><thead><tr><th>会社名</th><th>11月</th><th>12月</th><th>1月</th><th>合計</th></tr></thead>';
		echo '<tbody>';
		foreach ( $stpRC as $value ) {
			echo '<tr>';
			echo '<td>' . $value["name"] . '</td>
				  <td>' . number_format( $value["stp11"]["pl"] ) . '円（' . number_format ( $value["stp11"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp12"]["pl"] ) . '円（' . number_format ( $value["stp12"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp01"]["pl"] ) . '円（' . number_format ( $value["stp01"]["st"] ) . '枚）</td>
				  <td>' . number_format( $value["stp11"]["pl"] + $value["stp12"]["pl"] + $value["stp01"]["pl"] ) . '円（' . number_format ( $value["stp11"]["st"] + $value["stp12"]["st"] + $value["stp01"]["st"] ) . '枚）</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';

		// echo '<pre>';
		// echo var_dump($stpRC);
		// echo '</pre>';
		// echo '<pre>';
		// echo var_dump($rrRentalcar);
		// echo '</pre>';

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

	$stp11 		= 0;
	$stp12 		= 0;
	$stp01 		= 0;
	$stpPB11 	= 0;
	$stpPB12 	= 0;
	$stpPB01 	= 0;

	// 月毎の配列を初期化
	// --------------------------------------------------
		$aryName11 		= array(); // 利用証明書番号 	- 11月
		$aryName12 		= array(); // 利用証明書番号 	- 12月
		$aryName01 		= array(); // 利用証明書番号 	- 01月

	if ( $userType === 'taxi' ) {

		// 配列のカウント
		// ----------------------------------------
			$aryNum 	= count( $rrTaxi[$agrName]['stamp'] );
			$aryStamp 	= $rrTaxi[$agrName]['stamp'];

	} else {

		// 配列のカウント
		// ----------------------------------------
			$aryNum 	= count( $rrRentalcar[$agrName]['stamp'] );
			$aryStamp 	= $rrRentalcar[$agrName]['stamp'];

	}

	foreach ( $aryStamp as $value ) {
		$stpDay 	= intval ( str_replace ( "-", "", $value['useafter'] ) ); // 利用終了日を数値に変換
		$stpPB 		= intval ( $value['pricebefore'] ); // 割引前の利用料金を数値に変換
		$stpPA 		= intval ( $value['priceafter'] ); // 割引後の利用料金を数値に変換

		// 割引金額の算出
		if ( $stpPA == 0 ) {
			$stpPL 	= $stpPB;
		} else {
			$stpPL 	= $stpPB - $stpPA;
		}

		if ( $stpDay >= 20161101 && $stpDay <= 20161130 ) {
			// 11月の証明書集計
			// ----------------------------------------
			$stp11++;
			$num11 = $stp11 + 10000;
			$stpPB11 += $stpPL;

			$aryName11[$num11]['num'] 		= $value['num']; 		// 利用証明書番号 	- 11月
			$aryName11[$num11]['first'] 	= $value['spotname1']; 	// 観光施設1回目 		- 11月
			$aryName11[$num11]['second'] 	= $value['spotname2']; 	// 観光施設2回目 		- 11月
			$aryName11[$num11]['priceB'] 	= $stpPB; 				// 割引前の利用金額 	- 11月
			$aryName11[$num11]['price'] 	= $stpPL; 				// 割引金額 			- 11月
			$aryName11[$num11]['priceA'] 	= $stpPA; 				// 割引後の利用金額 	- 11月

		} elseif ( $stpDay >= 20161201 && $stpDay <= 20161231 ) {
			// 12月の証明書集計
			// ----------------------------------------
			$stp12++;
			$num12 = $stp12 + 20000;
			$stpPB12 += $stpPL;

			$aryName12[$num12]['num'] 		= $value['num']; 		// 利用証明書番号 	- 12月
			$aryName12[$num12]['first'] 	= $value['spotname1']; 	// 観光施設1回目 		- 12月
			$aryName12[$num12]['second'] 	= $value['spotname2']; 	// 観光施設2回目 		- 12月
			$aryName12[$num12]['priceB'] 	= $stpPB; 				// 割引前の利用金額 	- 12月
			$aryName12[$num12]['price'] 	= $stpPL; 				// 割引金額 			- 12月
			$aryName12[$num12]['priceA'] 	= $stpPA; 				// 割引後の利用金額 	- 12月

		} elseif ( $stpDay >= 20170101 && $stpDay <= 20170131 ) {
			// 1月の証明書集計
			// ----------------------------------------
			$stp01++;
			$num01 = $stp01 + 30000;
			$stpPB01 += $stpPL;

			$aryName01[$num01]['num'] 		= $value['num']; 		// 利用証明書番号 	- 1月
			$aryName01[$num01]['first'] 	= $value['spotname1']; 	// 観光施設1回目 		- 1月
			$aryName01[$num01]['second'] 	= $value['spotname2']; 	// 観光施設2回目 		- 1月
			$aryName01[$num01]['priceB'] 	= $stpPB; 				// 割引前の利用金額 	- 1月
			$aryName01[$num01]['price'] 	= $stpPL; 				// 割引金額 			- 1月
			$aryName01[$num01]['priceA'] 	= $stpPA; 				// 割引後の利用金額 	- 1月

		}

	}
	// 証明書枚数と割引金額の算出（合計）
	$stpAll 	= $stp11 + $stp12 + $stp01;
	$stpPBAll 	= $stpPB11 + $stpPB12 + $stpPB01;


	echo '<h1><i class="fa fa-pie-chart fa-fw" aria-hidden="true"></i>集計</h1>';
	// 現在の割引金額総額と利用証明書総枚数
	// --------------------------------------------------
		echo '<table class="table mb-base"><thead><tr><th>割引金額総額（' . date("Y年m月d日") . ' 現在）</th><th>利用証明書総枚数</th></tr></thead><tbody><tr>';
		echo '<td>' . number_format( $stpPBAll ) . '円</td><td>' . number_format( $stpAll ) . '枚</td>';
		echo '</tr></tbody></table>';
		echo '<h2>各月の割引金額総額と利用証明書総枚数</h2>';
	    echo '<table class="wp-list-table widefat fixed striped posts mb-base"><thead><tr><th>月</th><th>枚</th><th>金額</th></tr></thead>';
		echo '<tfoot>';
		echo '<tr>';
		echo '<th>合計</th><td>' . number_format( $stpAll ) . '枚</td><td>' . number_format( $stpPBAll ) . '円</td>';
		echo '</tr>';
		echo '</tfoot><tbody>';
		echo '<tr>';
		echo '<td>11月</td><td>' . number_format( $stp11 ) . '枚</td><td>' . number_format( $stpPB11 ) . '円</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>12月</td><td>' . number_format( $stp12 ) . '枚</td><td>' . number_format( $stpPB12 ) . '円</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>1月</td><td>' . number_format( $stp01 ) . '枚</td><td>' . number_format( $stpPB01 ) . '円</td>';
		echo '</tr>';
		echo '</tbody></table>';

	// 各月の利用証明書
	// --------------------------------------------------
	echo '<h1><span class="dashicons dashicons-awards"></span>月毎の利用証明書</h1>';
	echo '<h2><span class="dashicons dashicons-calendar-alt"></span>11月</h2>';
	echo '<table class="wp-list-table widefat fixed striped posts mb-base"><thead><tr><th>利用証明書番号</th><th>観光施設（1回目）</th><th>観光施設（2回目）</th><th>割引前の利用料金</th><th>割引金額</th><th>割引後の利用料金</th></tr></thead><tbody>';
	foreach ( $aryName11 as $value ) {
		echo '<tr>';
		echo '<td>' . $value["num"] . '</td><td>' . $value["first"] . '</td><td>' . $value["second"] . '</td><td>' . number_format( $value["priceB"] ) . '円</td><td>' . number_format( $value["price"] ) . '円</td><td>' . number_format( $value["priceA"] ) . '円</td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
	echo '<h2><span class="dashicons dashicons-calendar-alt"></span>12月</h2>';
	echo '<table class="wp-list-table widefat fixed striped posts mb-base"><thead><tr><th>利用証明書番号</th><th>観光施設（1回目）</th><th>観光施設（2回目）</th><th>割引前の利用料金</th><th>割引金額</th><th>割引後の利用料金</th></tr></thead><tbody>';
	foreach ( $aryName12 as $value ) {
		echo '<tr>';
		echo '<td>' . $value["num"] . '</td><td>' . $value["first"] . '</td><td>' . $value["second"] . '</td><td>' . number_format( $value["priceB"] ) . '円</td><td>' . number_format( $value["price"] ) . '円</td><td>' . number_format( $value["priceA"] ) . '円</td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
	echo '<h2><span class="dashicons dashicons-calendar-alt"></span>1月</h2>';
	echo '<table class="wp-list-table widefat fixed striped posts mb-base"><thead><tr><th>利用証明書番号</th><th>観光施設（1回目）</th><th>観光施設（2回目）</th><th>割引前の利用料金</th><th>割引金額</th><th>割引後の利用料金</th></tr></thead><tbody>';
	foreach ( $aryName01 as $value ) {
		echo '<tr>';
		echo '<td>' . $value["num"] . '</td><td>' . $value["first"] . '</td><td>' . $value["second"] . '</td><td>' . number_format( $value["priceB"] ) . '円</td><td>' . number_format( $value["price"] ) . '円</td><td>' . number_format( $value["priceA"] ) . '円</td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
}



// 元の投稿データを復元
wp_reset_postdata();