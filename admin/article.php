<?php
    require './lib/admin_init.php';
    //article.php 完成对文章的各种处理

    $action = isset($_GET['a']) ? $_GET['a'] : '';

    if($action == 'list'){

        $sql = "SELECT t1.id, t1.state, t1.title, t1.create_ad, t2.title as cate_title FROM `tn_article` t1 LEFT JOIN `tn_category` t2 ON t1.category_id = t2.id";
        $article_list = $dao->fetchAll($sql);
        //检索出需要的文章

        require ADMIN_TEMPLATE_PATH . 'article_list.html';
    }else if($action == 'add'){
        //添加文章
        //编写sql语句
        $sql = "SELECT id, title FROM `tn_category`";
        $category_list = $dao->fetchAll($sql);

        require ADMIN_TEMPLATE_PATH . 'article_add.html';
    }else if($action == 'insert'){
        //首先得到用户的输入
        $category_id = empty($_POST['category_id']) ? '' : $_POST['category_id'];
        $title = empty($_POST['subject']) ? '' : $_POST['subject'];
        $content = empty($_POST['content']) ? '' : $_POST['content'];
        $user_id = $_SESSION['myuser']['id'];
        $create_ad = time();
        $summary = empty($_POST['summary']) ? '' : $_POST['summary'];
        $cover = empty($_POST['cover']) ? 'img/blgo-single.jpg' : $_POST['cover'];
        //当按钮有值，点击哪个按钮，就会得到哪个按钮值
        $state = empty($_POST['submit']) ? '' : $_POST['submit'];
        $is_delete = 0;
        $tags = '';
        //对数据进行校验
        if($category_id == '' || $title == '' || $content == '' || $summary == ''){
            //说明添加的数据有问题
            header('refresh:3;url=article.php?a=add');
            echo "你的添加数据有误，请重新填写";
            exit;
        }
        //入库
        $sql = "INSERT INTO `tn_article` VALUES(null, '$title', '$content', $user_id, $create_ad, '$summary', $category_id, '$cover', '$state', $is_delete, '$tags')";
        if($dao->query($sql)){
            header('location: article.php?a=list');
        }else{
            header('location: article.php?a=add');
            echo "添加错误";
            die;
        }
        //显示某个页面
    }else if($action == 'edit'){
        //获取文章分类
        $sql = "SELECT id, title FROM `tn_category`";
        $category_list = $dao->fetchAll($sql);

        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.')===false ? $_GET['id'] : '';
        if($id == ''){
            header('location: article.php?a=list');
            echo "修改的id号有误！";
            die;
        }

        //取出这个文章的数据
        $sql2 = "SELECT title, summary, content, tags FROM `tn_article` WHERE id=$id";

        //执行$sql
        $article = $dao->fetchRow($sql2);
        if($article != ''){
            //执行成功！回到显示所有分类列表的页面
            //引入模板并显示
            require ADMIN_TEMPLATE_PATH . 'article_edit.html';
        }else{
            //执行失败
            header('Location: category.php?a=list');
            echo "修改失败！";
            exit;
        }
    }else if($action == 'update'){
        //获取更新后的数据
        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.') === false ? $_GET['id'] : '';
        $category_id = empty($_POST['category_id']) ? '' : $_POST['category_id'];
        $title = empty($_POST['subject']) ? '' : $_POST['subject'];
        $summary = empty($_POST['summary']) ? '' : $_POST['summary'];
        $content = empty($_POST['content']) ? '' : $_POST['content'];

        if($id == ''){
            header('refresh: 3; url = category.php?a=list');
            echo "修改的id号有误";
            exit;
        }

        //简单的校验
        if($title == '' || $summary == '' || $content == ''){
            header('refresh: 3; url = article.php?a=edit');
            echo "你输入的数据有误！请重新输入";
            exit;
        }

        //更新数据到数据库
        $sql = "UPDATE `tn_article` SET title = '$title', category_id = $category_id, summary = '$summary', content = '$content' WHERE id = $id";
        if($dao->query($sql)){
            //执行成功！
            header('Location: article.php?a=list');
            exit;
        }else{
            //执行失败
            header('Location: article.php?a=edit');
            echo "更新失败，请重新输入信息";
            exit;
        }
    }else if($action == 'delete'){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.') === false ? $_GET['id'] : '';
        $sql = "DELETE FROM `tn_article` WHERE id = $id";
        if($dao->query($sql)){
            //执行成功！
            header('Location: article.php?a=list');
            exit;
        }else{
            //执行失败
            header('Location: article.php?a=list');
            echo "删除失败！";
            exit;
        }
    }
 ?>