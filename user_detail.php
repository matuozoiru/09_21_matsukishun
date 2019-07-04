<?php
// セッションのスタート
// session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
// chk_ssid();

// $menu = menu();

// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT*FROM user_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
}

//PHPのif文
// $radio = $rs['kanri_flg'];
// if ($radio == 0) {
//     print < input typ e     ="radio" cl       a  s s="form-cont r o l"   v al  u  e= 0  che ck  e   d= " checke d "    i  d ="  k an ri_fl g" na  m e="kanri_fl g">;
// }


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー更新ページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ユーザー更新</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">ユーザー登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_select.php">ユーザー一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="post" action="user_update.php">
        <div class="form-group">
            <label for="name">Name</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="name" name="name" value="<?= $rs['name'] ?>">
        </div>
        <div class="form-group">
            <label for="lid">LoginID</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="email" class="form-control" id="lid" name="lid" value="<?= $rs['lid'] ?>">
        </div>
        <div class=" form-group">
            <label for="lpw">Password</label>
            <!-- 受け取った値挿入しよう -->
            <input type="password" class="form-control" id="lpw" name="lpw" value="<?= $rs['lpw'] ?>"> </div>

        <div class="form-group">
            <label for="kanri_fig"></label>

            <?php if ($rs['kanri_flg'] == 0) : ?>
                一般<input type="radio" class="form-control" value=0 checked="checked" id="kanri_flg" name="kanri_flg">
                管理者 <input type="radio" class="form-control" value=1 id="kanri_flg" name="kanri_flg">
            <?php else : ?>
                一般<input type="radio" class="form-control" value=0 id="kanri_flg" name="kanri_flg">
                管理者 <input type="radio" class="form-control" value=1 checked="checked" id="kanri_flg" name="kanri_flg">
            <?php endif; ?>
        </div>

        <div class="form-group ">
            <label for="life_fig "> </label>
            <?php if ($rs['life_flg'] == 0) : ?>
                アクティブ<input type="radio" class="form-control" value=0 checked="checked" id="life_flg" name="life_flg">
                非アクティブ<input type="radio" class="form-control" value=1 id="life_flg" name="life_flg">
            <?php else : ?>
                アクティブ<input type="radio" class="form-control" value=0 id="life_flg" name="life_flg">
                非アクティブ<input type="radio" class="form-control" value=1 checked="checked" id="life_flg" name="life_flg">
            <?php endif; ?>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする idも送られてくる-->
        <input type="hidden" name="id" value="<?= $rs['id'] ?>">
    </form>

</body>

</html>