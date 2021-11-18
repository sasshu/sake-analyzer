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
  <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/x-icon" href="image/favicon.ico">
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
          <label><input class="element main" type="radio" name="manufacture" value="ricePolishingRate" onclick="offRadio(this, 1)" <?php sRadio('manufacture', 'ricePolishingRate'); ?>>精米歩合</label>
          <label><input class="element main" type="radio" name="manufacture" value="fermentationStarter" onclick="offRadio(this, 2)" <?php sRadio('manufacture', 'fermentationStarter'); ?>>酒母造り</label>
          <label><input class="element main" type="radio" name="manufacture" value="fermentationMash" onclick="offRadio(this, 3)" <?php sRadio('manufacture', 'fermentationMash'); ?>>もろみ造り</label>
          <label><input class="element main" type="radio" name="manufacture" value="pressing" onclick="offRadio(this, 4)" <?php sRadio('manufacture', 'pressing'); ?>>搾り</label>
          <label><input class="element main" type="radio" name="manufacture" value="ricePolishing" onclick="offRadio(this, 5)" <?php sRadio('manufacture', 'ricePolishing'); ?>>精米</label>
          <label><input class="element main" type="radio" name="manufacture" value="kojiMaking" onclick="offRadio(this, 6)" <?php sRadio('manufacture', 'kojiMaking'); ?>>製麹</label>
          <label><input class="element main" type="radio" name="manufacture" value="storage" onclick="offRadio(this, 7)" <?php sRadio('manufacture', 'storage'); ?>>貯蔵</label>
          <label><input class="element main" type="radio" name="manufacture" value="premiumSake" onclick="offRadio(this, 8)" <?php sRadio('manufacture', 'premiumSake'); ?>>特定名称等</label>
          <label><input class="element main" type="radio" name="manufacture" value="pasteurization" onclick="offRadio(this, 9)" <?php sRadio('manufacture', 'pasteurization'); ?>>火入れ</label>
          <label><input class="element main" type="radio" name="manufacture" value="pressingOrder" onclick="offRadio(this, 10)" <?php sRadio('manufacture', 'pressingOrder'); ?>>搾り取る順番</label>
          <label><input class="element main" type="radio" name="manufacture" value="aging" onclick="offRadio(this, 11)" <?php sRadio('manufacture', 'aging'); ?>>熟成</label>
          <label><input class="element main" type="radio" name="manufacture" value="other" onclick="offRadio(this, 12)" <?php sRadio('manufacture', 'other'); ?>>その他</label>
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
  }
  ?>
  <div id="result" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div id="manufacture-query"
      data-sgvizler-endpoint="http://echigodb.jp:8893/sparql/"
      data-sgvizler-query="
      PREFIX schema: <http://schema.org/>
      PREFIX sk-eval: <http://www.sakevoc.jp/eval/>
      PREFIX sk-prep: <http://www.sakevoc.jp/prep/>
      PREFIX sk-make: <http://www.sakevoc.jp/make/>
      with <http://sake_data>

      select ?ing (count(?s) as ?count) where
      {
        select distinct ?s ?ing where
          {
            ?s a sk-eval:Sake ;
               schema:material ?ingredient .
               <?php man($man); ?>
               <?php addmCon(); ?>
          }
      }
      order by desc(?count)
      "
      data-sgvizler-chart="google.visualization.PieChart"
      style="width:90%; height:500px;">
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
