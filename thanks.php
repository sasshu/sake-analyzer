<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>お問い合わせ | SakeAnalyzer</title>
  <link rel="stylesheet" href="component/sake_app.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>
    <?php include("component/header.html"); ?>
  </header>
  <div class="contact-wrapper">
    <div class="container">
      <h1 class="section-title">お問い合わせ</h1>
      <div class="thanks-message">
        <i class="fas fa-check-circle"></i>
        <h2>送信完了</h2>
        <p>お問い合わせいただきありがとうございました。</p>
        <p>お送りいただきました内容を確認の上、折り返しご連絡させていただきます。</p>
      </div>
    </div>
  </div>
  <footer>
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
