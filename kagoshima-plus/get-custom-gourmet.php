<?php

$memberStatus 	= post_custom('member-status'); 	// 会員ステータス
$city 			= post_custom('city'); 				// 市町村
$address 		= post_custom('address'); 			// 市町村以降の住所
$tel 			= post_custom('tel'); 				// 電話番号
$openLast 		= post_custom('open-last'); 		// 営業時間
$holiday 		= post_custom('holiday'); 			// 定休日
$introduction 	= post_custom('introduction'); 		// 店舗紹介
$areaKagoshima 	= post_custom('area-kagoshima'); 	// 鹿児島市エリア
$areaAira 		= post_custom('area-aira'); 		// 姶良市・霧島市エリア
$areaHokusatsu 	= post_custom('area-hokusatsu'); 	// 北薩エリア
$areaNakasatsu 	= post_custom('area-nakasatsu'); 	// 中薩エリア
$areaNansatsu 	= post_custom('area-nansatsu'); 	// 南薩エリア
$areaOsumi 		= post_custom('area-osumi'); 		// 大隅エリア
$genre 			= post_custom('genre'); 			// ジャンル
$service 		= post_custom('service'); 			// サービス
$facility 		= post_custom('facility'); 			// 設備
$scene 			= post_custom('scene'); 			// シーン
$outphoto 		= wp_get_attachment_image_src(post_custom('outphoto'),'full' ); 	// 外観写真
$inphoto 		= wp_get_attachment_image_src(post_custom('inphoto'),'full' ); 		// 内観写真
$gallery 		= post_custom('gallery'); 			// ギャラリー
$car 			= post_custom('car'); 				// 駐車場
$credit 		= post_custom('credit'); 			// クレジットカード
$charge 		= post_custom('charge'); 			// サービス・チャージ料
$seat 			= post_custom('seat'); 				// 席数
$private 		= post_custom('private'); 			// 個室
$site 			= post_custom('site'); 				// ホームページ
$note 			= post_custom('note'); 				// 備考

?>