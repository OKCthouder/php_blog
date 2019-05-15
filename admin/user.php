<?php
    require './lib/admin_init.php';
    //user.php文件，这个文件处理用户业务

    //根据用户的请求，看看用户是请求验证，还是准备登录

    $action = isset($_GET['a']) ? $_GET['a'] : 'login';

    if($action == 'login'){
        require ADMIN_TEMPLATE_PATH . 'login.html';
    }else if($action == 'check'){

        //*************************
        //这里我暂时不到数据库验证
        //1.接收用户名和密码

        $username = empty($_POST['username']) ? '' : $_POST['username'];
        $password = empty($_POST['password']) ? '' : $_POST['password'];

        if($username == '' || $password == ''){
            echo '你输入的用户名和密码有误，重新输入！';
            //这里表示等待3秒，自动跳转到user.php这个页面，同时把a=login带给user.php
            header('refresh: 3;url=user.php?a=login');
            exit;
        }

        //2.到数据库验证
        //2.1验证流程是首先通过$username获取到数据库的密码
        //2.2将用户输入的密码和数据库中得到密码进行比较，如果相同则验证成功，否则密码错误
        //2.3如果从数据库中的不到密码，说明用户名错误

        //这里需要$dao对象
        $sql = "SELECT * FROM `tn_user` WHERE username = '$username'";
        if($user = $dao->fetchRow($sql)){
            //这里说明用户名存在，再比较密码
            if($user['password'] == md5($password)){
                //直接require首页面
                //将$user数组，保存到session
                //去除密码
                unset($user['password']);
                $_SESSION['myuser'] = $user;
                //跳转到管理页面
                require ADMIN_TEMPLATE_PATH . 'index.html';
            }else{
                //密码错误,重新回到登录界面
                header('refresh: 3;url=user.php?a=login');
                echo "你的密码或者用户名错误";
                exit;
            }
        }else{
            //用户名错误，重新回到登录界面
                header('refresh: 3;url=user.php?a=login');
                echo "你的用户名错误";
                exit;
        }

    }else if ($action == 'logout') {
            //用户注销登录
            header('refresh: 3;url=user.php?a=login');
        }
 ?>