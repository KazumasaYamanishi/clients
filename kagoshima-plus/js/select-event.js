// ==============================
// 並べ替え - グルメ
// ==============================
jQuery(document).ready(function($){
	$("#select-gourmet").change(function() {

		var selectKey = $('[name=select-gourmet]').val();

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action : 'extraGourmetAjax',
				selectKey : selectKey,
			},
			success: function( response ){

					jsonData = JSON.parse( response );
					var count = Object.keys(jsonData).length;
					if ( count == '0' ) {
						// 検索結果がない場合
						$('.extra-error').fadeIn(1000).delay(2000).fadeOut(2000);
					} else {
						$("#extra-area .row").fadeOut(500).queue(function() {
							this.remove();
						});
						$('#extra-area').append('<div class="row row-10">');
						// console.log(jsonData);
						// console.log(count);
						// リストに出力
						$.each( jsonData, function( i, val ){
							// $('#debug-area').append('<p>' + val['post_title'] + '</p>');

							var baseDirectory 	= '#extra-area .row';
							var subDirectory 	= '#extra-area .row .col-xs-6 article .sort-' + i;
							var subTag 			= '<div class="col-xs-6 col-sm-3"><article><div class="inner height-some sort-' + i + '">';
							var subThumbnail 	= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-thumbnail';
							var subName 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-name';
							var subAddress 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-tel-adrs .list-inline';
							var subGenre 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-genre .list-inline';
							var subService 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-service .list-inline';

							$(baseDirectory).append(subTag);
							$(subDirectory).append('<div class="wrap-thumbnail">');
							$(subThumbnail).append('<img src="' + val['post_eyecatch'] + '" class="main-img lr-center">');
							$(subDirectory).append('<div class="wrap-name bg-base">');
							$(subName).append('<h1>' + val['post_title'] + '</h1>');
							$(subDirectory).append('<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">');
							$(subAddress).append('<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>' + val['post_area'] + '</li>');

							var aryGenre = val['post_genre'];
							if ( aryGenre ) {
								$(subDirectory).append('<div class="wrap-genre bg-base-light"><ul class="list-inline">');
								if ( $.isArray(aryGenre) ) {
									for ( j = 0; j < aryGenre['length']; j++ ) {
										$(subGenre).append('<li>' + aryGenre[j] + '</li>');
									}
								} else {
									$(subGenre).append('<li>' + val['post_genre'] + '</li>');
								}
							}

							var aryKeywords = val['post_keywords'];
							if ( aryKeywords ) {
								$(subDirectory).append('<div class="wrap-service bg-base-light"><ul class="list-inline">');
								if ( $.isArray(aryKeywords) ) {
									var num = aryKeywords['length'];
									if ( num > 3 ) {
										num = 3;
									}
									for ( j = 0; j < num; j++ ) {
										$(subService).append('<li>' + aryKeywords[j] + '</li>');
									}
								} else {
									$(subService).append('<li>' + val['post_keywords'] + '</li>');
								}
							}

							$(subDirectory).append('<a href="' + val['post_link'] + '" class="link-cover"></a>');

						});
					}
					$('.height-some').matchHeight();
				}
				// ,
			// error: function(){
					// alert("リクエスト失敗" );
				// },
			// complete: function(){
					// alert( "Ajax処理終了" );
				// }
		});
	});
});
// ==============================
// 並べ替え - ビューティー＆ヘルス
// ==============================
jQuery(document).ready(function($){
	$("#select-beauty").change(function() {

		var selectKey = $('[name=select-beauty]').val();

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action : 'extraBeautyAjax',
				selectKey : selectKey,
			},
			success: function( response ){

					jsonData = JSON.parse( response );
					var count = Object.keys(jsonData).length;
					if ( count == '0' ) {
						// 検索結果がない場合
						$('.extra-error').fadeIn(1000).delay(2000).fadeOut(2000);
						console.log(selectKey);
					} else {
						$("#extra-area .row").fadeOut(500).queue(function() {
							this.remove();
						});
						$('#extra-area').append('<div class="row row-10">');

						// リストに出力
						$.each( jsonData, function( i, val ){

							var baseDirectory 	= '#extra-area .row';
							var subDirectory 	= '#extra-area .row .col-xs-6 article .sort-' + i;
							var subTag 			= '<div class="col-xs-6 col-sm-3"><article><div class="inner height-some sort-' + i + '">';
							var subThumbnail 	= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-thumbnail';
							var subName 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-name';
							var subAddress 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-tel-adrs .list-inline';
							var subGenre 		= '#extra-area .row .col-xs-6 article .sort-' + i + ' .wrap-genre .list-inline';

							$(baseDirectory).append(subTag);
							$(subDirectory).append('<div class="wrap-thumbnail">');
							$(subThumbnail).append('<img src="' + val['post_eyecatch'] + '" class="main-img lr-center">');
							$(subDirectory).append('<div class="wrap-name bg-base">');
							$(subName).append('<h1>' + val['post_title'] + '</h1>');
							$(subDirectory).append('<div class="wrap-tel-adrs bg-base-light"><ul class="list-inline">');
							$(subAddress).append('<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>' + val['post_area'] + '</li>');

							var aryGenre = val['post_genre'];
							if ( aryGenre ) {
								$(subDirectory).append('<div class="wrap-genre bg-base-light"><ul class="list-inline">');
								if ( $.isArray(aryGenre) ) {
									for ( j = 0; j < aryGenre['length']; j++ ) {
										$(subGenre).append('<li>' + aryGenre[j] + '</li>');
									}
								} else {
									$(subGenre).append('<li>' + val['post_genre'] + '</li>');
								}
							}

							$(subDirectory).append('<a href="' + val['post_link'] + '" class="link-cover"></a>');

						});
					}
					$('.height-some').matchHeight();
				}
		});
	});
});