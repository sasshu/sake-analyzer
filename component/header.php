<div class="header-left">
  <h1>Sake Analyzer</h1>
</div>
<ul class="header-right">
  <li><a href="index" onclick="initialize()">ホーム</a></li>
  <li id="search-head">
    <a href="#">検索</a>
    <ul id="search-menu" class="header-right-child">
      <li><a href="search-property" onclick="initialize()">成分を検索</a></li>
      <li><a href="search-ingredient" onclick="initialize()">原料を検索</a></li>
      <li><a href="search-manufacture" onclick="initialize()">製法を検索</a></li>
    </ul>
  </li>
  <li><a href="credit-brewery" onclick="initialize()">データ提供元</a></li>
  <li><a href="contact" onclick="initialize()">お問い合わせ</a></li>
  <?php
  if (isset($_SESSION['username'])) {
    echo '<li><a href="logout" onclick="return noteLogout()">ログアウト</a></li>';
  }else {
    echo '<li><a href="login">ログイン</a></li>';
  }
  ?>

</ul>
