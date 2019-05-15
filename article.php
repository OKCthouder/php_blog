<?php

    require './lib/init.php';
    //接受article传递的$id
    //校验 整数
    $id = is_numeric($_GET['id']) && !strpos($_GET['id'], '.') ? $_GET['id'] : '';

    if($id == ''){
        echo "你输入的id有误";
        exit;
    }

    //组织$sql
    $sql = "SELECT id, title, content, create_ad, summary, cover, tags, user_id FROM `tn_article` WHERE id=$id";

    //执行这个语句
    $article = $dao->fetchRow($sql);

    //引入模版，并显示
    require TMP_PATH . 'article.html';
 ?>