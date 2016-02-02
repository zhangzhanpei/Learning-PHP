<?php
//final：如果类声明为final，则不能被继承。如果方法声明为final，则子类中不能覆盖该方法

// final class BaseClass
class BaseClass
{
    //final public function show()
    public function show()
    {
        echo '父类';
    }
}

class SubClass extends BaseClass
{
    public function show()
    {
        echo "子类";
    }
}

$sc = new SubClass();
$sc->show();