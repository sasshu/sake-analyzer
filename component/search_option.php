<div class="filtering-search">      <!-- フィルタリング条件の入力 -->
  <h2>絞り込み条件</h2>
  <div class="slidecheck">
    <input id="compare" class="slidebutton" type="checkbox" name="compare" value="compare" onclick="dupFilter(this);sCheck(this);changeStyle(this)"><label for="compare"></label>
    <p>二通りの条件で検索</p>
  </div>
  <div id="parent-group">
    <div id="group0" class="hide">
      <h3>〈条件0〉</h3>
      <div class="filtering-contents">
        <div class="filtering-content">     <!-- 成分によるフィルタリング -->
          <div class="filtering-target">
            <p>成分</p>
            <label class="check"><input class="element main group0" type="checkbox" name="p-target0[]" value="sakeMeterValue0" onclick="Switch(this);sCheck(this)">日本酒度</label>
            <div id="sakeMeterValue0" class="hide">
              <div class="filter-detail">
                <p>範囲を設定してください</p>
                <div class="center">
                  <label class="check"><input class="group0" type="number" step="0.1" name="min_sakeMeterValue0" oninput="sNumber(this)">以上</label>
                  <label class="check"><input class="group0" type="number" step="0.1" name="max_sakeMeterValue0" oninput="sNumber(this)">以下</label>
                </div>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="p-target0[]" value="acidRate0" onclick="Switch(this);sCheck(this)">酸度</label>
            <div id="acidRate0" class="hide">
              <div class="filter-detail">
                <p>範囲を設定してください</p>
                <div class="center">
                  <label class="check"><input class="group0" type="number" step="0.1" name="min_acidRate0" min="0" oninput="sNumber(this)">以上</label>
                  <label class="check"><input class="group0" type="number" step="0.1" name="max_acidRate0" min="0" oninput="sNumber(this)">以下</label>
                </div>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="p-target0[]" value="aminoAcidRate0" onclick="Switch(this);sCheck(this)">アミノ酸度</label>
            <div id="aminoAcidRate0" class="hide">
              <div class="filter-detail">
                <p>範囲を設定してください</p>
                <div class="center">
                  <label class="check"><input class="group0" type="number" step="0.1" name="min_aminoAcidRate0" min="0" oninput="sNumber(this)">以上</label>
                  <label class="check"><input class="group0" type="number" step="0.1" name="max_aminoAcidRate0" min="0" oninput="sNumber(this)">以下</label>
                </div>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="p-target0[]" value="alcoholContent0" onclick="Switch(this);sCheck(this)">アルコール分</label>
            <div id="alcoholContent0" class="hide">
              <div class="filter-detail">
                <p>範囲を設定してください</p>
                <div class="center">
                  <label class="check"><input class="group0" type="number" step="0.1" name="min_alcoholContent0" min="0" max="22" oninput="sNumber(this)">度以上</label>
                  <label class="check"><input class="group0" type="number" step="0.1" name="max_alcoholContent0" min="0" max="22" oninput="sNumber(this)">度以下</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="filtering-content">     <!-- 原料によるフィルタリング -->
          <div class="filtering-target">
            <p>原料</p>
            <label class="check"><input class="element main group0" type="checkbox" name="i-target0[]" value="rice0" onclick="Switch(this);sCheck(this)">米</label>
            <div id="rice0" class="hide">
              <div class="filter-detail">
                <p>品種を選択してください</p>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="一本〆" onclick="sCheck(this)">一本〆</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="雄町" onclick="sCheck(this)">雄町</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="亀の尾" onclick="sCheck(this)">亀の尾</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="こしいぶき" onclick="sCheck(this)">こしいぶき</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="越神楽" onclick="sCheck(this)">越神楽</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="越淡麗" onclick="sCheck(this)">越淡麗</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="コシヒカリ" onclick="sCheck(this)">コシヒカリ</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="五百万石" onclick="sCheck(this)">五百万石</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="紫黒米" onclick="sCheck(this)">紫黒米</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="新之助" onclick="sCheck(this)">新之助</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="たかね錦" onclick="sCheck(this)">たかね錦</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="八反錦" onclick="sCheck(this)">八反錦</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="葉月みのり" onclick="sCheck(this)">葉月みのり</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="ひとごこち" onclick="sCheck(this)">ひとごこち</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="美山錦" onclick="sCheck(this)">美山錦</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="山田錦" onclick="sCheck(this)">山田錦</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="雪の精" onclick="sCheck(this)">雪の精</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="楽風舞" onclick="sCheck(this)">楽風舞</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="rice0[]" value="わせじまん" onclick="sCheck(this)">わせじまん</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="i-target0[]" value="yeast0" onclick="Switch(this);sCheck(this)">酵母</label>
            <div id="yeast0" class="hide">
              <div class="filter-detail">
                <p>品種を選択してください</p>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K601" onclick="sCheck(this)">K601</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K7" onclick="sCheck(this)">K7</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K701" onclick="sCheck(this)">K701</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K901" onclick="sCheck(this)">K901</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K10" onclick="sCheck(this)">K10</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K1401" onclick="sCheck(this)">K1401</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K1701" onclick="sCheck(this)">K1701</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="K1801" onclick="sCheck(this)">K1801</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="G74" onclick="sCheck(this)">G74</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="G74NF" onclick="sCheck(this)">G74NF</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="G8" onclick="sCheck(this)">G8</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="G9" onclick="sCheck(this)">G9</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="G9NF" onclick="sCheck(this)">G9NF</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="TR8" onclick="sCheck(this)">TR8</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="T812" onclick="sCheck(this)">T812</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="M310" onclick="sCheck(this)">M310</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="S3" onclick="sCheck(this)">S3</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="S9" onclick="sCheck(this)">S9</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="yeast0[]" value="広島吟醸酵母" onclick="sCheck(this)">広島吟醸酵母</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="i-target0[]" value="koji0" onclick="Switch(this);sCheck(this)">麹</label>
            <div id="koji0" class="hide">
              <div class="filter-detail">
                <p>ブランドを選択してください</p>
                <label class="check"><input class="element sub group0" type="checkbox" name="koji0[]" value="アキタコンノ" onclick="sCheck(this)">アキタコンノ</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="koji0[]" value="黒判もやし" onclick="sCheck(this)">黒判もやし</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="koji0[]" value="ヒグチモヤシ" onclick="sCheck(this)">ヒグチモヤシ</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="i-target0[]" value="water0" onclick="Switch(this);sCheck(this)">水</label>
            <div id="water0" class="hide">
              <div class="filter-detail">
                <p>硬度を選択してください</p>
                <label class="check"><input class="element sub group0" type="checkbox" name="water0[]" value="軟水" onclick="sCheck(this)">軟水</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="water0[]" value="硬水" onclick="sCheck(this)">硬水</label>
              </div>
            </div>
          </div>
        </div>
        <div class="filtering-content">     <!-- 製法によるフィルタリング -->
          <div class="filtering-target">
            <p>製法</p>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="ricePolishing0" onclick="Switch(this);sCheck(this)">精米法</label>
            <div id="ricePolishing0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="ricePolishing0[]" value="RoundRicePolishing" onclick="sCheck(this)">普通精米</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="ricePolishing0[]" value="SimilarRicePolishing" onclick="sCheck(this)">原型精米</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="ricePolishing0[]" value="FlatRicePolishing" onclick="sCheck(this)">扁平精米</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="ricePolishingRate0" onclick="Switch(this);sCheck(this)">精米歩合</label>
            <div id="ricePolishingRate0" class="hide">
              <div class="filter-detail">
                <p>範囲を設定してください</p>
                <div class="center">
                  <label class="check"><input class="group0" type="number" step="1" name="min_ricePolishingRate0" min="0" max="100" oninput="sNumber(this)">％以上</label>
                  <label class="check"><input class="group0" type="number" step="1" name="max_ricePolishingRate0" min="0" min="100" oninput="sNumber(this)">％以下</label>
                </div>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="kojiMaking0" onclick="Switch(this);sCheck(this)">製麹法</label>
            <div id="kojiMaking0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="kojiMaking0[]" value="TrayKoji" onclick="sCheck(this)">蓋麹</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="kojiMaking0[]" value="BoxKoji" onclick="sCheck(this)">箱麹</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="kojiMaking0[]" value="FloorKoji" onclick="sCheck(this)">床麹</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="kojiMaking0[]" value="MachineryKoji" onclick="sCheck(this)">機械製麹</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="fermentationStarter0" onclick="Switch(this);sCheck(this)">酒母造り</label>
            <div id="fermentationStarter0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationStarter0[]" value="Kimoto" onclick="sCheck(this)">生酛</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationStarter0[]" value="Yamahai" onclick="sCheck(this)">山廃酛</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationStarter0[]" value="Bodai" onclick="sCheck(this)">菩提酛（水酛）</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationStarter0[]" value="Sokujo" onclick="sCheck(this)">速醸酛</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="fermentationMash0" onclick="Switch(this);sCheck(this)">段仕込み</label>
            <div id="fermentationMash0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationMash0[]" value="1" onclick="sCheck(this)">一段仕込み</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationMash0[]" value="2" onclick="sCheck(this)">二段仕込み</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationMash0[]" value="3" onclick="sCheck(this)">三段仕込み</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="fermentationMash0[]" value="4" onclick="sCheck(this)">四段仕込み</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="pressing0" onclick="Switch(this);sCheck(this)">上槽法</label>
            <div id="pressing0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="pressing0[]" value="BagHanging" onclick="sCheck(this)">袋吊り</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="pressing0[]" value="FunePressing" onclick="sCheck(this)">槽搾り</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="pressing0[]" value="FilterPressing" onclick="sCheck(this)">圧搾搾り</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="pressingOrder0" onclick="Switch(this);sCheck(this)">搾り取る順番</label>
            <div id="pressingOrder0" class="hide">
              <div class="filter-detail">
                <label class="check"><input type="checkbox" name="pressingOrder0[]" value="FirstRun" onclick="sCheck(this)">荒走り</label>
                <label class="check"><input type="checkbox" name="pressingOrder0[]" value="MiddleRunSake" onclick="sCheck(this)">中汲み</label>
                <label class="check"><input type="checkbox" name="pressingOrder0[]" value="FinalRunSake" onclick="sCheck(this)">責め</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="pasteurization0" onclick="Switch(this);sCheck(this)">火入れ</label>
            <div id="pasteurization0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="pasteurization0[]" value="Namazake" onclick="sCheck(this)">生酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="pasteurization0[]" value="LiveBottledSake" onclick="sCheck(this)">生詰酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="pasteurization0[]" value="LiveStorageSake" onclick="sCheck(this)">生貯蔵酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="pasteurization0[]" value="Hiyaoroshi" onclick="sCheck(this)">ひやおろし</label>
                <!-- <label><input class="element sub group0" type="checkbox" name="pasteurization[]" value="BottlePasteurization" onclick="sCheck(this)">瓶火入れ</label> -->
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="storage0" onclick="Switch(this);sCheck(this)">貯蔵容器</label>
            <div id="storage0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="storage0[]" value="TankStorage" onclick="sCheck(this)">タンク貯蔵</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="storage0[]" value="BottleStorage" onclick="sCheck(this)">樽貯蔵</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="storage0[]" value="CaskStorage" onclick="sCheck(this)">瓶貯蔵</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="aging0" onclick="Switch(this);sCheck(this)">熟成の程度</label>
            <div id="aging0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="aging0[]" value="FreshSake" onclick="sCheck(this)">しぼりたて</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="aging0[]" value="OldSake" onclick="sCheck(this)">古酒（3年以上熟成）</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="premiumSake0" onclick="Switch(this);sCheck(this)">特定名称</label>
            <div id="premiumSake0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="StandardSake" onclick="sCheck(this)">普通酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="Junmai" onclick="sCheck(this)">純米酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="SpecialJunmai" onclick="sCheck(this)">特別純米酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="Honjozo" onclick="sCheck(this)">本醸造酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="SpecialHonjozo" onclick="sCheck(this)">特別本醸造酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="Ginjo" onclick="sCheck(this)">吟醸酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="Daiginjo" onclick="sCheck(this)">大吟醸酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="JunmaiGinjo" onclick="sCheck(this)">純米吟醸酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="premiumSake0[]" value="JunmaiDaiginjo" onclick="sCheck(this)">純米大吟醸酒</label>
              </div>
            </div>
            <label class="check"><input class="element main group0" type="checkbox" name="m-target0[]" value="other0" onclick="Switch(this);sCheck(this)" onclick="sCheck(this)">その他</label>
            <div id="other0" class="hide">
              <div class="filter-detail">
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="UnfilteredSake" onclick="sCheck(this)">無濾過酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="UndilutedSake" onclick="sCheck(this)">原酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="CloudySake" onclick="sCheck(this)">にごり酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="Orizake" onclick="sCheck(this)">おり酒</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="FirstlyMadeSake" onclick="sCheck(this)">初しぼり</label>
                <label class="check"><input class="element sub group0" type="checkbox" name="other0[]" value="SparklingSake" onclick="sCheck(this)">発泡清酒</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
