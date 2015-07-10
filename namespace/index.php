<?php
namespace Test; //命名空间必须写在第一行

/*命名空间的目标是解决重名问题，因为如果两个类或函数重名，则产生一个致命错误。在5.3版本之前，所有的代码都运行在同一个空间下，
 *在引入别人的库时很容易命名冲突。使用命名空间后，即使是引入两个同名的类，也可以使用别名来区分
 */
//下面这个Hello类是属于Test空间下的
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
