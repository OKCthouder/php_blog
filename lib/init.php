<?php
    header("content-type:text/html;charset=utf8");

    //这个文件是init.php,完成初始化工作

    //定义网站的根目录
    define('ROOT_PATH', dirname(__DIR__). '/');
    //定义lib目录
    define('LIB_PATH', ROOT_PATH . 'lib/');
    //定义template目录
    define('TMP_PATH', ROOT_PATH . 'template/');

    $option = array(
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'root',
        'dbname' => 'tndb',
        'port' => 3306,
        'charset' => 'utf8'
    );
    //引入DAOMySQLi.class.php文件
    require LIB_PATH . 'DAOMySQLi.class.php';

    $dao = DAOMySQLi::getSingleton($option);


 ?>