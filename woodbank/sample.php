<?php



$args = $_SESSION["items"];
$args = array_values($args);



// ==================================================
//	セッションに保存
// ==================================================
if( isset( $_GET['itemid'] ) ) {

	if( count( $args ) >= 3 ){
		// echo '<p>多いよ</p>';
	} else {

		$args[] 	= array(
					'id' 	=> $_GET['itemid'],
					'name' 	=> $_GET['flrname'],
		);
	}

}



// ==================================================
//	セッションに保存されている内容を表示
// ==================================================
if( !empty( $args ) ) {

	echo '<table class="table"><thead><tr><th>ID</th><th>商品名</th><th>削除</th></tr></thead><tbody>';

}

for( $i = 0; $i < 3; $i++ ) {

	if( isset( $args[$i] ) ) {

		echo '<tr id="items-' . $i . '"><td>' . $args[$i]["id"] . '</td><td>' . $args[$i]["name"] . '</td><td><p class="btn-remove" onclick="delThisTR(this)">削除</p></td></tr>';

	}

}
echo '</tbody></table><p id="str"></p>';


// echo '<pre>';
// var_dump( $args );
// echo '</pre>';
