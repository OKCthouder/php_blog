<?php
    //引入admin.init.php
    require './lib/admin_init.php';

    //分类的操作。
    $action = isset($_GET['a']) ? $_GET['a'] : 'list';
    if($action == 'list'){

        //这里没有$user，因此，我们看的category_list.html信息不争取
        //引入category_list.html
        //解决一个问题，显示所有的分类信息
        //先查询一些tn_catefory表，取出所有的分类下
        $sql= 'SELECT * FROM `tn_category`';
        $category_list = $dao->fetchAll($sql);

        //解决第二个问题-在页面中正确的显示用户的信息->如果可以

        require ADMIN_TEMPLATE_PATH . 'category_list.html';
    }else if($action == 'add'){
        //如果用户是准备添加
        //引入我们的添加模版
        require ADMIN_TEMPLATE_PATH . 'category_add.html';
    }else if($action == 'insert'){
        //插入分类信息
        //接收
        $title = empty($_POST['title']) ? '' : $_POST['title'];
        $order_number = isset($_POST['order_number']) && is_numeric($_POST['order_number']) && !strpos($_POST['order_number'], '.') ? $_POST['order_number'] :'';

        //简单的校验
        if($title == '' || $order_number == ''){
            header('refresh: 3; url = category.php?a=add');
            echo "你输入的数据有误！请重新输入";
            exit;
        }
        //真正的插入数据到数据库（入库）
        $sql = "INSERT INTO `tn_category` VALUES(null, '$title', '$order_number')";
        //执行$sql
        if($dao->query($sql)){
            //执行成功！回到显示所有分类列表的页面
            header('Location: category.php?a=list');
            exit;
        }else{
            //执行失败
            header('Location: category.php?a=add');
            echo "添加失败，请重新添加";
            exit;
        }
    }else if($action == 'edit'){
        //获取这个分类的数据
        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.') === false ? $_GET['id'] : '';

        if($id == ''){
            header('refresh: 3; url = category.php?a=list');
            echo "修改的id号有误";
            exit;
        }
        //根据id取得文章的信息
        $sql = "SELECT title, order_number FROM `tn_category` WHERE id=$id";
        //执行$sql
        $row = $dao->fetchRow($sql);
        if($row != ''){
            //执行成功！回到显示所有分类列表的页面
            //引入模板并显示
            require ADMIN_TEMPLATE_PATH . 'category_edit.html';
        }else{
            //执行失败
            header('Location: category.php?a=list');
            echo "修改失败！";
            exit;
        }
    }else if($action == 'update'){
        //获取更新后的数据
        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.') === false ? $_GET['id'] : '';

        if($id == ''){
            header('refresh: 3; url = category.php?a=list');
            echo "修改的id号有误";
            exit;
        }
        $title = empty($_POST['title']) ? '' : $_POST['title'];
        $order_number = isset($_POST['order_number']) && is_numeric($_POST['order_number']) && !strpos($_POST['order_number'], '.') ? $_POST['order_number'] :'';

        //简单的校验
        if($title == '' || $order_number == ''){
            header('refresh: 3; url = category.php?a=add');
            echo "你输入的数据有误！请重新输入";
            exit;
        }

        //更新数据到数据库
        $sql = "UPDATE `tn_category` SET title = '$title', order_number = $order_number WHERE id = $id";
        if($dao->query($sql)){
            //执行成功！
            header('Location: category.php?a=list');
            exit;
        }else{
            //执行失败
            header('Location: category.php?a=edit');
            echo "更新失败，请重新输入信息";
            exit;
        }
    }else if($action == 'delete'){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) && strpos($_GET['id'], '.') === false ? $_GET['id'] : '';
        $sql = "DELETE FROM `tn_category` WHERE id = $id";
        if($dao->query($sql)){
            //执行成功！
            header('Location: category.php?a=list');
            exit;
        }else{
            //执行失败
            header('Location: category.php?a=list');
            echo "删除失败！";
            exit;
        }
    }
 ?>