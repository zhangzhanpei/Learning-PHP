<?php
//parent:指向父类，一般用来调用父类的构造函数
class BaseClass
{
    public function __construct()
    {
        echo '父类实例化';
    }
}

class SubClass extends BaseClass
{
    public function __construct()
    {
        parent::__construct();
        echo "<br>子类实例化";
    }
}

new SubClass();