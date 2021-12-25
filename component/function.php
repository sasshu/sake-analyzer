<script type="text/javascript">
// 成分検索の入力チェック
function checkProp() {
  let x = document.getElementsByName('x-target');
  let y = document.getElementsByName('y-target');
  let countx = 0;
  let county = 0;
  for (var i = 0; i < x.length; i++) {
    if (!x[i].checked) {
      countx++;
    }
    if (!y[i].checked) {
      county++;
    }
    if (countx == x.length && county == y.length) {
      alert('基本条件（成分）のx軸項目、y軸項目が選択されていません。');
      return false;
    }else if (countx == x.length) {
      alert('基本条件（成分）のx軸項目が選択されていません。');
      return false;
    }else if (county == y.length) {
      alert('基本条件（成分）のy軸項目が選択されていません。');
      return false;
    }
  }
  if (!filterCheck()) {
    return false;
  }
  return true;
}

// 原料検索の入力チェック
function checkIng() {
  let ing = document.getElementsByName('ingredient');
  let count = 0;
  for (var i = 0; i < ing.length; i++) {
    if (!ing[i].checked) {
      count++;
    }
    if (count == ing.length) {
      alert('基本条件（原料）が選択されていません。');
      return false;
    }
  }
  if (!filterCheck()) {
    return false;
  }
  return true;
}

// 製法検索の入力チェック
function checkMan() {
  let man = document.getElementsByName('manufacture');
  let count = 0;
  for (var i = 0; i < man.length; i++) {
    if (!man[i].checked) {
      count++;
    }
    if (count == man.length) {
      alert('基本条件（製法）が選択されていません。');
      return false;
    }
  }
  if (!filterCheck()) {
    return false;
  }
  return true;
}

// 絞り込み条件の入力チェック
function filterCheck() {
  let search_count = Number(sessionStorage.getItem('condition'));
  for (var n = 1; n < search_count; n++) {
    let pt = document.getElementsByName('p-target' + n + '[]');
    for (var i = 0; i < pt.length; i++) {
      if (pt[i].checked) {
        let min = document.getElementsByName('min_' + pt[i].value)[0];
        let max = document.getElementsByName('max_' + pt[i].value)[0];
        if (min.value == '' && max.value == '') {
          inputAlert(n, '成分');
          return false;
        }else if (min.value != '' && max.value != '') {
          if (Number(min.value) > Number(max.value)) {
            inputAlert(n, '成分');
            return false;
          }
        }
        if (min.value == '0') {
          console.log('だめだこりゃ');
          document.getElementsByName('min_' + pt[i].value)[0].value = 0.0;
        }
        if (max.value == 0) {
          document.getElementsByName('mmax_' + pt[i].value)[0].value = 0.0;
        }
      }
    }
    let it = document.getElementsByName('i-target' + n + '[]');
    for (var i = 0; i < it.length; i++) {
      if (it[i].checked) {
        let item = document.getElementsByName(it[i].value + '[]');
        let judge = 0;
        for (var j = 0; j < item.length; j++) {
          if (item[j].checked) {
            judge = 1;
          }
        }
        if (judge == 0) {
          inputAlert(n, '原料');
          return false;
        }
      }
    }
    let mt = document.getElementsByName('m-target' + n + '[]');
    for (var i = 0; i < mt.length; i++) {
      if (mt[i].checked) {
        let item = document.getElementsByName(mt[i].value + '[]');
        if (mt[i].value.includes('ricePolishingRate')) {
          let min = document.getElementsByName('min_' + mt[i].value)[0];
          let max = document.getElementsByName('max_' + mt[i].value)[0];
          if (min.value == '' && max.value == '') {
            inputAlert(n, '製法');
            return false;
          }else if (min.value != '' && max.value != '') {
            if (Number(min.value) > Number(max.value)) {
              inputAlert(n, '製法');
              return false;
            }
          }
        }else {
          let judge = 0;
          for (var j = 0; j < item.length; j++) {
            if (item[j].checked) {
              judge = 1;
            }
          }
          if (judge == 0) {
            inputAlert(n, '製法');
            return false;
          }
        }
      }
    }
  }
  return true;
}

function inputAlert(n, target) {
  alert('条件' + n + 'における、' + target + 'の入力が不十分、もしくは正しくありません。');
}

