<?php
require_once('component/user_manage.php');
require_unlogined_session();

// 事前に生成したユーザごとのパスワードハッシュの配列
$hashes = [
    'hogehoge' => '$2y$10$.kS/1uXTDpH6B6.M236E/.Ey.uQENtT9Pg2Khby7PCPxqRTRntt4m',
];

// ユーザから受け取ったユーザ名とパスワード
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

// POSTメソッドのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        validate_token(filter_input(INPUT_POST, 'token')) &&
        password_verify(
            $password,
            isset($hashes[$username])
                ? $hashes[$username]
                : '$2y$10$abcdefghijklmnopqrstuv' // ユーザ名が存在しないときだけ極端に速くなるのを防ぐ
        )
    ) {
        // 認証が成功したとき
        // セッションIDの追跡を防ぐ
        session_regenerate_id(true);
        // ユーザ名をセット
        $_SESSION['username'] = $username;
        // ログイン完了後に指定ページに遷移
        if (isset($_SESSION['url'])) {
          header("Location: ${_SESSION['url']}");
          unset($_SESSION['url']);
        }else {
          header("Location: ./");
        }
        exit;
    }
    // 認証が失敗したとき
    // 「403 Forbidden」
    http_response_code(403);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>      <!-- jQueryの読み込み -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>     <!-- Google Chartsの読み込み -->
  <script type="text/javascript" src="sgvizler.js"></script>     <!-- Sgvizlerの読み込み -->
  <script type="text/javascript">
    $(document).ready(() => {sgvizler.containerDrawAll();});
  </script>     <!-- Sgvizlerコンテナの呼び出し -->
  <title>ログイン | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.php"); ?>
  </header>
  <div class="login-wrapper">
    <div class="container">
      <h1 class="section-title">ログイン</h1>
      <form id="login_form" method="post" action="">
        <p>ID</p>
        <input class="login-element" type="text" name="username" placeholder="ID">
        <p>Password</p>
        <input class="login-element" type="password" name="password" placeholder="Password">
        <input class="login-element" type="hidden" name="token" value="<?=h(generate_token())?>">
        <input class="login-button" type="submit" value="ログイン">
      </form>
      <?php if (http_response_code() === 403): ?>
        <p style="color: red;">ユーザ名またはパスワードが違います</p>
      <?php endif; ?>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.php"); ?>
  </footer>
</body>
</html>
