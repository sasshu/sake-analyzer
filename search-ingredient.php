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
  <title>原料を検索 | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result-graphs" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">原料を検索</h1>
      <p class="sec-intro">日本酒製造に用いられる原料の詳細を、円グラフで可視化します。</p>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（原料）</h2>
        <div class="ingredient-search">     <!-- 検索対象 = 原料 -->
          <label class="check"><input class="element master" type="radio" name="ingredient" value="rice" onclick="sRadio(this)">米</label>
          <label class="check"><input class="element master" type="radio" name="ingredient" value="yeast" onclick="sRadio(this)">酵母</label>
          <label class="check"><input class="element master" type="radio" name="ingredient" value="koji" onclick="sRadio(this)">麹</label>
          <label class="check"><input class="element master" type="radio" name="ingredient" value="water" onclick="sRadio(this)">水</label>
        </div>
      </div>
      <?php include("component/search_option.php"); ?>
      <div class="form-execute"><input type="submit" class="btn query-btn" value="この条件で検索" onclick="return checkIng();"></div>     <!-- 検索ボタン -->
      <div class="initialize"><input type="button" class="btn init-btn" name="init" value="検索条件を初期化" onclick="confInit()"></div>      <!-- 初期化ボタン -->
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

  <div id="result-graphs" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div id="result-contents">
        <div id="result1" class="result-coutent">
          <div class="data-count">
            <div id="count-query1" class="query"
            data-sgvizler-endpoint="<?php getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s ?ing where
                {
                  ?s a sk-eval:Sake ;
                     schema:material ?ingredient .
                     <?php ing($ing); ?>
                     <?php addiCon(1); ?>
                }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text"
            data-sgvizler-chart-options="">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="ingredient-query1" class="query"
          data-sgvizler-endpoint="<?php getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select ?ing (count(?s) as ?count) where
          {
            select distinct ?s ?ing where
              {
                ?s a sk-eval:Sake ;
                   schema:material ?ingredient .
                   <?php ing($ing); ?>
                   <?php addiCon(1); ?>
              }
          }
          order by desc(?count)
          "
          data-sgvizler-chart="google.visualization.PieChart"
          data-sgvizler-chart-options="chartArea.left=20%|chartArea.right=10%"
          style="width:<?php graphStyle(); ?>; height:600px;">
          </div>
        </div>
        <div id="result2" class="result-coutent">
          <div class="data-count">
            <div id="count-query2" class="query"
            data-sgvizler-endpoint="<?php getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s ?ing where
                {
                  ?s a sk-eval:Sake ;
                     schema:material ?ingredient .
                     <?php ing($ing); ?>
                     <?php addiCon(2); ?>
                }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text"
            data-sgvizler-chart-options="">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="ingredient-query2" class="query"
          data-sgvizler-endpoint="<?php getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select ?ing (count(?s) as ?count) where
          {
            select distinct ?s ?ing where
              {
                ?s a sk-eval:Sake ;
                   schema:material ?ingredient .
                   <?php ing($ing); ?>
                   <?php addiCon(2); ?>
              }
          }
          order by desc(?count)
          "
          data-sgvizler-chart="google.visualization.PieChart"
          data-sgvizler-chart-options="chartArea.left=20%|chartArea.right=10%"
          style="width:<?php graphStyle(); ?>; height:600px;">
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
