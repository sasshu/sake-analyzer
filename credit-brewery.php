<?php
require_once('component/user_manage.php');
@session_start();
$_SESSION['url'] = getUrl();
require_logined_session();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>      <!-- jQueryの読み込み -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>     <!-- Google Chartsの読み込み -->
  <script type="text/javascript" src="sgvizler.js"></script>     <!-- Sgvizlerの読み込み -->
  <script type="text/javascript">
    $(document).ready(() => {sgvizler.containerDrawAll();});
    google.charts.load("current", {
      "packages":["map"],
      "mapsApiKey": "AIzaSyBPuJA_VtJj8SMEjZ7o_3-Wyh1CW6Mq2L8"
    })
  </script>
  <?php require_once('component/function.php'); ?>
  <title>データ提供元 | Sake Analyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>
    <?php include("component/header.php"); ?>
  </header>
  <div class="brewery">
    <div class="container">
      <h1 class="section-title">データ提供元</h1>
      <div class="data-count brewery-count">
        <p>現在、</p>
        <div id="count-query" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select  (count(?maker) as ?brewery) where
          {
            select distinct ?maker where
            {
              ?s a sk-eval:Sake;
                 schema:manufacturer / schema:name ?maker .
            }
          }
          "
          data-sgvizler-chart="sgvizler.visualization.Text">
        </div>
        <p>の酒蔵が公開した日本酒データが集まっています。</p>
      </div>
      <div class="brewery-query">
        <div id="brewery-map" class="query"
        data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
        data-sgvizler-query="
        <?php preQuery(); ?>

        select distinct ?lat ?lon ?maker ?address ?url where
        {
          ?s a sk-eval:Sake ;
             schema:manufacturer ?x .
          ?x schema:name ?maker ;
             schema:location / schema:latitude ?lat ;
             schema:location / schema:longitude ?lon ;
             schema:location / schema:address / schema:addressRegion ?a1 ;
             schema:location / schema:address / schema:addressLocality ?a2 ;
             schema:location / schema:address / schema:streetAddress ?a3 .
          optional{?x schema:url ?url .}
          bind(concat(?a1, ?a2, ?a3) as ?address)
        }"
        data-sgvizler-chart="sgvizler.visualization.Map"
        data-sgvizler-chart-options="useMapTypeControl=true|showInfoWindow=true|showTooltip=true"
        style="width:75%; height:600px;">
        </div>
        <div id="brewry-list" class="query"
          data-sgvizler-endpoint="<?php echo getEndpoint(); ?>"
          data-sgvizler-query="
          <?php preQuery(); ?>

          select distinct ?maker where
          {
            ?s a sk-eval:Sake ;
               schema:manufacturer / schema:name ?maker .
          }"
          data-sgvizler-chart="google.visualization.Table"
          style="width:20%; height:600px;">
        </div>
      </div>
    </div>
  </div>
  <footer>
    <?php include("component/footer.php"); ?>
  </footer>
</body>
</html>
