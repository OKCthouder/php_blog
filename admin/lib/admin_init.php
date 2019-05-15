<?php
    header("content-type:text/html;charset=utf-8");
    //编写一个admin_init.php文件，完成初始化任务
    
    //这里先定义管理后台的根目录
    define('ADMIN_ROOT_PATH', dirname(__DIR__) . '/');
    define('ADMIN_LIB_PATH', ADMIN_ROOT_PATH . 'lib/');
    //后台的模板目录
    define('ADMIN_TEMPLATE_PATH', ADMIN_ROOT_PATH . 'template/');

    //创建我们的$dao对象
    require ADMIN_LIB_PATH . 'DAOMySQLi.class.php';
    $option = array(
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'root',
        'dbname' => 'tndb',
        'port' => 3306,
        'charset' => 'utf8'
        );
    $dao = DAOMySQLi::getSingleton($option);

    $request_filename = basename($_SERVER['SCRIPT_FILENAME']);

    //统一开启session_start();
    session_start();

    /*
        深度转义数组
     */
    function deepEscape($input) {
        foreach($input as $key => $value){
            if(is_array($value)){
                $input[$key] = deepEscape($value);
            }else{
                $input[$key] = addslashes($value);
            }
        }
        return $input;
    }

    $_GET = deepEscape($_GET);
    $_POST = deepEscape($_POST);
 ?>