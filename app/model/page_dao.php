<?php

require_once "dao.php";
require_once "page_entity.php";

/**
 * ページテーブル接続クラス
 */
class PageDAO extends DAO
{
    /** タイトル検索文字 */
    private $title = null;
    /** 取得件数制御数 */
    private $limit = 50;
    /** オフセット */
    private $offset = 0;

    /**
     * コンストラクタ
     */
    public function __construct ()
    {
        parent::__construct("wiki");       
    }

    /**
     * 検索
     */
    public function find ()
    {
        $params = array();

        $sql  = "select                                 ";
        $sql .= "  page.id as id,                       ";
        $sql .= "  namespace.canonical_ja as namespace, ";
        $sql .= "  page.title as title                  ";
        $sql .= "from                                   ";
        $sql .= "  page                                 ";
        $sql .= "join                                   ";
        $sql .= "  namespace                            ";
        $sql .= "on                                     ";
        $sql .= "  page.namespace_id = namespace.id     ";
        
        // タイトル文字指定がある場合曖昧検索を行う
        if (isset($this->title))
        {
            $sql .= "where title like :title ";
            $params[":title"] = array("val" => "%{$this->title}%", "type" => PDO::PARAM_STR);
        }
        
        // 取得件数制限を行う
        $sql .= "limit :limit ";
        $sql .= "offset :offset ";
        $params[":limit"] = array("val" => $this->limit, "type" => PDO::PARAM_INT);
        $params[":offset"] = array("val" => $this->offset, "type" => PDO::PARAM_INT);

        // 検索結果を取得し返却オブジェクトに置き換える
        $resultSet = parent::select($sql, $params);
        $pageEntityArray = Array();
        foreach($resultSet as $recode)
        {
            $pageEntity = new PageEntity();
            $pageEntity->id = $recode["id"];
            $pageEntity->namespace = $recode["namespace"];
            $pageEntity->title = $recode["title"];
            array_push($pageEntityArray, $pageEntity);
        }

        return $pageEntityArray;
    }

    /**
     * 総件数取得
     */
    public function count ()
    {
        $params = array();

        $sql  = "select               ";
        $sql .= "  count(1) as amount ";
        $sql .= "from                 ";
        $sql .= "  page               ";

        if (isset($this->title))
        {
            $sql .= "where title like :title ";
            $params[":title"] = array("val" => "%{$this->title}%", "type" => PDO::PARAM_STR);
        }

        $resultSet = parent::select($sql, $params);
        return $resultSet[0]["amount"];
    }


    public function setTitle ($text) {
        $this->title = $text;
    }
    
    public function setLimit ($limit) {
        $this->limit = $limit;
    }

    public function setOffset ($offset) {
        $this->offset = $offset;
    }

}

?>
