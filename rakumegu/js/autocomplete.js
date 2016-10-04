jQuery(document).ready(function($) {
	$(document).on("click", "#switch", (function(){
		// Ajax 実行
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				// functions.phpに記載されている関数を実行
				'action' : 'ajax_get_stay_list',
			},
			success: function( response ) {
				// console.log('koko-OK');
				jsonData 			= JSON.parse( response );
				var count 			= jsonData.length;
				var availableTags 	= new Array();
				// console.log('count-OK');
				if ( count == '0' ) {
					// 検索結果がない場合
				} else {
					// リストに出力
					$.each( jsonData, function( i, val ){
						// $('#hotel1_0').append('<option value="' + val['post_title'] + '">' + val['post_title'] + '</option>');
						availableTags[i] = val['post_title'];
					});
					// console.log(availableTags-OK);
					$("#hotel1_0").autocomplete({
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