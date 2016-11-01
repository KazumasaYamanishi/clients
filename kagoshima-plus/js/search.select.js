jQuery(document).ready(function($){
	$(".box-select").on("click", function() {
        $(this).next().slideToggle();
        $(this).toggleClass("search-on");
    });
});



// 並べ替え - グルメ
jQuery(document).ready(function($){
	$("#select-gourmet").change(function()) {

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
					var count = jsonData.length;
					if ( count == '0' ) {
						// 検索結果がない場合
					} else {
						// リストに出力
						console.log(jsonData);
					}
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