// 絞り込みコンテンツの表示切り替え
function Switch(checks) {
  let drop = '';
  let hide = document.getElementsByName(checks.name);     // checks.name = '()-target[]'
  let display = document.getElementById(checks.value);
  if (checks.checked) {
    display.className = checks.value;
  }else if (!checks.checked) {
    display.className = 'hide';
    drop = document.getElementsByName(checks.value + '[]');
    for (var i = 0; i < drop.length; i++) {
      offCheck(drop[i]);
    }
    drop = document.getElementsByName('min_' + checks.value);
    for (var i = 0; i < drop.length; i++) {
      offNumber(drop[i]);
    }
    drop = document.getElementsByName('max_' + checks.value);
    for (var i = 0; i < drop.length; i++) {
      offNumber(drop[i]);
    }
  }
}

// チェックボックスの選択解除
function offCheck(sel) {
  let key = addNumber(sel);
  sessionStorage.removeItem(key);
  sel.checked = false;
}

// input numberの入力削除
function offNumber(sel) {
  let key = sel.name;
  sessionStorage.removeItem(key);
  sel.value = '';
}

function dupFilter(check) {
  let num = document.getElementsByClassName('filtering-contents').length;
  if (check.checked) {
    addDisp(num);
  }else {
    remDisp(num);
  }
}

// cssの動的変化
function changeStyle(check) {
  let parent = document.getElementById('parent-group');
  let group = document.getElementsByClassName('filtering-contents');
  let target = document.getElementsByClassName('filtering-content');

  let graph = document.getElementsByClassName('result-content');
  let result = document.getElementById('result-contents');

  if (check.checked) {                // 2通りの検索をする場合
    for (var i = 0; i < group.length; i++) {
      group[i].style.display = 'block';
      group[i].parentNode.style.width = '49%';
    }
    for (var i = 0; i < target.length; i++) {
      target[i].style.width = '100%';
      target[i].style.margin = '10px 0px';
    }

    parent.style.display = 'flex';
    result.style.display = 'flex';
  }else {                             // 1通りの検索をする場合
    for (var i = 0; i < group.length; i++) {
      group[i].style.display = 'flex';
      group[i].parentNode.style.width = '100%';
    }
    for (var i = 0; i < target.length; i++) {
      target[i].style.width = '32%';
      target[i].style.margin = '0px';
    }

    parent.style.display = 'block';
    result.style.display = 'black';
  }
}

// 絞り込み条件画面の追加
function addDisp(num) {
  let copy_area = document.getElementById('group0');
  let copy_element = copy_area.cloneNode(true);
  let group = document.getElementsByClassName('filtering-contents');
  let front = group[num-1].parentNode;
  front.after(copy_element);      // 複製した要素を一番後ろに挿入
  copy_element.innerHTML = replaceElement(copy_element.innerHTML, num);     // 変更した文字列を要素に適用
  copy_element.id = 'group' + num;
  copy_element.className = 'filtergroup';

  sessionStorage.setItem('condition', String(num+1));
}

// 絞り込み条件画面の削除
function remDisp(num) {
  let group = document.getElementsByClassName('filtering-contents');
  let element = group[num-1].parentNode;
  for (var i = 0; i < group.length; i++) {
    group[i].style.display = 'flex';
  }
  sessionStorage.setItem('condition', String(num-1));
  /*
  let child = document.getElementsByClassName('group1');
  for (var i = 0; i < child.length; i++) {
    if (child[i].type == 'checkbox') {
      offCheck(child[i]);
    }else if (child[i].type == 'number') {
      offNumber(child[i]);
    }
  }
  */
  element.remove();
}

function addResult(condition) {
  let result = document.getElementById('result2');
  if (Number(condition) > 2) {
    result.style.display = 'block';
  }else {
    result.style.display = 'none';
  }
}


