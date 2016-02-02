<?php
//关键字self：指向类自身，一般用来访问类自身的静态属性
class Test
{
    private static $foo = 'Hello World.';

    public function getFoo()
    {
        echo self::$foo;
    }

    public static function getBar()
    {
        echo 'getBar';
    }
}

$t = new Test();
$t->getFoo();

//静态方法可以直接类访问，也可以对象访问
$t->getBar();
Test::getBar();