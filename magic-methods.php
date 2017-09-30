<?php
class Test
{
    //读取不可访问属性的值时 __get() 会被调用
    public function __get(string $key)
    {
        echo 'get';
    }

    //在给不可访问属性赋值时 __set() 会被调用
    public function __set(string $key, $val)
    {
        echo 'set';
    }

    //当直接 echo 或 print 一个对象时 __toString() 会被调用
    public function __toString()
    {
        echo 'toString';
    }

    //当对象被当做函数使用时 __invoke() 会被调用
    public function __invoke()
    {
        echo 'invoke';
    }

    //在对象中调用一个不可访问方法时 __call() 会被调用
    public function __call(string $method, array $args)
    {
        var_dump($method, $args);
    }

    //在静态上下文中调用一个不可访问方法时 __callStatic() 会被调用
    public static function __callStatic(string $method, array $args)
    {
        var_dump($method, $args);
    }
}

$t = new Test('Zhnagsan', 20);
echo $t; //__toString
$t(); //__invoke
$t->run(1); //__call
Test::run(2); //__callStatic
$t->name = 'Jack'; //__set
echo $t->name; //__get
