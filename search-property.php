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
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result-graphs" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">成分を検索</h1>
      <p class="sec-intro">日本酒の成分を、散布図で可視化します。</p>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（成分）</h2>
        <div class="property-search">     <!-- 検索対象 = 成分 -->
          <div class="x-axis">      <!-- x軸 -->
            <p>x軸（横方向）</p>
            <label class="check"><input class="element master" type="radio" name="x-target" value="sakeMeterValue" onclick="sRadio(this)">日本酒度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="acidRate" onclick="sRadio(this)">酸度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="aminoAcidRate" onclick="sRadio(this)">アミノ酸度</label>
            <label class="check"><input class="element master" type="radio" name="x-target" value="alcoholContent" onclick="sRadio(this)">アルコール度</label>
          </div>
          <div class="y-axis">
            <p>y軸（縦方向）</p>      <!-- y軸 -->
            <label class="check"><input class="element master" type="radio" name="y-target" value="sakeMeterValue" onclick="sRadio(this)">日本酒度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="acidRate" onclick="sRadio(this)">酸度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="aminoAcidRate" onclick="sRadio(this)">アミノ酸度</label>
            <label class="check"><input class="element master" type="radio" name="y-target" value="alcoholContent" onclick="sRadio(this)">アルコール度</label>
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
      <div id="result1" class="result-contents">
        <div class="data-count">
          <div id="count-query1" class="query"
          data-sgvizler-endpoint="<?php getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select (count(?s) as ?count) where
          {
            ?s a sk-eval:Sake .
            bind('' as ?label)

            ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
               sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
            bind(((?min_x+ ?max_x) / 2) as ?x_value)

            ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
               sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
            bind(((?min_y + ?max_y) / 2) as ?y_value)

            <?php addpCon(1); ?>
          }
          "
          data-sgvizler-chart="sgvizler.visualization.Text"
          data-sgvizler-chart-options="">
          </div>
          <p>件ヒットしました。</p>
        </div>
        <div id="property-query1" class="query"
        data-sgvizler-endpoint="<?php getEndpoint(); ?>"
        data-sgvizler-query="
        <?php preQuery(); ?>

        select ?label ?x_value ?y_value (count(?s) as ?count) where
        {
          ?s a sk-eval:Sake .
          bind('' as ?label)

          ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
             sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
          bind(((?min_x+ ?max_x) / 2) as ?x_value)

          ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
             sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
          bind(((?min_y + ?max_y) / 2) as ?y_value)

          <?php addpCon(1); ?>
        }
        "
        data-sgvizler-chart="google.visualization.BubbleChart"
        data-sgvizler-chart-options="explorer.keepInBounds=true|explorer.maxZoomIn=0.1|hAxis.title=<?php trans($xt); ?>|vAxis.title=<?php trans($yt); ?>|hAxis.minValue=<?php minSize($xt); ?>|hAxis.maxValue=<?php maxSize($xt); ?>|vAxis.minValue=<?php minSize($yt); ?>|vAxis.maxValue=<?php maxSize($yt); ?>|sizeAxis.maxSize=5|colorAxis.colors=red"
        style="width:100%; height:500px;">
        </div>
      </div>
      <div id="result2" class="result-contents">
        <div class="data-count">
          <div id="count-query2" class="query"
          data-sgvizler-endpoint="<?php getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select (count(?s) as ?count) where
          {
            ?s a sk-eval:Sake .
            bind('' as ?label)

            ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
               sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
            bind(((?min_x+ ?max_x) / 2) as ?x_value)

            ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
               sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
            bind(((?min_y + ?max_y) / 2) as ?y_value)

            <?php addpCon(2); ?>
          }
          "
          data-sgvizler-chart="sgvizler.visualization.Text"
          data-sgvizler-chart-options="">
          </div>
          <p>件ヒットしました。</p>
        </div>
        <div id="property-query2" class="query"
        data-sgvizler-endpoint="<?php getEndpoint(); ?>"
        data-sgvizler-query="
        <?php preQuery(); ?>

        select ?label ?x_value ?y_value (count(?s) as ?count) where
        {
          ?s a sk-eval:Sake .
          bind('' as ?label)

          ?s sk-eval:<?php echo $xt; ?> / schema:minValue ?min_x ;
             sk-eval:<?php echo $xt; ?> / schema:maxValue ?max_x .
          bind(((?min_x+ ?max_x) / 2) as ?x_value)

          ?s sk-eval:<?php echo $yt; ?> / schema:minValue ?min_y ;
             sk-eval:<?php echo $yt; ?> / schema:maxValue ?max_y .
          bind(((?min_y + ?max_y) / 2) as ?y_value)

          <?php addpCon(2); ?>
        }
        "
        data-sgvizler-chart="google.visualization.BubbleChart"
        data-sgvizler-chart-options="explorer.keepInBounds=true|explorer.maxZoomIn=0.1|hAxis.title=<?php trans($xt); ?>|vAxis.title=<?php trans($yt); ?>|hAxis.minValue=<?php minSize($xt); ?>|hAxis.maxValue=<?php maxSize($xt); ?>|vAxis.minValue=<?php minSize($yt); ?>|vAxis.maxValue=<?php maxSize($yt); ?>|sizeAxis.maxSize=5|colorAxis.colors=red"
        style="width:100%; height:500px;">
        </div>
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
