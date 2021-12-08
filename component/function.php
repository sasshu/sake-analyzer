<script type="text/javascript">
let menu = 1;
function dropdown() {
  if (menu == 1) {
    document.getElementById('search-menu').style.display = 'block';
    menu *= -1;
  }else {
    document.getElementById('search-menu').style.display = 'none';
    menu *= -1;
  }
}

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
  return true;
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
    offCheck(drop);
    drop = document.getElementsByName('min_' + checks.value);
    offNumber(drop);
    drop = document.getElementsByName('max_' + checks.value);
    offNumber(drop);
  }
}

// チェックボックスの選択解除
function offCheck(drop) {
  for (var i = 0; i < drop.length; i++) {
    let key = addNumber(drop[i]);
    sessionStorage.removeItem(key);
    drop[i].checked = false;
  }
}

// input numberの入力削除
function offNumber(drop) {
  for (var i = 0; i < drop.length; i++) {
    let key = drop[i].name;
    sessionStorage.removeItem(key);
    drop[i].value = '';
  }
}

// 画面の追加
function dupFilter(btn) {
  // 絞り込み条件画面の追加
  let element = document.getElementsByClassName('filtering-contents');
  let copy_area = btn.nextElementSibling;
  let copy_element = copy_area.cloneNode(true);

  let last = element.length - 1;
  element[last].after(copy_element);      // 複製した要素を一番後ろに挿入
  element[last+1].innerHTML = replaceElement(element[last+1].innerHTML, last+1);     // 変更した文字列を要素に適用

  // 結果画面の追加
  let graph = document.getElementsByClassName('result-contents');
  let graph_area = graph[0];
  let copy_graph = graph_area.cloneNode(true);
  let end = graph.length - 1;
  graph[end].after(copy_graph);      // 複製した要素を一番後ろに挿入
  graph[end+1].innerHTML = replaceResult(graph[end+1].innerHTML, end+1);     // 変更した文字列を要素に適用
}

// 複製した画面の削除
function delFilter(btn) {
  // 絞り込み条件画面の削除
  let element = document.getElementsByClassName('filtering-contents');
  let num = element.length;
  if (element.length > 1) {       // 2つ以上要素があれば
    for (var i = 0; i < element.length; i++) {
      if (btn.parentNode == element[i]) {
        btn.parentNode.remove();      // 要素を削除
        delete element[i];
        num = i;
      }
    }
    for (var i = num; i < element.length; i++) {      // 要素番号を前に詰める
      element[i].innerHTML = replaceElement(element[i].innerHTML, i);
    }
  }else {                         // 1つしか残っていない場合
    alert('これ以上削除できません。');
    return false;
  }
}

// 複製した要素（結果画面）を文字列に変換
function replaceResult(text, num) {
  // クエリ
  text = text.replace(/result\d{1}/g, 'result' + num);
  text = text.replace(/addpCon(\d{1})/g, 'addpCon' + '(' + num + ')').replace(/addiCon(\d{1})/g, 'addiCon' + '(' + num + ')').replace(/addmCon(\d{1})/g, 'addmCon' + '(' + num + ')');
  text = text.replace(/count-query\d{1}/g, 'count-query' + num).replace(/property-query\d{1}/g, 'property-query' + num);
  return text;
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
  text = text.replace(/filter\d{1}/g, 'filter' + num);
  return text;
}

// ページ更新直前に実行
window.addEventListener('DOMContentLoaded', () => {
  sessionStorage.setItem('condition', String(document.getElementsByClassName('filtering-contents').length));
  let condition = sessionStorage.getItem('condition');
  console.log(condition);
});


// ページ更新直後に実行
window.onload = () => {
  let condition = sessionStorage.getItem('condition');
  console.log(condition);
  for (var n = 0; n < 3; n++) {
    /*
    if (n > 0) {
      let btn = document.getElementById('compare');
      dupFilter(btn);
    }
    */
    // 選択した絞り込み条件（成分）の復元
    let pt = document.getElementsByName('p-target' + n + '[]');
    for (var i = 0; i < pt.length; i++) {
      getCheck(pt[i]);
      let min_pt = document.getElementsByName('min_' + pt[i].value);
      let max_pt = document.getElementsByName('max_' + pt[i].value);
      getNumber(min_pt[0]);
      getNumber(max_pt[0]);
      Switch(pt[i]);
    }
    // 選択した絞り込み条件（原料）の復元
    let it = document.getElementsByName('i-target' + n + '[]');
    for (var i = 0; i < it.length; i++) {
      getCheck(it[i]);
      let child_it = document.getElementsByName(it[i].value + '[]');
      for (var j = 0; j < child_it.length; j++) {
        getCheck(child_it[j]);
      }
      Switch(it[i]);
    }
    // 選択した絞り込み条件（製法）の復元
    let mt = document.getElementsByName('m-target' + n + '[]');
    for (var i = 0; i < mt.length; i++) {
      getCheck(mt[i]);
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
      Switch(mt[i]);
    }
  }
  let main = document.querySelectorAll("input[type='radio']");
  for (var i = 0; i < main.length; i++) {
    getRadio(main[i]);
  }
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
  }
}

