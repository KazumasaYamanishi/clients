jQuery(document).ready(function($) {
 	$(document).on("click", "#switch", (function(){
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				// functions.phpに記載されている関数を実行
				'action' : 'ajax_get_spot_list',
			},
			success: function( response ) {
				jsonData 			= JSON.parse( response );
				var count 			= jsonData.length;
				var availableTags 	= new Array();
				if ( count == '0' ) {
					// 検索結果がない場合
				} else {
					// リストに出力
					$.each( jsonData, function( i, val ){
						availableTags[i] = val['post_title'];
					});
					$("#sightseeing014_0").autocomplete({
						source: availableTags
					});
					$("#sightseeing026_0").autocomplete({
						source: availableTags
					});
				}
			},
			error: function( response ) {
				// ajaxエラーの場合
			}
		});
	}));
});