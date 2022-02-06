<div class="header-left">
  <a href="index" onclick="initialize()"><img src="logo/logo_green.png" alt="" height="65px" style="margin-left: 20px;"></a>

</div>
<input id="menu-btn-check" class="hide" type="checkbox">
<label for="menu-btn-check" id="bar-icon"><img class="bar-icon"src="image/menu.png" alt="menu" width="50px" height="50px"></label>
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