// 数値を保存
function sNumber(numbers) {
  sessionStorage.setItem(numbers.name, numbers.value);    // sessionに数値を保存
}

// 数値を取得・反映
function getNumber(numbers) {
  let value = sessionStorage.getItem(numbers.name);      // sessionから数値を取得
  numbers.value = value;
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
  }
}

// 要素番号を追加
function addNumber(element) {
  let val = element.value;
  if (element.className == 'element sub') {      // 要素番号がない場合
    val += '-' + element.name.substr(-3, 1);        // 要素番号を末尾に追加
  }
  return val;
}

function initialize() {
  let init = confirm('検索条件を初期化してもよろしいですか？');
  if (init) {
    sessionStorage.clear();       // sessionの初期化
    let checks = document.querySelectorAll("input[type='checkbox']");
    let radios = document.querySelectorAll("input[type='radio']");
    for (var i = 0; i < checks.length; i++) {
      checks[i].checked = false;      // checkboxのチェックをすべて外す
      if (checks[i].className == 'element main') {
        let display = document.getElementById(checks[i].value);
        display.className = 'hide';     // 要素を非表示にする
      }
    }
    for (var i = 0; i < radios.length; i++) {
      radios[i].checked = false;      // ラジオボタンのチェックをすべて外す
    }
  }
}
</script>


<?php
/*
if (isset($_POST['init'])) {      // 検索条件の初期化
  $_POST = '';
}
*/

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
  echo 'http://echigodb.jp:8893/sparql/';
}

function preQuery() {     // グラフやprefixの指定
  echo 'PREFIX schema: <http://schema.org/>'."\n";
  echo 'PREFIX sk-eval: <http://www.sakevoc.jp/eval/>'."\n";
  echo 'PREFIX sk-prep: <http://www.sakevoc.jp/prep/>'."\n";
  echo 'PREFIX sk-make: <http://www.sakevoc.jp/make/>'."\n";
  echo 'with <http://sake_data>'."\n";
}

function ing($target) {     // 原料に対するクエリ詳細
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
    echo 'order by desc(?value)';
  }else {
    echo 'order by desc(?count)';
  }
}

function selectChart($target) {     // グラフの種類を指定
if ($target == 'pressingOrder' || $target == 'pasteurization' || $target == 'aging' || $target == 'other' /* || $target == 'unfilteredSake' || $target == 'undilutedSake' || $target == 'cloudySake' || $target == 'orizake' || $target == 'firstlyMadeSake' || $target == 'sparklingSake' */) {
    echo "google.visualization.ColumnChart";
  }else {
    echo "google.visualization.PieChart";
  }
}

function man($target) {
  switch ($target) {
    case 'ricePolishingRate':
      echo '?s sk-make:ricePolishingRate / schema:value ?value.'."\n";
      echo '?s sk-make:ricePolishingRate / schema:unitText ?unit.'."\n";
      echo 'bind(concat(?value, ?unit) as ?man)'."\n";
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
      echo '?s sk-make:mashingTimes / schema:value ?value.'."\n";
      echo '?s sk-make:mashingTimes / schema:unitText ?unit.'."\n";
      echo "bind(concat(?value, ?unit) as ?man)"."\n";
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
  if (isset($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];      // 要素を抽出（sakeMeterValue0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（sakeMeterValue等）
      if (isset($_POST["min_${flt}"])) {
        $min = $_POST["min_${flt}"];
      }
      if (isset($_POST["max_${flt}"])) {
        $max = $_POST["max_${flt}"];
      }
      if ($iri == $_POST['x-target']) {     // x要素と同じ場合
        $ord = 'x';
      }else if ($iri == $_POST['y-target']) {     // y要素と同じ場合
        $ord = 'y';
      }else if ($count == 0) {
        $ord = 'fi';
      }else if ($count == 1){
        $ord = 'se';
      }
      if ($flt != $_POST['x-target'] && $flt != $_POST['y-target']) {     // 基本条件の2つと異なる場合
        echo "?s sk-eval:${iri} / schema:minValue ?${ord}min;"."\n";
        echo "   sk-eval:${iri} / schema:maxValue ?${ord}max."."\n";
        echo "bind(((?${ord}min + ?${ord}max) / 2) as ?${ord}_value)"."\n";
        $count++;
      }
      if ($min != '') {
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if ($max != '') {
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
    }
  }
  if (isset($_POST["i-target${num}"])) {     // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];      // 要素を抽出（rice0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（rice等）
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
      sameFilter($flt, $item, 'none');
    }
  }
  if (isset($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];      // 要素を抽出（pressing0等）
      $iri = substr($flt, 0, strlen($flt)-1);     // 要素番号を取り除く（pressing等）
      if ($iri == "ricePolishingRate") {
        echo '?s sk-make:ricePolishingRate / schema:value ?ricePolishingRate.'."\n";
        if (isset($_POST["min_${flt}"])) {
          $min = $_POST["min_${flt}"];
        }
        if (isset($_POST["max_${flt}"])) {
          $max = $_POST["max_${flt}"];
        }
        if ($min != '') {
          echo "filter(?ricePolishingRate >= ${min})"."\n";
        }
        if ($max != '') {
          echo "filter(?ricePolishingRate <= ${max})"."\n";
        }
      }else {
        if ($iri == "fermentationMash") {
          echo "?s sk-make:MashingTimes / schema:value ?${iri}."."\n";
          $prefix = 'none';
        }else if ($iri == "fermentationStarter" || $iri == "pressing" || $iri == "ricePolishing" || $iri == "kojiMaking" || $iri == "storage") {
          echo "?s sk-make:makingMethod ?${iri}."."\n";
          $prefix = 'sk-make';
        }else {
          echo "?s schema:category ?${iri}."."\n";
          $prefix = 'sk-eval';
        }
        sameFilter($flt, $iri, $prefix);
      }
    }
  }
}

