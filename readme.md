### 原生php搭建的博客
1. 用项目中的sql文件建立本地数据库
2. 配置apache，可参考网上教程
3. 将项目放置于apache目录下的htdos文件夹中
4. 修改lib/init.php文件,将数据改成自己本地的信息
```
    $option = array(
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'root',
        'dbname' => 'tndb',
        'port' => 3306,
        'charset' => 'utf8'
    );
```
4. 在浏览器中输入http://localhost:88/tnblog/index.php进行访问（此处本人设置的apache端口为88）