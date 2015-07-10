<?php
/*PHP是不可以多继承的，但我们可以使用Traits来达到一个类中包含多个Traits的目标
 *Traits只能被类包含而不能直接实例化
 *trait其实就是class关键字改成trait而已，其他与类一致。trait中可以嵌套其他的trait
 */
trait Hello
{
    public function sayHello()
    {
        echo 'Hello world!';
    }
}

trait Fine
{
    public function sayFine()
    {
        echo "I'm fine!";
    }
}

//这里我们定义了一个类，包含上面的两个trait，可以实现类似多继承的效果
class Say
{
    use Fine, Hello;
}
$sh = new Say;
$sh->sayHello();
$sh->sayFine();