function addiCon($num) {      // 原料に対する絞り込み条件をクエリに反映
  if (isset($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      if (isset($_POST["min_${flt}"])) {
        $min = $_POST["min_${flt}"];
      }
      if (isset($_POST["max_${flt}"])) {
        $max = $_POST["max_${flt}"];
      }
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
      echo "?s sk-eval:${iri} / schema:minValue ?${ord}min;"."\n";
      echo "   sk-eval:${iri} / schema:maxValue ?${ord}max."."\n";
      echo "bind(((?${ord}min + ?${ord}max) / 2) as ?${ord}_value)"."\n";
      if ($min != '') {
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if ($max != '') {
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
      $count++;
    }
  }
  if (isset($_POST["i-target${num}"])) {      // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      switch ($iri) {
        case $_POST['ingredient']:
          $item = 'ing';
          break;
        case 'rice':
          echo '?s schema:material ?rice.'."\n";
          echo '{?rice a sk-prep:Rice.}'."\n";
          echo 'union {?rice a sk-prep:KojiRice.}'."\n";
          echo 'union {?rice a sk-prep:KakeRice.}'."\n";
          echo '?rice schema:name ?rice_name.'."\n";
          $item = 'rice_name';
          break;
        case 'yeast':
          echo '?s schema:material ?yeast.'."\n";
          echo '?yeast a sk-prep:Yeast;'."\n";
          echo '       schema:name ?yeast_name.'."\n";
          $item = 'yeast_name';
          break;
        case 'koji':
          echo '?s schema:material ?koji.'."\n";
          echo '?koji a sk-prep:SeedKoji;'."\n";
          echo '      schema:brand / schema:name ?koji_brand.'."\n";
          $item = 'koji_brand';
          break;
        case 'water':
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
      sameFilter($flt, $item, 'none');
    }
  }
  if (isset($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      if ($iri == 'ricePolishingRate') {
        echo '?s sk-make:ricePolishingRate / schema:value ?ricePolishingRate.'."\n";
        if (isset($_POST["min_${flt}"])) {
          $min = $_POST["min_${flt}"];
        }
        if (isset($_POST["max_${flt}"])) {
          $max = $_POST["max_${flt}"];
        }
        if ($min != '') {
          echo "filter(?${iri} >= ${min})"."\n";
        }
        if ($max != '') {
          echo "filter(?${iri} <= ${max})"."\n";
        }
      }else {
        if ($iri == 'fermentationMash') {
          echo "?s sk-make:MashingTimes / schema:value ?${iri}."."\n";
          $prefix = 'none';
        }else if ($iri == 'fermentationStarter' || $iri == 'pressing' || $iri == 'ricePolishing' || $iri == 'kojiMaking' || $iri == 'storage') {
          echo "?s sk-make:makingMethod ?${iri}."."\n";
          $prefix = 'sk-make';
        }else {
          echo "?s schema:category ?${iri}."."\n";
          $prefix = 'sk-eval';
        }
        sameFilter($flt, $iri, $prefix);
      }
    }
  }
}

function addmCon($num) {      // 製法に対する絞り込み条件をクエリに反映
  if (isset($_POST["p-target${num}"])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST["p-target${num}"]); $i++) {
      $flt = $_POST["p-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      if (isset($_POST["min_${flt}"])) {
        $min = $_POST["min_${flt}"];
      }
      if (isset($_POST["max_${flt}"])) {
        $max = $_POST["max_${flt}"];
      }
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
      echo "?s sk-eval:${iri} / schema:minValue ?${ord}min;"."\n";
      echo "   sk-eval:${iri} / schema:maxValue ?${ord}max."."\n";
      echo "bind(((?${ord}min + ?${ord}max) / 2) as ?${ord}_value)"."\n";
      if ($min != '') {
        echo "filter(?${ord}_value >= ${min})"."\n";
      }
      if ($max != '') {
        echo "filter(?${ord}_value <= ${max})"."\n";
      }
      $count++;
    }
  }
  if (isset($_POST["i-target${num}"])) {     // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST["i-target${num}"]); $i++) {
      $flt = $_POST["i-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      switch ($iri) {
        case 'rice':
          echo '?s schema:material ?rice.'."\n";
          echo '{?rice a sk-prep:Rice.}'."\n";
          echo 'union {?rice a sk-prep:KojiRice.}'."\n";
          echo 'union {?rice a sk-prep:KakeRice.}'."\n";
          echo '?rice schema:name ?rice_name.'."\n";
          $item = 'rice_name';
          break;
        case 'yeast':
          echo '?s schema:material ?yeast.'."\n";
          echo '?yeast a sk-prep:Yeast;'."\n";
          echo '       schema:name ?yeast_name.'."\n";
          $item = 'yeast_name';
          break;
        case 'koji':
          echo '?s schema:material ?koji.'."\n";
          echo '?koji a sk-prep:SeedKoji;'."\n";
          echo '      schema:brand / schema:name ?koji_brand.'."\n";
          $item = 'koji_brand';
          break;
        case 'water':
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
      sameFilter($flt, $item, 'none');
    }
  }
  if (isset($_POST["m-target${num}"])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST["m-target${num}"]); $i++) {
      $flt = $_POST["m-target${num}"][$i];
      $iri = substr($flt, 0, strlen($flt)-1);
      if ($iri == 'ricePolishingRate') {
        if (isset($_POST["min_${flt}"])) {
          $min = $_POST["min_${flt}"];
        }
        if (isset($_POST["max_${flt}"])) {
          $max = $_POST["max_${flt}"];
        }
        if ($iri == $_POST['manufacture']) {
          if ($min != '') {
            echo "filter(?value >= ${min})"."\n";
          }
          if ($max != '') {
            echo "filter(?value <= ${max})"."\n";
          }
        }else {
          echo "?s sk-make:${iri} / schema:value ?${iri}."."\n";
          if ($min != '') {
            echo "filter(?${iri} >= ${min})"."\n";
          }
          if ($max != '') {
            echo "filter(?${iri} <= ${max})"."\n";
          }
        }
      }else {
        if ($iri == 'fermentationMash') {
          $prefix = 'none';
          if ($iri == $_POST['manufacture']) {
            $item = 'value';
          }else {
            echo "?s sk-make:MashingTimes / schema:value ?${iri}."."\n";
            $item = $iri;
          }
        }else if ($iri == 'fermentationStarter' || $iri == 'pressing' || $iri == 'ricePolishing' || $iri == 'kojiMaking' || $iri == 'storage') {
          $prefix = 'sk-make';
          if ($iri == $_POST['manufacture']) {
            $item = 'mtd';
          }else {
            echo "?s sk-make:makingMethod ?${iri}."."\n";
            $item = $iri;
          }
        }else {
          $prefix = 'sk-eval';
          if ($iri == $_POST['manufacture']) {
            $item = 'categ';
          }else {
            echo "?s schema:category ?${iri}."."\n";
            $item = $iri;
          }
        }
        sameFilter($flt, $item, $prefix);
      }
    }
  }
}

function sameFilter($flt, $item, $prefix) {     // クエリの'='で表すフィルター処理
  $element = $_POST[$flt];
  echo 'filter(';
  for ($i=0; $i<count($element); $i++) {
    $value = $element[$i];
    if ($prefix != 'none') {      // IRIの場合
      echo "?${item} = ${prefix}:${value}";
    }else if (is_numeric($value)) {     // 数値の場合
      echo "?${item} = ${value}";
    }else {     // テキストの場合
      echo "?${item} = '${value}'";
    }
    if (isset($element[$i+1])) {
      echo ' || ';
    }
  }
  echo ')'."\n" ;
}

// グラフ描画
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
      echo 'アルコール度';
      break;
    default:
      break;
  }
}

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
    default:
      break;
  }
}

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
    default:
      break;
  }
}
?>
