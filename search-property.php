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
  <title>成分を検索 | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result-graphs" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">成分を検索</h1>
      <p class="sec-intro">日本酒の成分を、散布図で可視化します。<br>二種の成分間の関係を調べることができます。</p>
      <div class="popup_wrap">
        <input id="manual_trig" type="checkbox"><label for="manual_trig"><u>検索方法</u></label>
        <div class="popup_overlay">
          <label for="manual_trig" class="pop_trig"></label>
          <div class="pop_content">
            <label for="manual_trig" class="close">×</label>
            <div class="manual">
              <img src="image/manual_property.png" alt="成分検索マニュアル">
            </div>
          </div>
        </div>
      </div>
      <div id="page_top">
        <a href="#"></a>
      </div>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（成分）</h2>
        <div class="property-search">     <!-- 検索対象 = 成分 -->
          <div class="x-axis">      <!-- x軸 -->
            <p>x軸（横方向）</p>
            <label class="check"><input class="element master" type="radio" name="x-target" value="sakeMeterValue" onclick="sRadio(this)">日本酒度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="acidRate" onclick="sRadio(this)">酸度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="aminoAcidRate" onclick="sRadio(this)">アミノ酸度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="alcoholContent" onclick="sRadio(this)">アルコール分</label>
          </div>
          <div class="y-axis">
            <p>y軸（縦方向）</p>      <!-- y軸 -->
            <label class="check"><input class="element master" type="radio" name="y-target" value="sakeMeterValue" onclick="sRadio(this)">日本酒度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="acidRate" onclick="sRadio(this)">酸度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="aminoAcidRate" onclick="sRadio(this)">アミノ酸度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="alcoholContent" onclick="sRadio(this)">アルコール分</label>
          </div>
        </div>
      </div>
      <?php include("component/search_option.php"); ?>
      <div class="form-execute"><input type="submit" class="btn query-btn" value="この条件で検索" onclick="return checkProp();"></div>     <!-- 検索ボタン -->
      <div class="initialize"><input type="button" class="btn init-btn" name="init" value="検索条件を初期化" onclick="confInit()"></div>      <!-- 初期化ボタン -->
    </div>
  </form>
  <?php
  if (!isset($_POST['x-target']) || !isset($_POST['y-target'])) {
    $attr = 'hide';
  }elseif (isset($_POST['x-target']) && isset($_POST['y-target'])) {
    $attr = 'result-wrapper';
    $xt = $_POST['x-target'];
    $yt = $_POST['y-target'];
  }
  ?>
  <div id="result-graphs" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div id="result-contents">
        <div id="result1" class="result-content">
          <div class="data-count">
            <div id="count-query1" class="query"
            data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s where
              {
                ?s a sk-eval:Sake .

                ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
                   sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
                bind(((?min_x+ ?max_x) / 2) as ?x_value)

                ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
                   sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
                bind(((?min_y + ?max_y) / 2) as ?y_value)

                <?php addpCon(1); ?>
              }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text"
            data-sgvizler-chart-options="">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="property-query1" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select distinct ?label ?x_value ?y_value (count(?s) as ?count) where
          {
            select distinct ?s ?label ?x_value ?y_value where
            {
              ?s a sk-eval:Sake .

              ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
                 sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
              bind(((?min_x+ ?max_x) / 2) as ?x_value)

              ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
                 sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
              bind(((?min_y + ?max_y) / 2) as ?y_value)

              <?php addpCon(1); ?>
            }
          }
          "
          data-sgvizler-chart="google.visualization.BubbleChart"
          data-sgvizler-chart-options="titleTextStyle.fontSize=20|title=〈結果1〉|chartArea.left=10%|chartArea.right=10%|explorer.keepInBounds=true|explorer.maxZoomIn=0.1|hAxis.title=<?php trans($xt); ?>|vAxis.title=<?php trans($yt); ?>|hAxis.minValue=<?php minSize($xt); ?>|hAxis.maxValue=<?php maxSize($xt); ?>|vAxis.minValue=<?php minSize($yt); ?>|vAxis.maxValue=<?php maxSize($yt); ?>|sizeAxis.maxSize=5|colorAxis.colors=red|chartArea.backgroundColor=black"
          style="width:<?php graphStyle(); ?>; height:600px;">
          </div>
        </div>
        <div id="result2" class="result-content">
          <div class="data-count">
            <div id="count-query2" class="query"
            data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s ?label ?x_value ?y_value where
              {
                ?s a sk-eval:Sake .

                ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
                   sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
                bind(((?min_x+ ?max_x) / 2) as ?x_value)

                ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
                   sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
                bind(((?min_y + ?max_y) / 2) as ?y_value)

                <?php addpCon(2); ?>
              }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text"
            data-sgvizler-chart-options="">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="property-query2" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select ?label ?x_value ?y_value (count(?s) as ?count) where
          {
            select distinct ?s ?label ?x_value ?y_value where
            {
              ?s a sk-eval:Sake .

              ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
                 sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
              bind(((?min_x+ ?max_x) / 2) as ?x_value)

              ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
                 sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
              bind(((?min_y + ?max_y) / 2) as ?y_value)

              <?php addpCon(2); ?>
            }
          }
          "
          data-sgvizler-chart="google.visualization.BubbleChart"
          data-sgvizler-chart-options="titleTextStyle.fontSize=20|title=〈結果2〉|chartArea.left=10%|chartArea.right=10%|explorer.keepInBounds=true|explorer.maxZoomIn=0.1|hAxis.title=<?php trans($xt); ?>|vAxis.title=<?php trans($yt); ?>|hAxis.minValue=<?php minSize($xt); ?>|hAxis.maxValue=<?php maxSize($xt); ?>|vAxis.minValue=<?php minSize($yt); ?>|vAxis.maxValue=<?php maxSize($yt); ?>|sizeAxis.maxSize=5|colorAxis.colors=red|chartArea.backgroundColor=black"
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
