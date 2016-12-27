<?php
//创建数据库连接
$mysqli = new mysqli('localhost', 'user', 'password', 'db');
if (mysqli_connect_errno()) {
    die('连接数据库失败');
}

//查询数据
$sql = "select id, phone, nickName from users order by id desc";
$res = $mysqli->query($sql);
if (!$res->num_rows) {
    die('没有查询到数据');
}

//打印数据
while ($row = $res->fetch_object()) {
    echo $row->id . '-->' . $row->phone . '-->' . $row->nickName . '<br>';
}

//关闭数据库连接
$mysqli->close();
