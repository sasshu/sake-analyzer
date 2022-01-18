<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <?php require_once('component/function.php'); ?>
  <title>ホーム | Sake Analyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">     <!-- fontawesomeの読み込み -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.php"); ?>
  </header>
  <div class="top-wrapper">     <!-- アプリ内容の説明 -->
    <div class="specification">
      <div class="emphasis-box">
        <span class="box-title">Sake Analyzerとは？</span>
        <p>日本酒の統計的なデータを様々な角度から閲覧できるWebアプリケーションです。日本酒を特徴づける要素について、お好みの条件に合致したデータを可視化します。</p>
      </div>
      <!--
      <p>日本酒の統計データを様々な角度から閲覧できます。</p>
      -->
    </div>
  </div>
  <div class="image-wrapper">     <!-- 可視化グラフのサンプル -->
    <div class="specification">
      <h2>三つの視点</h2>
      <div class="point">
        <h3>成分</h3>
        <i class="fas fa-user"></i>
        <div class="balloon-left">
          <p>日本酒の甘口・辛口の指標となる日本酒度と酸度は、実際どんな分布をとるのだろう？</p>
        </div>
        <div class="commentary">
          <div class="sample-result">
            <div class="center">
              <i class="fas fa-long-arrow-alt-down"></i>
            </div>
            <a href="image/sample_property.png" data-lightbox="group" data-title="日本酒度と酸度の関係"><img class="loupe" src="image/sample_property.png" alt="日本酒度と酸度" width="100%"></a>
            <p>日本酒度と酸度の関係</p>
          </div>
          <p class="sample-intro">日本酒の成分として、日本酒度、酸度、アミノ酸度、アルコール分といった数値データを検索することができます。それらのうち二項目を散布図として、数値の分布が可視化されます。</p>
        </div>
        <p></p>
      </div>
      <div class="point">
        <h3>原料</h3>
        <i class="fas fa-user"></i>
        <div class="balloon-left">
          <p>お米本来の味で勝負したいが、他社はどんなお米を日本酒に使っているのだろう？</p>
        </div>
        <div class="commentary">
          <div class="sample-result">
            <div class="center">
              <i class="fas fa-long-arrow-alt-down"></i>
            </div>
            <a href="image/sample_ingredient.png" data-lightbox="group" data-title="精米歩合が60%以上で使用される米品種"><img class="loupe" src="image/sample_ingredient.png" alt="精米歩合が60%以上で使用される米品種" width="100%"></a>
            <p>精米歩合が60%以上で使用される米品種</p>
          </div>
          <p class="sample-intro">日本酒の原料として、米・酵母の品種、麹のブランド、水の硬度（軟水・硬水）を検索することができます。円グラフによって、それぞれ日本酒に使用される割合が可視化されます。</p>
        </div>
      </div>
      <div class="point">
        <h3>製法</h3>
        <i class="fas fa-user"></i>
        <div class="balloon-left">
          <p>五百万石で日本酒を造りたいが、他社はどのくらい磨いて使うのだろう？</p>
        </div>
        <div class="commentary">
          <div class="sample-result">
            <div class="center">
              <i class="fas fa-long-arrow-alt-down"></i>
            </div>
            <a href="image/sample_manufacture.png" data-lightbox="group" data-title="五百万石の精米歩合"><img class="loupe" src="image/sample_manufacture.png" alt="五百万石の精米歩合" width="100%"></a>
            <p>五百万石の精米歩合</p>
          </div>
          <p class="sample-intro">日本酒の製法として、特定名称や製麹、酒母造りなどの種類に加え、精米歩合といった数値データを検索することができます。それぞれ円グラフまたは棒グラフによって、合致した製法で造られる日本酒の数や割合が可視化されます。</p>
        </div>
      </div>
    </div>
  </div>
  <div class="btn-wrapper">     <!-- ページ遷移ボタン -->
    <div class="container">
      <div class="popup_wrap">
        <input id="search_trig" type="checkbox"><label for="search_trig" class="btn scopen">データを閲覧する</label>      <!-- 検索ページへ -->
        <div class="popup_overlay">
          <label for="search_trig" class="pop_trig"></label>
          <div class="pop_content">
            <label for="search_trig" class="close">×</label>
            <div class="search-intro">
              <div class="search-index">
                <img src="image/property_index.png" alt="成分">
                <a href="search-property" class="btn scpop-btn">成分を検索</a>
              </div>
              <div class="search-index">
                <img src="image/ingredient_index.png" alt="原料">
                <a href="search-ingredient" class="btn scpop-btn">原料を検索</a>
              </div>
              <div class="search-index">
                <img src="image/manufacture_index.png" alt="製法">
                <a href="search-manufacture" class="btn scpop-btn">製法を検索</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="credit">
        <a href="credit-brewery" class="btn provider-btn">データを載せている酒蔵を見る</a>      <!-- 酒蔵のクレジットページへ -->
      </div>
    </div>
  </div>
  <div id="page_top">
    <a href="#"></a>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.php"); ?>
  </footer>
</body>
</html>
