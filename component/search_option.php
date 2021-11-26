<div class="filtering-search">      <!-- フィルタリング条件の入力 -->
  <h2>絞り込み条件</h2>
  <div class="filtering-contents">
    <div class="filtering-content">     <!-- 成分によるフィルタリング -->
      <div class="filtering-target">
        <p>成分</p>
        <label><input class="element main" type="checkbox" name="p-target[]" value="sakeMeterValue" onclick="Switch(this)" <?php sCheck('p-target', 'sakeMeterValue'); ?>>日本酒度</label>
        <div id="sakeMeterValue" class="hide">
          <div class="filter-detail">
            <p>範囲を設定してください</p>
            <label><input type="number" step="0.1" name="min_sakeMeterValue" placeholder="0.0" <?php sNumber('min_sakeMeterValue'); ?>>以上</label>
            <label><input type="number" step="0.1" name="max_sakeMeterValue" placeholder="5.0" <?php sNumber('max_sakeMeterValue'); ?>>以下</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="p-target[]" value="acidRate" onclick="Switch(this)" <?php sCheck('p-target', 'acidRate'); ?>>酸度</label>
        <div id="acidRate" class="hide">
          <div class="filter-detail">
            <p>範囲を設定してください</p>
            <label><input type="number" step="0.1" name="min_acidRate" min="0" placeholder="1.0" <?php sNumber('min_acidRate'); ?>>以上</label>
            <label><input type="number" step="0.1" name="max_acidRate" min="0" placeholder="2.0" <?php sNumber('max_acidRate'); ?>>以下</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="p-target[]" value="aminoAcidRate" onclick="Switch(this)" <?php sCheck('p-target', 'aminoAcidRate'); ?>>アミノ酸度</label>
        <div id="aminoAcidRate" class="hide">
          <div class="filter-detail">
            <p>範囲を設定してください</p>
            <label><input type="number" step="0.1" name="min_aminoAcidRate" min="0" placeholder="1.0" <?php sNumber('min_aminoAcidRate'); ?>>以上</label>
            <label><input type="number" step="0.1" name="max_aminoAcidRate" min="0" placeholder="1.5" <?php sNumber('max_aminoAcidRate'); ?>>以下</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="p-target[]" value="alcoholContent" onclick="Switch(this)" <?php sCheck('p-target', 'alcoholContent'); ?>>アルコール度</label>
        <div id="alcoholContent" class="hide">
          <div class="filter-detail">
            <p>範囲を設定してください</p>
            <label><input type="number" step="0.1" name="min_alcoholContent" min="0" placeholder="15.0" <?php sNumber('min_alcoholContent'); ?>>以上</label>
            <label><input type="number" step="0.1" name="max_alcoholContent" min="0" max="22" placeholder="16.0" <?php sNumber('max_alcoholContent'); ?>>以下</label>
          </div>
        </div>
      </div>
    </div>
    <div class="filtering-content">     <!-- 原料によるフィルタリング -->
      <div class="filtering-target">
        <p>原料</p>
        <label><input class="element main" type="checkbox" name="i-target[]" value="rice" onclick="Switch(this)" <?php sCheck('i-target', 'rice'); ?>>米</label>
        <div id="rice" class="hide">
          <div class="filter-detail">
            <p>品種を選択してください</p>
            <label><input class="element" type="checkbox" name="rice[]" value="一本〆" <?php sCheck('rice', '一本〆'); ?>>一本〆</label>
            <label><input class="element" type="checkbox" name="rice[]" value="雄町" <?php sCheck('rice', '雄町'); ?>>雄町</label>
            <label><input class="element" type="checkbox" name="rice[]" value="亀の尾" <?php sCheck('rice', '亀の尾'); ?>>亀の尾</label>
            <label><input class="element" type="checkbox" name="rice[]" value="こしいぶき" <?php sCheck('rice', 'こしいぶき'); ?>>こしいぶき</label>
            <label><input class="element" type="checkbox" name="rice[]" value="越神楽" <?php sCheck('rice', '越神楽'); ?>>越神楽</label>
            <label><input class="element" type="checkbox" name="rice[]" value="越淡麗" <?php sCheck('rice', '越淡麗'); ?>>越淡麗</label>
            <label><input class="element" type="checkbox" name="rice[]" value="コシヒカリ" <?php sCheck('rice', 'コシヒカリ'); ?>>コシヒカリ</label>
            <label><input class="element" type="checkbox" name="rice[]" value="五百万石" <?php sCheck('rice', '五百万石'); ?>>五百万石</label>
            <label><input class="element" type="checkbox" name="rice[]" value="紫黒米" <?php sCheck('rice', '紫黒米'); ?>>紫黒米</label>
            <label><input class="element" type="checkbox" name="rice[]" value="たかね錦" <?php sCheck('rice', 'たかね錦'); ?>>たかね錦</label>
            <label><input class="element" type="checkbox" name="rice[]" value="八反錦" <?php sCheck('rice', '八反錦'); ?>>八反錦</label>
            <label><input class="element" type="checkbox" name="rice[]" value="葉月みのり" <?php sCheck('rice', '葉月みのり'); ?>>葉月みのり</label>
            <label><input class="element" type="checkbox" name="rice[]" value="ひとごこち" <?php sCheck('rice', 'ひとごこち'); ?>>ひとごこち</label>
            <label><input class="element" type="checkbox" name="rice[]" value="美山錦" <?php sCheck('rice', '美山錦'); ?>>美山錦</label>
            <label><input class="element" type="checkbox" name="rice[]" value="山田錦" <?php sCheck('rice', '山田錦'); ?>>山田錦</label>
            <label><input class="element" type="checkbox" name="rice[]" value="楽風舞" <?php sCheck('rice', '楽風舞'); ?>>楽風舞</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="i-target[]" value="yeast" onclick="Switch(this)" <?php sCheck('i-target', 'yeast'); ?>>酵母</label>
        <div id="yeast" class="hide">
          <div class="filter-detail">
            <p>品種を選択してください</p>
            <label><input class="element" type="checkbox" name="yeast[]" value="K601" <?php sCheck('yeast', 'K601'); ?>>K601</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K7" <?php sCheck('yeast', 'K7'); ?>>K7</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K701" <?php sCheck('yeast', 'K701'); ?>>K701</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K901" <?php sCheck('yeast', 'K901'); ?>>K901</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K10" <?php sCheck('yeast', 'K10'); ?>>K10</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K1401" <?php sCheck('yeast', 'K1401'); ?>>K1401</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K1701" <?php sCheck('yeast', 'K1701'); ?>>K1701</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="K1801" <?php sCheck('yeast', 'K1801'); ?>>K1801</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="G74" <?php sCheck('yeast', 'G74'); ?>>G74</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="G74NF" <?php sCheck('yeast', 'G74NF'); ?>>G74NF</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="G8" <?php sCheck('yeast', 'G8'); ?>>G8</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="G9" <?php sCheck('yeast', 'G9'); ?>>G9</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="G9NF" <?php sCheck('yeast', 'G9NF'); ?>>G9NF</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="TR8" <?php sCheck('yeast', 'TR8'); ?>>TR8</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="T812" <?php sCheck('yeast', 'T812'); ?>>T812</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="M310" <?php sCheck('yeast', 'M310'); ?>>M310</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="S3" <?php sCheck('yeast', 'S3'); ?>>S3</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="S9" <?php sCheck('yeast', 'S9'); ?>>S9</label>
            <label><input class="element" type="checkbox" name="yeast[]" value="広島吟醸酵母" <?php sCheck('yeast', '広島吟醸酵母'); ?>>広島吟醸酵母</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="i-target[]" value="koji" onclick="Switch(this)" <?php sCheck('i-target', 'koji'); ?>>麹</label>
        <div id="koji" class="hide">
          <div class="filter-detail">
            <p>ブランドを選択してください</p>
            <label><input class="element" type="checkbox" name="koji[]" value="アキタコンノ" <?php sCheck('koji', 'アキタコンノ'); ?>>アキタコンノ</label>
            <label><input class="element" type="checkbox" name="koji[]" value="黒判もやし" <?php sCheck('koji', '黒判もやし'); ?>>黒判もやし</label>
            <label><input class="element" type="checkbox" name="koji[]" value="ヒグチモヤシ" <?php sCheck('koji', 'ヒグチモヤシ'); ?>>ヒグチモヤシ</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="i-target[]" value="water" onclick="Switch(this)" <?php sCheck('i-target', 'water'); ?>>水</label>
        <div id="water" class="hide">
          <div class="filter-detail">
            <p>硬度を選択してください</p>
            <label><input class="element" type="checkbox" name="water[]" value="軟水" <?php sCheck('water', '軟水'); ?>>軟水</label>
            <label><input class="element" type="checkbox" name="water[]" value="硬水" <?php sCheck('water', '硬水'); ?>>硬水</label>
          </div>
        </div>
      </div>
    </div>
    <div class="filtering-content">     <!-- 製法によるフィルタリング -->
      <div class="filtering-target">
        <p>製法</p>
        <label><input class="element main" type="checkbox" name="m-target[]" value="ricePolishing" onclick="Switch(this)" <?php sCheck('m-target', 'ricePolishing'); ?>>精米法</label>
        <div id="ricePolishing" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="ricePolishing[]" value="RoundRicePolishing" <?php sCheck('ricePolishing', 'RoundRicePolishing'); ?>>普通精米</label>
            <label><input class="element" type="checkbox" name="ricePolishing[]" value="SimilarRicePolishing" <?php sCheck('ricePolishing', 'SimilarRicePolishing'); ?>>原型精米</label>
            <label><input class="element" type="checkbox" name="ricePolishing[]" value="FlatRicePolishing" <?php sCheck('ricePolishing', 'FlatRicePolishing'); ?>>扁平精米</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="ricePolishingRate" onclick="Switch(this)" <?php sCheck('m-target', 'ricePolishingRate'); ?>>精米歩合</label>
        <div id="ricePolishingRate" class="hide">
          <div class="filter-detail">
            <p>範囲を設定してください</p>
            <label><input type="number" step="1" name="min_ricePolishingRate" min="0" max="100" placeholder="50" <?php sNumber('min_ricePolishingRate'); ?>>以上</label>
            <label><input type="number" step="1" name="max_ricePolishingRate" min="0" min="100" placeholder="65" <?php sNumber('max_ricePolishingRate'); ?>>以下</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="kojiMaking" onclick="Switch(this)" <?php sCheck('m-target', 'kojiMaking'); ?>>製麹法</label>
        <div id="kojiMaking" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="kojiMaking[]" value="TrayKoji" <?php sCheck('kojiMaking', 'TrayKoji'); ?>>蓋麹</label>
            <label><input class="element" type="checkbox" name="kojiMaking[]" value="BoxKoji" <?php sCheck('kojiMaking', 'BoxKoji'); ?>>箱麹</label>
            <label><input class="element" type="checkbox" name="kojiMaking[]" value="FloorKoji" <?php sCheck('kojiMaking', 'FloorKoji'); ?>>床麹</label>
            <label><input class="element" type="checkbox" name="kojiMaking[]" value="MachineryKoji" <?php sCheck('kojiMaking', 'MachineryKoji'); ?>>機械製麹</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="fermentationStarter" onclick="Switch(this)" <?php sCheck('m-target', 'fermentationStarter'); ?>>酒母造り</label>
        <div id="fermentationStarter" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="fermentationStarter[]" value="Kimoto" <?php sCheck('fermentationStarter', 'Kimoto'); ?>>生酛</label>
            <label><input class="element" type="checkbox" name="fermentationStarter[]" value="Yamahai" <?php sCheck('fermentationStarter', 'Yamahai'); ?>>山廃酛</label>
            <label><input class="element" type="checkbox" name="fermentationStarter[]" value="Bodai" <?php sCheck('fermentationStarter', 'Bodai'); ?>>菩提酛（水酛）</label>
            <label><input class="element" type="checkbox" name="fermentationStarter[]" value="Sokujo" <?php sCheck('fermentationStarter', 'Sokujo'); ?>>速醸酛</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="fermentationMash" onclick="Switch(this)" <?php sCheck('m-target', 'fermentationMash'); ?>>段仕込み</label>
        <div id="fermentationMash" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="fermentationMash[]" value="1" <?php sCheck('fermentationMash', '1'); ?>>一段仕込み</label>
            <label><input class="element" type="checkbox" name="fermentationMash[]" value="2" <?php sCheck('fermentationMash', '2'); ?>>二段仕込み</label>
            <label><input class="element" type="checkbox" name="fermentationMash[]" value="3" <?php sCheck('fermentationMash', '3'); ?>>三段仕込み</label>
            <label><input class="element" type="checkbox" name="fermentationMash[]" value="4" <?php sCheck('fermentationMash', '4'); ?>>四段仕込み</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="pressing" onclick="Switch(this)" <?php sCheck('m-target', 'pressing'); ?>>上槽法</label>
        <div id="pressing" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="pressing[]" value="BagHanging" <?php sCheck('pressing', 'BagHanging'); ?>>袋吊り</label>
            <label><input class="element" type="checkbox" name="pressing[]" value="FunePressing" <?php sCheck('pressing', 'FunePressing'); ?>>槽搾り</label>
            <label><input class="element" type="checkbox" name="pressing[]" value="FilterPressing" <?php sCheck('pressing', 'FilterPressing'); ?>>圧搾搾り</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="pressingOrder" onclick="Switch(this)" <?php sCheck('m-target', 'pressingOrder'); ?>>搾り取る順番</label>
        <div id="pressingOrder" class="hide">
          <div class="filter-detail">
            <label><input type="checkbox" name="pressingOrder[]" value="FirstRun" <?php sCheck('pressingOrder', 'FirstRun'); ?>>荒走り</label>
            <label><input type="checkbox" name="pressingOrder[]" value="MiddleRunSake" <?php sCheck('pressingOrder', 'MiddleRunSake'); ?>>中汲み</label>
            <label><input type="checkbox" name="pressingOrder[]" value="FinalRunSake" <?php sCheck('pressingOrder', 'FinalRunSake'); ?>>責め</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="pasteurization" onclick="Switch(this)" <?php sCheck('m-target', 'pasteurization'); ?>>火入れ</label>
        <div id="pasteurization" class="hide">
          <div class="filter-detail">
            <label><input type="checkbox" name="pasteurization[]" value="Namazake" <?php sCheck('pasteurization', 'Namazake'); ?>>生酒</label>
            <label><input type="checkbox" name="pasteurization[]" value="LiveBottledSake" <?php sCheck('pasteurization', 'LiveBottledSake'); ?>>生詰酒</label>
            <label><input type="checkbox" name="pasteurization[]" value="LiveStorageSake" <?php sCheck('pasteurization', 'LiveStorageSake'); ?>>生貯蔵酒</label>
            <label><input type="checkbox" name="pasteurization[]" value="Hiyaoroshi" <?php sCheck('pasteurization', 'Hiyaoroshi'); ?>>ひやおろし</label>
            <!-- <label><input type="checkbox" name="pasteurization[]" value="BottlePasteurization">瓶火入れ</label> -->
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="storage" onclick="Switch(this)" <?php sCheck('m-target', 'storage'); ?>>貯蔵容器</label>
        <div id="storage" class="hide">
          <div class="filter-detail">
            <label><input class="element" type="checkbox" name="storage[]" value="TankStorage" <?php sCheck('storage', 'TankStorage'); ?>>タンク貯蔵</label>
            <label><input class="element" type="checkbox" name="storage[]" value="BottleStorage" <?php sCheck('storage', 'BottleStorage'); ?>>樽貯蔵</label>
            <label><input class="element" type="checkbox" name="storage[]" value="CaskStorage" <?php sCheck('storage', 'CaskStorage'); ?>>瓶貯蔵</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="aging" onclick="Switch(this)" <?php sCheck('m-target', 'aging'); ?>>熟成の程度</label>
        <div id="aging" class="hide">
          <div class="filter-detail">
            <label><input type="checkbox" name="aging[]" value="FreshSake" <?php sCheck('aging', 'FreshSake'); ?>>しぼりたて</label>
            <label><input type="checkbox" name="aging[]" value="OldSake" <?php sCheck('aging', 'OldSake'); ?>>古酒（3年以上熟成）</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="premiumSake" onclick="Switch(this)" <?php sCheck('m-target', 'premiumSake'); ?>>特定名称</label>
        <div id="premiumSake" class="hide">
          <div class="filter-detail">
            <label><input type="checkbox" name="premiumSake[]" value="StandardSake" <?php sCheck('premiumSake', 'StandardSake'); ?>>普通酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="Junmai" <?php sCheck('premiumSake', 'Junmai'); ?>>純米酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="SpecialJunmai" <?php sCheck('premiumSake', 'SpecialJunmai'); ?>>特別純米酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="Honjozo" <?php sCheck('premiumSake', 'Honjozo'); ?>>本醸造酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="SpecialHonjozo" <?php sCheck('premiumSake', 'SpecialHonjozo'); ?>>特別本醸造酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="Ginjo" <?php sCheck('premiumSake', 'Ginjo'); ?>>吟醸酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="Daiginjo" <?php sCheck('premiumSake', 'Daiginjo'); ?>>大吟醸酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="JunmaiGinjo" <?php sCheck('premiumSake', 'JunmaiGinjo'); ?>>純米吟醸酒</label>
            <label><input type="checkbox" name="premiumSake[]" value="JunmaiDaiginjo" <?php sCheck('premiumSake', 'JunmaiDaiginjo'); ?>>純米大吟醸酒</label>
          </div>
        </div>
        <label><input class="element main" type="checkbox" name="m-target[]" value="other" onclick="Switch(this)" <?php sCheck('m-target', 'other'); ?>>その他</label>
        <div id="other" class="hide">
          <div class="filter-detail">
            <label><input type="checkbox" name="other[]" value="UnfilteredSake" <?php sCheck('other', 'UnfilteredSake'); ?>>無濾過酒</label>
            <label><input type="checkbox" name="other[]" value="UndilutedSake" <?php sCheck('other', 'UndilutedSake'); ?>>原酒</label>
            <label><input type="checkbox" name="other[]" value="CloudySake" <?php sCheck('other', 'CloudySake'); ?>>にごり酒</label>
            <label><input type="checkbox" name="other[]" value="Orizake" <?php sCheck('other', 'Orizake'); ?>>おり酒</label>
            <label><input type="checkbox" name="other[]" value="FirstlyMadeSake" <?php sCheck('other', 'FirstlyMadeSake'); ?>>初しぼり</label>
            <label><input type="checkbox" name="other[]" value="SparklingSake" <?php sCheck('other', 'SparklingSake'); ?>>発泡清酒</label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
