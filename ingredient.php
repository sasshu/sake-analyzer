<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>      <!-- jQueryの読み込み -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>     <!-- Google Chartsの読み込み -->
  <script type="text/javascript" src="https://mgskjaeveland.github.io/sgvizler/v/0.6/sgvizler.js"></script>     <!-- Sgvizlerの読み込み -->
  <script type="text/javascript">
    $(document).ready(() => {sgvizler.containerDrawAll();});
  </script>     <!-- Sgvizlerコンテナの呼び出し -->
  <?php require_once('component/function.php'); ?>
  <title>原料を検索 | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">原料を検索</h1>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（原料）</h2>
        <div class="ingredient-search">     <!-- 検索対象 = 原料 -->
          <label><input class="element main" type="radio" name="ingredient" value="rice" onclick="offRadio(this, 1)" <?php sRadio('ingredient', 'rice'); ?>>米</label>
          <label><input class="element main" type="radio" name="ingredient" value="yeast" onclick="offRadio(this, 2)" <?php sRadio('ingredient', 'yeast'); ?>>酵母</label>
          <label><input class="element main" type="radio" name="ingredient" value="koji" onclick="offRadio(this, 3)" <?php sRadio('ingredient', 'koji'); ?>>麹</label>
          <label><input class="element main" type="radio" name="ingredient" value="water" onclick="offRadio(this, 4)" <?php sRadio('ingredient', 'water'); ?>>水</label>
        </div>
      </div>
      <?php include("component/search_option.php"); ?>
      <div class="form-execute"><input type="submit" class="btn query-btn" value="この条件で検索" onclick="return checkIng();"></div>     <!-- 検索ボタン -->
      <form class="others" action="" method="post">
        <div class="initialize"><input type="submit" class="btn init-btn" name="init" value="検索条件を初期化"></div>      <!-- 初期化ボタン -->
      </form>
    </div>
  </form>
  <?php
  if (!isset($_POST['ingredient'])) {
    $attr = 'hide';
  }else {
    $attr = 'result-wrapper';
    $ing = $_POST['ingredient'];
  }
  ?>
  <div id="result" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div id="ingredient-query"
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
               <?php ing($ing); ?>
               <?php addiCon(); ?>
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
    <p>Ⓒ新潟大学</p>
  </footer>
</body>
</html>
