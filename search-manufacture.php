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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>      <!-- jQueryの読み込み -->
  <script src="https://www.gstatic.com/charts/loader.js"></script>     <!-- Google Chartsの読み込み -->
  <script src="sgvizler.js"></script>     <!-- Sgvizlerの読み込み -->
  <script>
    $(document).ready(() => {sgvizler.containerDrawAll();});     /* Sgvizlerコンテナの呼び出し */
  </script>
  <?php require_once('component/function.php'); ?>
  <title>製法を検索 | Sake Analyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.php"); ?>
  </header>
  <form id="search_form" class="search-wrapper" action="#result-graphs" method="post">     <!-- 検索フォーム -->
    <div class="container">
      <h1 class="section-title">製法を検索
        <a href="image/manual_manufacture.png" data-lightbox="group"><i class="far fa-question-circle" title="検索方法"></i></a>
      </h1>
      <p class="sec-intro">日本酒製造に用いられる製法の詳細を、円グラフまたは棒グラフで可視化します。<br>指定した製法で造られた日本酒の数や割合を調べることができます。</p>
      <div id="page_top">
        <a href="#"></a>
      </div>
      <div class="basic-search">      <!-- メインの検索対象の入力 -->
        <h2>基本条件（製法）</h2>
        <div class="manufacture-search">     <!-- 検索対象 = 製法 -->
          <label class="check"><input class="element master" type="radio" name="manufacture" value="ricePolishing" onclick="sRadio(this)">精米法</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="ricePolishingRate" onclick="sRadio(this)">精米歩合</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="kojiMaking" onclick="sRadio(this)">製麹法</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="fermentationStarter" onclick="sRadio(this)">酒母造り</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="fermentationMash" onclick="sRadio(this)">段仕込み段数</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="pressing" onclick="sRadio(this)">上槽法</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="pressingOrder" onclick="sRadio(this)">搾り取る順番</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="pasteurization" onclick="sRadio(this)">火入れ</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="storage" onclick="sRadio(this)">貯蔵容器</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="aging" onclick="sRadio(this)">熟成の程度</label>
          <label class="check"><input class="element master" type="radio" name="manufacture" value="premiumSake" onclick="sRadio(this)">特定名称</label>
          <!--
          <label><input class="element master" type="radio" name="manufacture" value="unfilteredSake" onclick="sRadio(this)">無濾過酒</label>
          <label><input class="element master" type="radio" name="manufacture" value="undilutedSake" onclick=""sRadio(this)">原酒</label>
          <label><input class="element master" type="radio" name="manufacture" value="cloudySake" onclick="sRadio(this)">にごり酒</label>
          <label><input class="element master" type="radio" name="manufacture" value="orizake" onclick="sRadio(this)">おり酒</label>
          <label><input class="element master" type="radio" name="manufacture" value="firstlyMadeSake" onclick="sRadio(this)">初しぼり</label>
          <label><input class="element master" type="radio" name="manufacture" value="sparklingSake" onclick="sRadio(this)">発泡清酒</label>
          -->
          <label class="check"><input class="element master" type="radio" name="manufacture" value="other" onclick="sRadio(this)">その他</label>
        </div>
      </div>
      <?php include("component/search_option.php"); ?>
      <div class="form-execute"><input type="submit" class="btn query-btn" value="この条件で検索" onclick="return checkMan();"></div>     <!-- 検索ボタン -->
      <div class="initialize"><input type="button" class="btn init-btn" name="init" value="検索条件を初期化" onclick="confInit()"></div>      <!-- 初期化ボタン -->
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
  <div id="result-graphs" class="<?php echo $attr; ?>">     <!-- 可視化グラフの生成 -->
    <div class="container">
      <h1 class="section-title">検索結果</h1>
      <div id="result-contents">
        <div id="result1" class="result-coutent">
          <div class="data-count">
            <div id="count-query1" class="query"
            data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s ?man where
              {
                ?s a sk-eval:Sake .
                <?php man($man); ?>
                <?php addmCon(1); ?>
              }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="manufacture-query1" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select ?man (count(?s) as ?count) where
          {
            select distinct ?s ?man where
            {
              ?s a sk-eval:Sake .
              <?php man($man); ?>
              <?php addmCon(1); ?>
            }
          }
          <?php dataSort($man); ?>
          "
          data-sgvizler-chart="<?php echo selectChart($man); ?>"
          data-sgvizler-chart-options="<?php columnSetting($man); ?>|titleTextStyle.fontSize=20|title=〈結果1〉|<?php chartArea(selectChart($man)); ?>|hAxis.title=<?php trans($man); ?>|vAxis.title=<?php trans('count'); ?>|hAxis.minValue=<?php minSize($man); ?>|hAxis.maxValue=<?php maxSize($man); ?>|vAxis.maxValue=<?php matchSize($man); ?>"
          style="width:<?php graphStyle(); ?>; height:600px;">
          </div>
        </div>
        <div id="result2" class="result-coutent">
          <div class="data-count">
            <div id="count-query2" class="query"
            data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
            data-sgvizler-query="
            <?php preQuery(); ?>

            select (count(?s) as ?count) where
            {
              select distinct ?s ?man where
              {
                ?s a sk-eval:Sake .
                <?php man($man); ?>
                <?php addmCon(2); ?>
              }
            }
            "
            data-sgvizler-chart="sgvizler.visualization.Text"
            data-sgvizler-chart-options="">
            </div>
            <p>件ヒットしました。</p>
          </div>
          <div id="manufacture-query2" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select ?man (count(?s) as ?count) where
          {
            select distinct ?s ?man where
            {
              ?s a sk-eval:Sake .
              <?php man($man); ?>
              <?php addmCon(2); ?>
            }
          }
          <?php dataSort($man); ?>
          "
          data-sgvizler-chart="<?php echo selectChart($man); ?>"
          data-sgvizler-chart-options="<?php columnSetting($man); ?>|titleTextStyle.fontSize=20|title=〈結果2〉|<?php chartArea(selectChart($man)); ?>|hAxis.title=<?php trans($man); ?>|vAxis.title=<?php trans('count'); ?>|hAxis.minValue=<?php minSize($man); ?>|hAxis.maxValue=<?php maxSize($man); ?>|vAxis.maxValue=<?php matchSize($man); ?>"
          style="width:<?php graphStyle(); ?>; height:600px;">
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.php"); ?>
  </footer>
</body>
</html>
