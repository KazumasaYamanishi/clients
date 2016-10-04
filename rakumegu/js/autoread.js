jQuery(function() {
    //投稿の編集画面だったら実行
    var url        = location.search;
    var newPostURL = location.pathname;
    if (url.indexOf("post") != -1 && url.indexOf("action=edit") != -1 || newPostURL.indexOf("post-new.php") != -1) {
        setTimeout(function() {
            //読み込みボタンがの有り無しチェック
            if (jQuery("#cft_selectbox .button").length == 1) {
                //カスタムフィールドの読み込みボタンをクリック
                jQuery("#cft_selectbox .button").click();
            }
        },100);
    }
});