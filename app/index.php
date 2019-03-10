<?php
// import
require_once 'model/page_dao.php';
require_once 'model/page_entity.php';

$pageEntityArray = [];
$amount = 0;
$prev = $next = false;

if (!empty($_GET['display']))
{
    // クエリパラメータの取得
    $title = $_GET['title'];
    $display = intval($_GET['display']);
    $offset = intval($_GET['offset']);

    // データアクセスオブジェクトセットアップ
    $dao = new PageDAO();
    if (!empty($title))
    {
        $dao->setTitle($title);
    }
    $dao->setLimit($display);
    $dao->setOffset($offset * $display);

    // 検索結果取得
    $pageEntityArray = $dao->find();
    $amount = $dao->count();
    // ページングアイコン表示制御
    $prev = $offset != 0;
    $next = (($offset + 1) * $display) <= intval($amount);
}

include 'view/top.php';

?>