// 複製した要素（絞り込み条件）を文字列に変換
function replaceElement(text, num) {
  // 基本条件（成分，原料，製法）
  text = text.replace(/p-target\d{1}/g, 'p-target' + num).replace(/i-target\d{1}/g, 'i-target' + num).replace(/m-target\d{1}/g, 'm-target' + num);
  // 絞り込み条件（成分）
  text = text.replace(/sakeMeterValue\d{1}/g, 'sakeMeterValue' + num).replace(/acidRate\d{1}/g, 'acidRate' + num).replace(/aminoAcidRate\d{1}/g, 'aminoAcidRate' + num).replace(/alcoholContent\d{1}/g, 'alcoholContent' + num);
  // 絞り込み条件（原料）
  text = text.replace(/rice\d{1}/g, 'rice' + num).replace(/yeast\d{1}/g, 'yeast' + num).replace(/koji\d{1}/g, 'koji' + num).replace(/water\d{1}/g, 'water' + num);
  // 絞り込み条件（製法）
  text = text.replace(/ricePolishing\d{1}/g, 'ricePolishing' + num).replace(/ricePolishingRate\d{1}/g, 'ricePolishingRate' + num).replace(/kojiMaking\d{1}/g, 'kojiMaking' + num).replace(/fermentationStarter\d{1}/g, 'fermentationStarter' + num);
  text = text.replace(/fermentationMash\d{1}/g, 'fermentationMash' + num).replace(/pressing\d{1}/g, 'pressing' + num).replace(/pressingOrder\d{1}/g, 'pressingOrder' + num).replace(/pasteurization\d{1}/g, 'pasteurization' + num);
  text = text.replace(/storage\d{1}/g, 'storage' + num).replace(/aging\d{1}/g, 'aging' + num).replace(/premiumSake\d{1}/g, 'premiumSake' + num).replace(/other\d{1}/g, 'other' + num);
  // その他
  text = text.replace(/条件\d{1}/g, '条件' + num);
  return text;
}

// ページ更新直後に実行
window.onload = () => {
  getCheck(document.getElementById('compare'));

  let condition = sessionStorage.getItem('condition');
  addResult(condition);
  console.log('condition' + condition);

  let max = 2;
  if (condition != null) {
    max = Number(condition);
  }
  console.log('max:' + max);
  for (var n = 1; n < max; n++) {
    // 絞り込み条件画面の複製
    addDisp(n);

    // 選択した絞り込み条件（成分）の復元
    let pt = document.getElementsByName('p-target' + n + '[]');
    for (var i = 0; i < pt.length; i++) {
      getCheck(pt[i]);
      Switch(pt[i]);
      let min_pt = document.getElementsByName('min_' + pt[i].value);
      let max_pt = document.getElementsByName('max_' + pt[i].value);
      getNumber(min_pt[0]);
      getNumber(max_pt[0]);
    }
    // 選択した絞り込み条件（原料）の復元
    let it = document.getElementsByName('i-target' + n + '[]');
    for (var i = 0; i < it.length; i++) {
      getCheck(it[i]);
      Switch(it[i]);
      let child_it = document.getElementsByName(it[i].value + '[]');
      for (var j = 0; j < child_it.length; j++) {
        getCheck(child_it[j]);
      }
    }
    // 選択した絞り込み条件（製法）の復元
    let mt = document.getElementsByName('m-target' + n + '[]');
    for (var i = 0; i < mt.length; i++) {
      getCheck(mt[i]);
      Switch(mt[i]);
      if (mt[i].value.includes('ricePolishingRate')) {                   // 精米歩合
        let min_mt = document.getElementsByName('min_' + mt[i].value);
        let max_mt = document.getElementsByName('max_' + mt[i].value);
        getNumber(min_mt[0]);
        getNumber(max_mt[0]);
      }else {
        let child_mt = document.getElementsByName(mt[i].value + '[]');
        for (var j = 0; j < child_mt.length; j++) {
          getCheck(child_mt[j]);
        }
      }
    }
  }
  let main = document.querySelectorAll("input[type='radio']");
  for (var i = 0; i < main.length; i++) {
    getRadio(main[i]);
  }
  changeStyle(document.getElementById('compare'));
}

// ラジオボタンの値を保存
function sRadio(radio) {
  let radios = document.getElementsByName(radio.name);
  for (var i = 0; i < radios.length; i++) {
    let value = radios[i].name.substr(0, 2) + radios[i].value;
    if (radios[i].checked) {
      if (sessionStorage.getItem(value) == 'true') {        // すでにチェックされていた場合
        sessionStorage.removeItem(value);                   // sessionからcheckboxの値を削除
        radios[i].checked = false;
      }else {
        sessionStorage.setItem(value, radios[i].checked);     // sessionにラジオボタンの値を保存
      }
    }else {
      sessionStorage.removeItem(value);                     // sessionからcheckboxの値を削除
    }
  }
}

