<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <?php require_once('component/function.php'); ?>
  <title>ホーム | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
  <link rel="icon" href="image/favicon.ico">
</head>
<body>
  <header>      <!-- ヘッダーの読み込み -->
    <?php include("component/header.html"); ?>
  </header>
  <div class="top-wrapper">     <!-- アプリ内容の説明 -->
    <div class="container">
      <p>日本酒の統計データを様々な角度から閲覧できます。</p>
    </div>
  </div>
  <div class="image-wrapper">     <!-- 可視化グラフのサンプル -->
    <div class="container">
      <div class="contents">
        <div class="content">
          <img id="chart1" class="sample-chart" src="image/visualization_1.png" alt="各原料米で造られた日本酒の割合">
          <p>各原料米で造られた日本酒の割合</p>
        </div>
        <div class="content">
          <img class="sample-chart" src="image/visualization_2.png" alt="五百万石を使用する日本酒の日本酒度・酸度">
          <p>五百万石を使用する日本酒の日本酒度・酸度</p>
        </div>
      </div>
    </div>
  </div>
  <div class="btn-wrapper">     <!-- ページ遷移ボタン -->
    <div class="container">
      <div class="popup_wrap">
        <input id="search_trig" type="checkbox"><label for="search_trig" class="btn scopen">データを閲覧する</label>      <!-- 検索ページへ -->
        <div class="popup_overlay">
          <div class="scpop_content">
            <label for="search_trig" class="scclose">×</label>
            <p>成分・原料・製法それぞれを検索できます。</p>
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
      <div>
        <a href="credit-brewery" class="btn provider-btn">データを載せている酒蔵を見る</a>     <!-- 酒蔵のクレジットページへ -->
      </div>
    </div>
  </div>
  <footer>      <!-- フッター -->
    <?php include("component/footer.html"); ?>
  </footer>
</body>
</html>
