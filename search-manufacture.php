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
  <?php require_once('component/function.php'); ?>
  <title>製法を検索 | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">製法を検索</h1>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（製法）</h2>
        <div class="manufacture-search">     <!-- 検索対象 = 製法 -->
          <label><input class="element main" type="radio" name="manufacture" value="ricePolishing" onclick="offRadio(this, 1)" <?php sRadio('manufacture', 'ricePolishing'); ?>>精米法</label>
          <label><input class="element main" type="radio" name="manufacture" value="ricePolishingRate" onclick="offRadio(this, 2)" <?php sRadio('manufacture', 'ricePolishingRate'); ?>>精米歩合</label>
          <label><input class="element main" type="radio" name="manufacture" value="kojiMaking" onclick="offRadio(this, 3)" <?php sRadio('manufacture', 'kojiMaking'); ?>>製麹法</label>
          <label><input class="element main" type="radio" name="manufacture" value="fermentationStarter" onclick="offRadio(this, 4)" <?php sRadio('manufacture', 'fermentationStarter'); ?>>酒母造り</label>
          <label><input class="element main" type="radio" name="manufacture" value="fermentationMash" onclick="offRadio(this, 5)" <?php sRadio('manufacture', 'fermentationMash'); ?>>段仕込み段数</label>
          <label><input class="element main" type="radio" name="manufacture" value="pressing" onclick="offRadio(this, 6)" <?php sRadio('manufacture', 'pressing'); ?>>上槽法</label>
          <label><input class="element main" type="radio" name="manufacture" value="pressingOrder" onclick="offRadio(this, 7)" <?php sRadio('manufacture', 'pressingOrder'); ?>>搾り取る順番</label>
          <label><input class="element main" type="radio" name="manufacture" value="pasteurization" onclick="offRadio(this, 8)" <?php sRadio('manufacture', 'pasteurization'); ?>>火入れ</label>
          <label><input class="element main" type="radio" name="manufacture" value="storage" onclick="offRadio(this, 9)" <?php sRadio('manufacture', 'storage'); ?>>貯蔵容器</label>
          <label><input class="element main" type="radio" name="manufacture" value="aging" onclick="offRadio(this, 10)" <?php sRadio('manufacture', 'aging'); ?>>熟成の程度</label>
          <label><input class="element main" type="radio" name="manufacture" value="premiumSake" onclick="offRadio(this, 11)" <?php sRadio('manufacture', 'premiumSake'); ?>>特定名称</label>
          <!--
          <label><input class="element main" type="radio" name="manufacture" value="unfilteredSake" onclick="offRadio(this, 12)" <?php sRadio('manufacture', 'unfilteredSake'); ?>>無濾過酒</label>
          <label><input class="element main" type="radio" name="manufacture" value="undilutedSake" onclick="offRadio(this, 13)" <?php sRadio('manufacture', 'undilutedSake'); ?>>原酒</label>
          <label><input class="element main" type="radio" name="manufacture" value="cloudySake" onclick="offRadio(this, 14)" <?php sRadio('manufacture', 'cloudySake'); ?>>にごり酒</label>
          <label><input class="element main" type="radio" name="manufacture" value="orizake" onclick="offRadio(this, 15)" <?php sRadio('manufacture', 'orizake'); ?>>おり酒</label>
          <label><input class="element main" type="radio" name="manufacture" value="firstlyMadeSake" onclick="offRadio(this, 16)" <?php sRadio('manufacture', 'firstlyMadeSake'); ?>>初しぼり</label>
          <label><input class="element main" type="radio" name="manufacture" value="sparklingSake" onclick="offRadio(this, 17)" <?php sRadio('manufacture', 'sparklingSake'); ?>>発泡清酒</label>
          -->
          <label><input class="element main" type="radio" name="manufacture" value="other" onclick="offRadio(this, 18)" <?php sRadio('manufacture', 'other'); ?>>その他</label>
        </div>
      </div>
      <?php include("component/search_option.php"); ?>
      <div class="form-execute"><input type="submit" class="btn query-btn" value="この条件で検索" onclick="return checkMan();"></div>     <!-- 検索ボタン -->
      <form class="others" action="" method="post">
        <div class="initialize"><input type="submit" class="btn init-btn" name="init" value="検索条件を初期化"></div>      <!-- 初期化ボタン -->
      </form>
    </div>
  </form>
  <?php
  if (!isset($_POST['manufacture'])) {
    $attr = 'hide';
  }else {
    $attr = 'result-wrapper';
    $man = $_POST['manufacture'];
    $chart = '';
  }
  ?>
  <div id="result" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div class="data-count">
        <div id="count-query" class="query"
        data-sgvizler-endpoint="<?php getEndpoint(); ?>"
        data-sgvizler-query="
        <?php preQuery(); ?>

        select (count(?s) as ?count) where
        {
          ?s a sk-eval:Sake .
          <?php man($man); ?>
          <?php addmCon(); ?>
        }
        "
        data-sgvizler-chart="sgvizler.visualization.Text"
        data-sgvizler-chart-options="">
        </div>
        <p>件ヒットしました。</p>
      </div>
      <div id="manufacture-query" class="query"
      data-sgvizler-endpoint="<?php getEndpoint(); ?>"
      data-sgvizler-query="
      <?php preQuery(); ?>

      select ?man (count(?s) as ?count) where
      {
        ?s a sk-eval:Sake .
        <?php man($man); ?>
        <?php addmCon(); ?>
      }
      <?php dataSort($man); ?>
      "
      data-sgvizler-chart="<?php selectChart($man); ?>"
      data-sgvizler-chart-options=""
      style="width:90%; height:500px;">
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