function getRadio(radio) {
  let value = radio.name.substr(0, 2) + radio.value;
  let checked = sessionStorage.getItem(value);    // sessionからcheckboxの値を取得
  if (checked == 'true') {
    radio.checked = true;
    console.log('check:' + value);
  }
}

// 数値を保存
function sNumber(numbers) {
  sessionStorage.setItem(numbers.name, numbers.value);    // sessionに数値を保存
}

// 数値を取得・反映
function getNumber(numbers) {
  let value = sessionStorage.getItem(numbers.name);      // sessionから数値を取得
  if (value != null) {
    numbers.value = value;
    console.log(numbers.name + ':' + value);
  }
}

// checkboxの値を保存
function sCheck(checks) {
  let value = addNumber(checks);
  if (checks.checked) {
    sessionStorage.setItem(value, checks.checked);    // sessionにcheckboxの値を保存
  }else {
    sessionStorage.removeItem(value);    // sessionからcheckboxの値を削除
  }
}

// checkboxの値を取得・反映
function getCheck(checks) {
  let value = addNumber(checks);
  let checked = sessionStorage.getItem(value);    // sessionからcheckboxの値を取得
  if (checked == 'true') {
    checks.checked = true;
    console.log('check:' + value);
  }
}

// 要素番号を追加
function addNumber(element) {
  let val = element.value;
  if (element.className.includes('element sub')) {      // 要素番号がない場合
    val += '-' + element.name.substr(-3, 1);        // 要素番号を末尾に追加
  }
  return val;
}

function confInit() {
  let init = confirm('検索条件を初期化してもよろしいですか？');
  if (init) {
    initialize();
  }
}

function initialize() {
  let radios = document.querySelectorAll("input[type='radio']");
  let checks = document.querySelectorAll("input[type='checkbox']");
  let numbers = document.querySelectorAll("input[type='number']");
  for (var i = 0; i < radios.length; i++) {
    offCheck(radios[i]);      // ラジオボタンのチェックをすべて外す
  }
  for (var i = 0; i < checks.length; i++) {
    offCheck(checks[i]);         // checkboxのチェックをすべて外す
  }
  for (var i = 0; i < checks.length; i++) {
    if (checks[i].className.includes('element main')) {
      let display = document.getElementById(checks[i].value);
      display.className = 'hide';     // 要素を非表示にする
    }
  }
  for (var i = 0; i < numbers.length; i++) {
    offNumber(numbers[i]);               // input numberの値を初期化する
  }

  changeStyle(document.getElementById('compare'));
  let len = document.getElementsByClassName('filtering-contents').length;
  if (len > 2) {      //
    remDisp(len);     // 追加した絞り込み条件画面の初期化
  }
  document.getElementById('result-graphs').className = 'hide';      // グラフ画面の非表示

  sessionStorage.clear();       // sessionの初期化
}
</script>


<?php
function sRadio($type, $value) {      // ラジオボタンの入力保持
  if (isset($_POST[$type]) && $_POST[$type] == $value) {
    echo 'checked';
  }
}

/*
function Queryjudge($attr, $xt, $yt) {
  if (isset($_POST['x-target']) && isset($_POST['y-target'])) {
    $attr = 'result-wrapper';
    $xt = $_POST['x-target'];
    $yt = $_POST['y-target'];
  }
}
*/

function getEndpoint() {      // SPARQL endpointの取得
  /*
  return 'http://echigodb.jp:8893/sparql/';
  */
  return 'https://echigosake.tk/';
}

function preQuery() {     // グラフやprefixの指定
  echo 'PREFIX schema: <https://schema.org/>'."\n";
  echo 'PREFIX sk-eval: <http://www.sakevoc.jp/eval/>'."\n";
  echo 'PREFIX sk-prep: <http://www.sakevoc.jp/prep/>'."\n";
  echo 'PREFIX sk-make: <http://www.sakevoc.jp/make/>'."\n";
  echo 'with <http://sake_data>'."\n";
}

