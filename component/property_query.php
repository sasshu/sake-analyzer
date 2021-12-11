<div id="result0" class="result-contents">     <!-- 可視化グラフの生成 -->
  <div class="data-count">
    <div id="count-query0" class="query"
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

      <?php addpCon(0); ?>
    }
    "
    data-sgvizler-chart="sgvizler.visualization.Text"
    data-sgvizler-chart-options="">
    </div>
    <p>件ヒットしました。</p>
  </div>
  <div id="property-query0" class="query"
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

    <?php addpCon(0); ?>
  }
  "
  data-sgvizler-chart="google.visualization.BubbleChart"
  data-sgvizler-chart-options="explorer.keepInBounds=true|explorer.maxZoomIn=0.1|hAxis.title=<?php trans($xt); ?>|vAxis.title=<?php trans($yt); ?>|hAxis.minValue=<?php minSize($xt); ?>|hAxis.maxValue=<?php maxSize($xt); ?>|vAxis.minValue=<?php minSize($yt); ?>|vAxis.maxValue=<?php maxSize($yt); ?>|sizeAxis.maxSize=5|colorAxis.colors=red"
  style="width:100%; height:500px;">
  </div>
</div>
