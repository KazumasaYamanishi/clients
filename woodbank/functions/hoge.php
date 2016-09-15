<?php





// セッションの削除
if (
  !isset($_POST['type']) ||
  $_POST['type'] !== 'delete' ||
  !isset($_POST['id'])
) {
    header('Content-Type: application/json', true, 400);
    echo json_encode(['msg' => '商品の削除が失敗しました。']);
    echo 'koko1';
    exit();
}

foreach ($_SESSION['items'] as $key => $item) {

  if ($_SESSION['items'][$key]['id'] === $_POST['id']) {
      unset($_SESSION['items'][$key]);
      echo 'koko2';
      break;
  }

}

header('Content-Type: application/json', true, 201);
echo json_encode([
    'msg' => '商品の削除が成功しました。',
    'items' => $_SESSION['items']
]);