// 原料に対するクエリ詳細
function ing($target) {
  switch ($target) {
    case 'rice':
      echo '{?ingredient a sk-prep:Rice}'."\n";
      echo 'union{?ingredient a sk-prep:KojiRice}'."\n";
      echo 'union{?ingredient a sk-prep:KakeRice}'."\n";
      echo '?ingredient schema:name ?ing.'."\n";
      break;
    case 'yeast':
      echo '?ingredient a sk-prep:Yeast;'."\n";
      echo '            schema:manufacturer ?yeast_maker;'."\n";
      echo '            schema:name ?ing.'."\n";
      echo "filter(?ing != 'きょうかい酵母')"."\n";
      break;
    case 'koji':
      echo '?ingredient a sk-prep:SeedKoji;'."\n";
      echo '            schema:brand / schema:name ?ing.'."\n";
      break;
    case 'water':
      echo '?ingredient a sk-prep:Water;'."\n";
      echo '            schema:category / rdfs:label ?ing.'."\n";
      echo "filter(lang(?ing) = 'ja')"."\n";
      break;
    default:
      break;
  }
}

function dataSort($target) {
  if ($target == 'ricePolishingRate') {
    echo "order by desc(?${target})";
  }else {
    echo 'order by desc(?count)';
  }
}

// 描画するグラフを指定
function selectChart($target) {
if ($target == 'ricePolishingRate' || $target == 'pressingOrder' || $target == 'pasteurization' || $target == 'aging' || $target == 'other' /* || $target == 'unfilteredSake' || $target == 'undilutedSake' || $target == 'cloudySake' || $target == 'orizake' || $target == 'firstlyMadeSake' || $target == 'sparklingSake' */) {
    return "google.visualization.ColumnChart";
  }else {
    return "google.visualization.PieChart";
  }
}

// 製法に対するクエリ詳細
function man($target) {
  switch ($target) {
    case 'ricePolishingRate':
      echo '?s sk-make:ricePolishingRate / schema:value ?man.'."\n";
      /*
      echo '?s sk-make:ricePolishingRate / schema:unitText ?unit.'."\n";
      echo 'bind(concat(?ricePolishingRate, ?unit) as ?man)'."\n";
      */
      break;
    case 'premiumSake':
      echo '?s schema:category ?categ .'."\n";
      echo '{?categ rdfs:subClassOf / rdfs:subClassOf sk-eval:PremiumSake.}'."\n";
      echo 'union{sk-eval:PremiumSake owl:disjointWith ?categ.}'."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'ricePolishing':
      echo '?s sk-make:makingMethod ?mtd.'."\n";
      echo '?mtd rdfs:subClassOf sk-make:RicePolishing;'."\n";
      echo '     rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'kojiMaking':
      echo '?s sk-make:makingMethod ?mtd.'."\n";
      echo '?mtd rdfs:subClassOf sk-make:KojiMaking;'."\n";
      echo '     rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'fermentationStarter':
      echo '?s sk-make:makingMethod ?mtd.'."\n";
      echo '{?mtd rdfs:subClassOf sk-make:MakingFermentationStarter.}'."\n";
      echo 'union{?mtd rdfs:subClassOf / rdfs:subClassOf sk-make:MakingFermentationStarter.}'."\n";
      echo '?mtd rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'fermentationMash':
      echo '?s sk-make:mashingTimes / schema:value ?fermentationMash.'."\n";
      echo '?s sk-make:mashingTimes / schema:unitText ?unit.'."\n";
      echo "bind(concat(?fermentationMash, ?unit) as ?man)"."\n";
      break;
    case 'pressing':
      echo '?s sk-make:makingMethod ?mtd.'."\n";
      echo '?mtd rdfs:subClassOf sk-make:Pressing;'."\n";
      echo '     rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'pressingOrder':
      echo '?s schema:category ?categ.'."\n";
      echo '{?categ owl:disjointWith sk-eval:MiddleRunSake.}'."\n";
      echo 'union{sk-eval:FirstRun owl:disjointWith ?categ.}'."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'pasteurization':
      echo '?s schema:category ?categ.'."\n";
      echo '{?categ owl:disjointWith sk-eval:Namazake.}'."\n";
      echo 'union{sk-eval:LiveBottledSake owl:disjointWith ?categ.}'."\n";
      echo 'union{?categ rdfs:subClassOf sk-eval:LiveBottledSake.}'."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'storage':
      echo '?s sk-make:makingMethod ?mtd.'."\n";
      echo '?mtd rdfs:subClassOf sk-make:Storage;'."\n";
      echo '     rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'aging':
      echo '?s schema:category ?categ.'."\n";
      echo '{?categ owl:disjointWith sk-eval:OldSake.}'."\n";
      echo 'union{sk-eval:FreshSake owl:disjointWith ?categ.}'."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'other':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:UnfilteredSake || ?categ = sk-eval:UndilutedSake || ?categ = sk-eval:CloudySake || ?categ = sk-eval:Orizake || ?categ = sk-eval:SparklingSake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    /*
    case 'unfilteredSake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:UnfilteredSake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'undilutedSake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:UndilutedSake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'cloudySake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:CloudySake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'orizake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:Orizake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'firstlyMadeSake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:FirstlyMadeSake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    case 'sparklingSake':
      echo '?s schema:category ?categ.'."\n";
      echo "filter(?categ = sk-eval:SparklingSake)"."\n";
      echo '?categ rdfs:label ?man.'."\n";
      echo "filter(lang(?man) = 'ja')"."\n";
      break;
    */
    default:
      break;
  }
}

