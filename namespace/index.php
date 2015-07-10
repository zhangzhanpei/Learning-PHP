<?php
namespace Test; //命名空间必须写在第一行

//命名空间的目标是解决重名问题，因为如果两个类或函数重名，则产生一个致命错误

class Hello
{
    public function __construct()
    {
        echo '命名空间测试！！';
    }
}

//需要使用某个命名空间下的类时，可以[全路径引用]或者[use]
//[全路径引用]
$h = new \Test\Hello;

//[use]
use Test\Hello;
$h = new Hello;
