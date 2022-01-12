<?php

require_once('component/user_manage.php');
require_logined_session();



// セッション用Cookieの破棄
setcookie(session_name(), '', 1);
// セッションファイルの破棄
session_destroy();
// ログアウト完了後にホームに遷移
header('Location: ./');

?>
