<?php
//创建数据库连接
try {
    $db = new PDO('mysql:host=localhost;dbname=db;', 'user', 'password');
} catch (PDOException $e) {
    die('连接数据库失败');
}

//查询数据
$sql = $db->prepare('select id, phone, nickName from users where id = ?');
$sql->execute([27]);

//打印数据
$row = $sql->fetchObject();
echo $row->id . '-->' . $row->phone . '-->' . $row->nickName . '<br>';

//关闭数据库连接
$db = null;
