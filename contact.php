<?php
require_once('component/user_manage.php');
@session_start();
$_SESSION['url'] = getUrl();
require_logined_session();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <?php require_once('component/function.php'); ?>
  <title>お問い合わせ | Sake Analyzer</title>
  <link rel="stylesheet" href="component/sake_app.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
  <link rel="icon" href="logo/favicon.png">
</head>
<body>
  <header>
    <?php include("component/header.php"); ?>
  </header>
  <div class="contact-wrapper">
    <div class="container">
      <h1 class="section-title">お問い合わせ</h1>
      <form id="contact_form" action="https://api.staticforms.xyz/submit" method="post">
        <input type="hidden" name="accessKey" value="da725dd4-44cc-481c-86f9-6868cfd19c50">
        <input id="subject" type="hidden" name="subject" value="【問い合わせ】">
        <!-- <input type="hidden" name="redirectTo" value="http://localhost/SakeAnalyzer/thanks"> -->
        <input type="hidden" name="redirectTo" value="https://sake-analyzer.herokuapp.com/thanks">
        <input type="hidden" name="replyTo" value="@">
        <div class="contact">
          <div class="contact-list">
            <label for="name" class="required label">名前</label>
            <div class="input-area">
              <input id="name" class="text-input" type="text" name="$名前" placeholder="酒蔵 太郎" oninput="resetFormCss(this)">
            </div>
          </div>
          <div class="contact-list">
            <label for="company" class="required label">会社名</label>
            <div class="input-area">
              <input id="company" class="text-input" type="text" name="$会社名" placeholder="〇〇酒造株式会社" oninput="resetFormCss(this)">
            </div>
          </div>
          <div class="contact-list">
            <label for="position" class="option">役職</label>
            <div class="input-area">
              <input id="position" class="text-input" type="text" name="$役職" placeholder="杜氏">
            </div>
          </div>
          <div class="contact-list">
            <label for="email" class="required label">メールアドレス</label>
            <div class="input-area">
              <input id="email" class="text-input" type="email" name="$メールアドレス" placeholder="example@mail.com" oninput="resetFormCss(this)">
            </div>
          </div>
          <div class="contact-list">
            <label for="phone" class="option">電話番号</label>
            <div class="input-area">
              <input id="phone" class="text-input" type="phone" name="$電話番号" placeholder="090-1234-5678" pattern="[0-9]{3}-[0-9]{3,4}-[0-9]{4}">
            </div>
          </div>
          <div class="contact-list">
            <p class="required">お問い合わせ内容</p>
            <div id="contact-type" class="text-input" style="margin-top: 5px;">
              <label class="form-check"><input class="element" type="checkbox" name="$お問い合わせ内容" value="アプリ機能に対する意見・要望" oninput="resetFormCss(this)">本アプリケーションの機能に対する意見や要望</label>
              <label class="form-check" style="margin-top: 5px;"><input class="element" type="checkbox" name="$お問い合わせ内容" value="アプリの不具合" oninput="resetFormCss(this)">本アプリケーションでの意図しない動作についての連絡</label>
              <label class="form-check" style="margin-top: 5px;"><input class="element" type="checkbox" name="$お問い合わせ内容" value="データ提供の希望" oninput="resetFormCss(this)">本アプリケーションに新たに追加していただける日本酒データの提供の申し出</label>
              <label class="form-check" style="margin-top: 5px;"><input class="element" type="checkbox" name="$お問い合わせ内容" value="データの更新" oninput="resetFormCss(this)">本アプリケーションで既に使用している日本酒データの更新の申し出</label>
              <label class="form-check" style="margin-top: 5px;"><input class="element" type="checkbox" name="$お問い合わせ内容" value="その他" oninput="resetFormCss(this)">その他</label>
            </div>
          </div>
          <div class="contact-list">
            <label for="message" class="required label">お問い合わせ内容の詳細</label>
            <div class="input-area">
              <textarea id="message" class="text-input" name="$お問い合わせ内容の詳細" rows="10" placeholder="お問い合わせ内容を詳しく入力してください" oninput="resetFormCss(this)"></textarea>
            </div>
          </div>
        </div>
        <div class="contact-submit">
          <input class="btn contact-btn" type="submit" onclick="return checkRequest();" value="送信">
        </div>
      </form>
      <div id="page_top">
        <a href="#"></a>
      </div>
    </div>
  </div>
  <footer>
    <?php include("component/footer.php"); ?>
  </footer>
</body>
</html>
