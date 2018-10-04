<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn(){
  $dbname='gs_f01_db15';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

// テーブル名
$table = 'gs_bm_table';
$user_table = 'gs_user_table'; 

//SQL処理エラー
function errorMsg($stmt){
  $error = $stmt->errorInfo();
  exit('ErrorQuery:'.$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//SESSIONチェック＆リジェネレイト
function chk_ssid(){
  if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()){
    exit('Login Error.');
  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

// menuを決める
 function menu(){
    $menu = '<a class="navbar-brand" href="select.php">ブックマーク管理</a><a class="navbar-brand" href="index.php">ブックマーク登録</a>';
    if($_SESSION['kanri_flg']!=0){
    $menu .='<a class="navbar-brand" href="user_select.php">ユーザー管理</a><a class="navbar-brand" href="user_index.php">ユーザー登録</a>';
    }
      $menu .='<a class="navbar-brand" href="logout.php">ログアウト</a>';
    return $menu;
 }

?>