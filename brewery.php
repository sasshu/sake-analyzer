<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="https://mgskjaeveland.github.io/sgvizler/v/0.6/sgvizler.js"></script>
  <script type="text/javascript">
    $(document).ready(() => {sgvizler.containerDrawAll();});
    google.charts.load("current", {
      "packages":["map"],
      "mapsApiKey": "AIzaSyBPuJA_VtJj8SMEjZ7o_3-Wyh1CW6Mq2L8"
    })
  </script>
  <title>データ提供元 | SakeAnalyzer</title>
  <link rel="stylesheet" href="component/sake_app.css">
</head>
<body>
  <header>
    <?php include("component/header.html"); ?>
  </header>
  <div class="brewery">
    <div class="container">
      <h1 class="section-title">データ提供元</h1>
      <div class="brewery-query">
        <div id="brewery-map"
        data-sgvizler-endpoint="http://echigodb.jp:8893/sparql/"
        data-sgvizler-query="
        PREFIX schema: <http://schema.org/>
        PREFIX sk-eval: <http://www.sakevoc.jp/eval/>
        with <http://sake_data>

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
        style="width:750px; height:550px;">
        </div>
        <div id="brewry-list"
          data-sgvizler-endpoint="http://echigodb.jp:8893/sparql/"
          data-sgvizler-query="
          PREFIX schema: <http://schema.org/>
          PREFIX sk-eval: <http://www.sakevoc.jp/eval/>
          with <http://sake_data>

          select distinct ?maker where
          {
            ?s a sk-eval:Sake ;
               schema:manufacturer / schema:name ?maker .
          }"
          data-sgvizler-chart="google.visualization.Table"
          style="width:200px; height:550px;">
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>Ⓒ新潟大学</p>
  </footer>
</body>
</html>
