<script type="text/javascript">
function checkProp() {      // 成分検索の入力チェック
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

function checkIng() {     // 原料検索の入力チェック
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

function checkMan() {     // 製法検索の入力チェック
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

/*
function checkOpt() {
  let opt = ['p-target[]', 'i-target[]', 'm-target[]'];
  let target = '';
  let check = '';
  let subcheck = '';
  for (var i = 0; i < opt.length; i++) {
    target = opt[i];
    check = document.getElementsByName(target);
    for (var j = 0; j < check.length; j++) {
      if (target == 'i-target[]') {
        subcheck = document.getElementsByName(check[j].value + '[]');
        let count = 0;
        for (var k = 0; k < subcheck.length; k++) {
          if (!subcheck[k].checked) {
            count++;
          }
          if (count == subcheck.length) {
            alert('絞り込み条件（原料）の選択が不十分です。');
            return false;
          }
        }
      }else if (target == 'p-target[]') {
        subcheck = document.getElementsByName('min_' + check[j].name);
      }
    }
  }
  return true;
}
*/

function Switch(checks) {      // 絞り込みコンテンツの表示切り替え
  let drop = '';
  let hide = document.getElementsByName(checks.name);     // checks.name = '()-target[]'
  for (var i = 0; i < hide.length; i++) {
    let display = document.getElementById(hide[i].value);
    if (hide[i].checked) {
      display.className = hide[i].value;
    }else if (!hide[i].checked) {
      display.className = 'hide';
      if (checks.name == 'i-target[]') {
        drop = document.getElementsByName(hide[i].value + '[]');
        offSelect(drop);
      }else if (checks.name == 'p-target[]') {
        drop = document.getElementsByName('min_' + hide[i].value);
        offNumber(drop);
        drop = document.getElementsByName('max_' + hide[i].value);
        offNumber(drop);
      }else if (checks.name == 'm-target[]') {
        drop = document.getElementsByName(hide[i].value + '[]');
        offSelect(drop);
      }
    }
  }
}

function offSelect(drop) {      // チェックボックスの選択解除
  for (var i = 0; i < drop.length; i++) {
    drop[i].checked = false;
  }
}

function offNumber(drop) {      // input numberの入力削除
  drop.value = '';
}

let sel = 0;
function offRadio(check, id) {      // ラジオボタンの選択解除
  if (sel == id) {
    let lift = document.getElementById(check.value);
    let drop = document.getElementsByName(check.value + '[]');
    check.checked = false;      // ラジオボタンのチェックを外す
    lift.className = 'hide';      // コンテンツ非表示
    sel = '';
    offSelect(drop);
  }else {
    sel = id;
  }
}


// ページ更新の度に実行
window.onload = () => {
  let it = document.getElementsByName('i-target[]');
  let pt = document.getElementsByName('p-target[]');
  let mt = document.getElementsByName('m-target[]');
  for (var i = 0; i < pt.length; i++) {     // 選択した絞り込み条件（成分）の再表示
    Switch(pt[i]);
  }
  for (var i = 0; i < it.length; i++) {     // 選択した絞り込み条件（原料）の再表示
    Switch(it[i]);
  }
  for (var i = 0; i < mt.length; i++) {     // 選択した絞り込み条件（製法）の再表示
    Switch(mt[i]);
  }
}
</script>


<?php
if (isset($_POST['init'])) {      // 検索条件の初期化
  $_POST = '';
}

function sCheck($type, $value) {      // チェックボックスの入力保持
  if (isset($_POST[$type]) && in_array($value, $_POST[$type])) {
    echo 'checked';
  }
}

function sRadio($type, $value) {      // ラジオボタンの入力保持
  if (isset($_POST[$type]) && $_POST[$type] == $value) {
    echo 'checked';
  }
}

function sNumber($value) {      // input numberの入力保持
  if (isset($_POST[$value])) {
    echo "value='${_POST[$value]}'";
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
      echo '            schema:category ?water_type.'."\n";
      echo 'bind(substr(str(?water_type), 28) as ?ing)'."\n";
      break;
    default:
      break;
  }
}

function man($target) {

}

function addpCon() {      // 成分に対する絞り込み条件をクエリに反映
  if (isset($_POST['p-target'])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST['p-target']); $i++) {
      $flt = $_POST['p-target'][$i];
      if (isset($_POST["min_${flt}"])) {
        $min = $_POST["min_${flt}"];
      }
      if (isset($_POST["max_${flt}"])) {
        $max = $_POST["max_${flt}"];
      }
      if ($flt == $_POST['x-target']) {
        $ord = 'x';
      }else if ($flt == $_POST['y-target']) {
        $ord = 'y';
      }else if ($count == 0) {
        $ord = 'fi';
      }else if ($count == 1){
        $ord = 'se';
      }
      if ($flt != $_POST['x-target'] && $flt != $_POST['y-target']) {
        echo "?s sk-eval:${flt} / schema:minValue ?${ord}min;"."\n";
        echo "   sk-eval:${flt} / schema:maxValue ?${ord}max."."\n";
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
  if (isset($_POST['i-target'])) {     // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST['i-target']); $i++) {
      $flt = $_POST['i-target'][$i];
      switch ($flt) {
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
          echo '       schema:category ?type.'."\n";
          echo 'bind(substr(str(?type), 28) as ?water_type)'."\n";
          $item = 'water_type';
          break;
        default:
          break;
      }
      sameFilter($flt, $item, 'none');
    }
  }
  if (isset($_POST['m-target'])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST['m-target']); $i++) {
      $flt = $_POST['m-target'][$i];
      if ($flt == 'ricePolishingRate') {
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
        if ($flt == 'fermentationMash') {
          echo "?s sk-make:MashingTimes / schema:value ?${flt}."."\n";
          $prefix = 'none';
        }else if ($flt == 'fermentationStarter' || $flt == 'pressing' || $flt == 'ricePolishing' || $flt == 'kojiMaking' || $flt == 'storage') {
          echo "?s sk-make:makingMethod ?${flt}."."\n";
          $prefix = 'sk-make';
        }else {
          echo "?s schema:category ?${flt}."."\n";
          $prefix = 'sk-eval';
        }
        sameFilter($flt, $flt, $prefix);
      }
    }
  }
}

function addiCon() {      // 原料に対する絞り込み条件をクエリに反映
  if (isset($_POST['p-target'])) {      // 成分のとる範囲で絞り込み
    $count = 0;
    for ($i=0; $i < count($_POST['p-target']); $i++) {
      $flt = $_POST['p-target'][$i];
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
      echo "?s sk-eval:${flt} / schema:minValue ?${ord}min;"."\n";
      echo "   sk-eval:${flt} / schema:maxValue ?${ord}max."."\n";
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
  if (isset($_POST['i-target'])) {      // 原料の種類で絞り込み
    for ($i=0; $i < count($_POST['i-target']); $i++) {
      $flt = $_POST['i-target'][$i];
      if ($flt == $_POST['ingredient']) {
        $item = 'ing';
      }else {
        switch ($flt) {
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
            echo '       schema:category ?type.'."\n";
            echo 'bind(substr(str(?type), 28) as ?water_type)'."\n";
            $item = 'water_type';
            break;
          default:
            break;
        }
      }
      sameFilter($flt, $item, 'none');
    }
  }
  if (isset($_POST['m-target'])) {      // 製法の種類で絞り込み
    for ($i=0; $i < count($_POST['m-target']); $i++) {
      $flt = $_POST['m-target'][$i];
      if ($flt == 'ricePolishingRate') {
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
        if ($flt == 'fermentationMash') {
          echo "?s sk-make:MashingTimes / schema:value ?${flt}."."\n";
          $prefix = 'none';
        }else if ($flt == 'fermentationStarter' || $flt == 'pressing' || $flt == 'ricePolishing' || $flt == 'kojiMaking' || $flt == 'storage') {
          echo "?s sk-make:makingMethod ?${flt}."."\n";
          $prefix = 'sk-make';
        }else {
          echo "?s schema:category ?${flt}."."\n";
          $prefix = 'sk-eval';
        }
        sameFilter($flt, $flt, $prefix);
      }
    }
  }
}

function addmCon() {
  
}

function sameFilter($flt, $item, $prefix) {     // クエリの'='で表すフィルター処理
  $element = $_POST[$flt];
  echo 'filter(';
  for ($i=0; $i<count($element); $i++) {
    $value = $element[$i];
    if ($prefix != 'none') {
      echo "?${item} = ${prefix}:${value}";
    }else if (is_numeric($value)) {
      echo "?${item} = ${value}";
    }else {
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
