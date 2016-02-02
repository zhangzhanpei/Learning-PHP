<?php
//this指向当前对象
class Test
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    //当对象调用了getName方法，则this指向该对象
    public function getName()
    {
        echo $this->name;
    }
}

$t1 = new Test('XiaoLi');
$t1->getName();//echo $t1->name

$t2 = new Test('LiLei');
$t2->getName();//echo $t2->name