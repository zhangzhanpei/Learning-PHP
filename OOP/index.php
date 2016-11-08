<?php
namespace OOP;

class Foo
{
    public function __construct()
    {
        //魔术常量
        echo '当前类名' . get_class() . "<br>";
        echo '当前类名' . __CLASS__ . "<br>";
        echo '当前命名空间' . __NAMESPACE__ . "<br>";
        echo '当前路径' . __DIR__ . "<br>";
        echo '当前文件' . __FILE__ . "<br>";
        echo '当前行' . __LINE__ . "<br>";
        echo '当前函数' . __FUNCTION__ . "<br>";
        echo '当前方法' . __METHOD__ . "<br>";
    }
}

$f = new Foo;
