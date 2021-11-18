<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ホーム | SakeAnalyzer</title>     <!-- ページタイトル -->
  <link rel="stylesheet" href="component/sake_app.css">     <!-- cssの読み込み -->
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
      <a href="search" class="btn search-btn">データを閲覧する</a>      <!-- 検索ページへ -->
      <a href="brewery" class="btn provider-btn">データを載せている酒蔵を見る</a>     <!-- 酒蔵のクレジットページへ -->
    </div>
  </div>
  <footer>      <!-- フッター -->
    <p>Ⓒ新潟大学</p>
  </footer>
</body>
</html>