function addpCon($num) {      // 成分に対する絞り込み条件をクエリに反映
  if (!empty($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];      // 要素を抽出（sakeMeterValue0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（sakeMeterValue等）

      if ($iri == $_POST['x-target']) {     // x要素と同じ場合
        $ord = 'x';
      }else if ($iri == $_POST['y-target']) {     // y要素と同じ場合
        $ord = 'y';
      }else if ($count == 0) {
        $ord = 'fi';
      }else if ($count == 1){
        $ord = 'se';
      }
      if ($iri != $_POST['x-target'] && $iri != $_POST['y-target']) {     // 基本条件の2つと異なる場合
        echo "?s sk-eval:${iri} / schema:minValue ?min_${ord};"."\n";
        echo "   sk-eval:${iri} / schema:maxValue ?max_${ord}."."\n";
        echo "bind(((?min_${ord} + ?max_${ord}) / 2) as ?${ord}_value)"."\n";
        $count++;
      }
      if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
        $min = $_POST["min_${flt}"];
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
        $max = $_POST["max_${flt}"];
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
    }
  }
  if (!empty($_POST["i-target${num}"])) {     // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];      // 要素を抽出（rice0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（rice等）

      list($arg1, $arg2) = ingFilter($iri);
      sameFilter($flt, $arg1, $arg2);
    }
  }
  if (!empty($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];      // 要素を抽出（pressing0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（pressing等）

      if ($iri == "ricePolishingRate") {
        echo "?s sk-make:${iri} / schema:value ?${iri}."."\n";
        if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
          $min = $_POST["min_${flt}"];
          echo "filter(?${iri} >= ${min})"."\n";
        }
        if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
          $max = $_POST["max_${flt}"];
          echo "filter(?${iri} <= ${max})"."\n";
        }
      }else {
        list($arg1, $arg2) = manFilter($iri);
        sameFilter($flt, $arg1, $arg2);
      }
    }
  }
}

function addiCon($num) {      // 原料に対する絞り込み条件をクエリに反映
  if (!empty($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      switch ($count) {
        case 0:
          $ord = 'fi';
          break;
        case 1:
          $ord = 'se';
          break;
        case 2:
          $ord = 'th';
          break;
        case 3:
          $ord = 'fo';
          break;
        default:
          break;
      }
      echo "?s sk-eval:${iri} / schema:minValue ?min_${ord};"."\n";
      echo "   sk-eval:${iri} / schema:maxValue ?max_${ord}."."\n";
      echo "bind(((?min_${ord} + ?max_${ord}) / 2) as ?${ord}_value)"."\n";

      if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
        $min = $_POST["min_${flt}"];
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
        $max = $_POST["max_${flt}"];
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
      $count++;
    }
  }
  if (!empty($_POST["i-target${num}"])) {      // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      list($arg1, $arg2) = ingFilter($iri);
      sameFilter($flt, $arg1, $arg2);
    }
  }
  if (!empty($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      if ($iri == 'ricePolishingRate') {
        echo "?s sk-make:${iri} / schema:value ?${iri}."."\n";
        if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
          $min = $_POST["min_${flt}"];
          echo "filter(?${iri} >= ${min})"."\n";
        }
        if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
          $max = $_POST["max_${flt}"];
          echo "filter(?${iri} <= ${max})"."\n";
        }
      }else {
        list($arg1, $arg2) = manFilter($iri);
        sameFilter($flt, $arg1, $arg2);
      }
    }
  }
}

