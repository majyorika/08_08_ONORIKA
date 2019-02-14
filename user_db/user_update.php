<?php
// 関数ファイル読み込み
include('functions.php');

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['name']) || $_POST['name']=='' ||
    !isset($_POST['lid']) || $_POST['lid']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$id=$_POST['id'];
$name = $_POST['name'];
$lid = $_POST['lid'];
$comment = $_POST['comment'];

//DB接続します(エラー処理追加)
$pdo=db_conn();

//ユーザ登録SQL作成
$sql = 'UPDATE user_table SET name=:a1,lid=:a2,comment=:a3 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．ユーザ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location:select.php');
    exit;
}
