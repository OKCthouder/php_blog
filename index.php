<?php
    //这里是显示首页的php文件

    require './lib/init.php';

    //接受到cat_id
    $cat_id = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) && !strpos($_GET['cat_id'], '.') ? $_GET['cat_id'] : '';

    $where = " state = 'publish' ";

    //如果$cat_id != ''说明，用户希望按某个分类显示
    if($cat_id != ''){
        $where .= " AND category_id = $cat_id ";
    }

    //这个是sql语句，这里凭借了$where
    $sql = "SELECT id, title, summary, create_ad, cover, tags, user_id FROM `tn_article` WHERE $where";

    //获取所有的文章
    $article_list = $dao->fetchAll($sql);

    //取出分类信息
    $sql = 'SELECT * FROM `tn_category`';
    //执行sql
    $category_list = $dao->fetchAll($sql);

    //现在把$article_list的文章内容都显示到index.php页面
    require TMP_PATH . 'index.html';

 ?>