function addmCon($num) {      // 製法に対する絞り込み条件をクエリに反映
  if (!empty($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      switch ($count) {
        case 0:
          $ord = 'fi';
          break;
        case 1:
          $ord = 'se';
          break;
        case 2:
          $ord = 'th';
          break;
        case 3:
          $ord = 'fo';
          break;
        default:
          break;
      }
      echo "?s sk-eval:${iri} / schema:minValue ?min_${ord};"."\n";
      echo "   sk-eval:${iri} / schema:maxValue ?max_${ord}."."\n";
      echo "bind(((?min_${ord} + ?max_${ord}) / 2) as ?${ord}_value)"."\n";

      if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
        $min = $_POST["min_${flt}"];
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
        $max = $_POST["max_${flt}"];
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
      $count++;
    }
  }
  if (!empty($_POST["i-target${num}"])) {     // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      list($arg1, $arg2) = ingFilter($iri);
      sameFilter($flt, $arg1, $arg2);
    }
  }
  if (!empty($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);

      if ($iri == 'ricePolishingRate') {
        if ($iri != $_POST['manufacture']) {
          echo "?s sk-make:${iri} / schema:value ?${iri}."."\n";
        }
        if (!empty($_POST["min_${flt}"]) || $_POST["min_${flt}"] == '0') {
          $min = $_POST["min_${flt}"];
          if ($iri == $_POST['manufacture']) {
            echo "filter(?man >= ${min})"."\n";
          }else {
            echo "filter(?${iri} >= ${min})"."\n";
          }
        }
        if (!empty($_POST["max_${flt}"]) || $_POST["max_${flt}"] == '0') {
          $max = $_POST["max_${flt}"];
          if ($iri == $_POST['manufacture']) {
            echo "filter(?man >= ${max})"."\n";
          }else {
            echo "filter(?${iri} >= ${max})"."\n";
          }
        }
      }else {
        list($arg1, $arg2) = manFilter($iri);
        sameFilter($flt, $arg1, $arg2);
      }
    }
  }
}

// 数値で絞り込む際のクエリ記述
function numFilter($iri) {

}

// 原料で絞り込む際のクエリ記述
function ingFilter($iri) {
  $item = '';
  if (isset($_POST['ingredient']) && $iri == $_POST['ingredient']) {
    $item = 'ing';
  }else {
    switch ($iri) {
      case "rice":
        echo '?s schema:material ?rice.'."\n";
        echo '{?rice a sk-prep:Rice.}'."\n";
        echo 'union {?rice a sk-prep:KojiRice.}'."\n";
        echo 'union {?rice a sk-prep:KakeRice.}'."\n";
        echo '?rice schema:name ?rice_name.'."\n";
        $item = 'rice_name';
        break;
      case "yeast":
        echo '?s schema:material ?yeast.'."\n";
        echo '?yeast a sk-prep:Yeast;'."\n";
        echo '       schema:name ?yeast_name.'."\n";
        $item = 'yeast_name';
        break;
      case "koji":
        echo '?s schema:material ?koji.'."\n";
        echo '?koji a sk-prep:SeedKoji;'."\n";
        echo '      schema:brand / schema:name ?koji_brand.'."\n";
        $item = 'koji_brand';
        break;
      case "water":
        echo '?s schema:material ?water.'."\n";
        echo '?water a sk-prep:Water;'."\n";
        echo '       schema:category / rdfs:label ?water_type.'."\n";
        echo "filter(lang(?water_type) = 'ja')"."\n";
        echo "bind(str(?water_type) as ?water_tp)"."\n";
        $item = 'water_tp';
        break;
      default:
        break;
    }
  }
  return [$item, 'none'];
}

// 製法で絞り込む際のクエリ記述
function manFilter($iri) {
  if (isset($_POST['manufacture']) && $iri == $_POST['manufacture']) {
    if ($iri == 'fermentationMash') {
      $prefix = 'none';
      $item = $iri;
    }else if ($iri == 'fermentationStarter' || $iri == 'pressing' || $iri == 'ricePolishing' || $iri == 'kojiMaking' || $iri == 'storage') {
      $prefix = 'sk-make';
      $item = 'mtd';
    }else {
      $prefix = 'sk-eval';
      $item = 'categ';
    }
  }else {
    if ($iri == 'fermentationMash') {
      echo "?s sk-make:mashingTimes / schema:value ?${iri}."."\n";
      $prefix = 'none';
    }else if ($iri == 'fermentationStarter' || $iri == 'pressing' || $iri == 'ricePolishing' || $iri == 'kojiMaking' || $iri == 'storage') {
      echo "?s sk-make:makingMethod ?${iri}."."\n";
      $prefix = 'sk-make';
    }else {
      echo "?s schema:category ?${iri}."."\n";
      $prefix = 'sk-eval';
    }
    $item = $iri;
  }
  return [$item, $prefix];
}

// クエリの'='で表すフィルター処理
function sameFilter($flt, $item, $prefix) {
  $element = $_POST[$flt];
  echo 'filter(';
  for ($i=0; $i<count($element); $i++) {
    $value = $element[$i];
    if ($prefix != 'none') {            // IRIの場合
      echo "?${item} = ${prefix}:${value}";
    }else if (is_numeric($value)) {     // 数値の場合
      echo "?${item} = ${value}";
    }else {                             // テキストの場合
      echo "?${item} = '${value}'";
    }
    if (!empty($element[$i+1])) {
      echo ' || ';
    }
  }
  echo ')'."\n" ;
}

/* グラフ描画のための関数
   なくても何とかなるが，ないとグラフがとても見づらくなる．
*/
// グラフ軸ラベルの記述
function trans($val) {
  switch ($val) {
    case 'sakeMeterValue':
      echo '日本酒度';
      break;
    case 'acidRate':
      echo '酸度';
      break;
    case 'aminoAcidRate':
      echo 'アミノ酸度';
      break;
    case 'alcoholContent':
      echo 'アルコール分（度）';
      break;
    case 'ricePolishingRate':
      echo '精米歩合（％）';
      break;
    case 'count':
      echo '日本酒の数';
      break;
    default:
      break;
  }
}

// グラフ軸目盛の最小値
function minSize($val) {
  switch ($val) {
    case 'sakeMeterValue':
      echo '-80';
      break;
    case 'acidRate':
      echo '0';
      break;
    case 'aminoAcidRate':
      echo '0';
      break;
    case 'alcoholContent':
      echo '5';
      break;
    case 'ricePolishingRate':
      echo '0';
      break;
    default:
      break;
  }
}

// グラフ軸目盛の最大値
function maxSize($val) {
  switch ($val) {
    case 'sakeMeterValue':
      echo '30';
      break;
    case 'acidRate':
      echo '10';
      break;
    case 'aminoAcidRate':
      echo '5';
      break;
    case 'alcoholContent':
      echo '25';
      break;
    case 'ricePolishingRate':
      echo '100';
      break;
    default:
      break;
  }
}

// グラフの大きさの設定
function graphStyle() {
  if (!empty($_POST['compare'])) {
    echo '50%';
  }else {
    echo '100%';
  }
}

// グラフ位置の調整
function chartArea($chart) {
  if (strpos($chart, 'Column')) {
    echo 'chartArea.left=10%';
    echo '|';
    echo 'chartArea.right=10%';
  }else if (strpos($chart, 'Pie')) {
    echo 'chartArea.left=20%';
    echo '|';
    echo 'chartArea.right=10%';
  }
}

// 棒グラフの設定
function columnSetting($val) {
  $chart = selectChart($val);
  if (strpos($chart, 'Column')) {
    echo 'explorer.keepInBounds=true';
    echo '|';
    echo 'explorer.maxZoomIn=0.1';
    if ($val == 'ricePolishingRate') {
      echo '|';
      echo 'bar.groupWidth=100%';
    }
  }
}

// データ数に基づくグラフ軸目盛の調整
function matchSize($val) {
  switch ($val) {
    case 'ricePolishingRate':
      echo '180';
      break;
    case 'pressingOrder':
      echo '10';
      break;
    case 'pasteurization':
      echo '90';
      break;
    case 'aging':
      echo '45';
      break;
    case 'other':
      echo '140';
      break;
    default:
      break;
  }
}

?>
