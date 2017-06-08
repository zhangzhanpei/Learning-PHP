<?php
function callback($a, $b)
{
    echo "获取到参数{$a}, {$b}<br>";
}

//调用普通函数
call_user_func('callback', 1, 2); //第一个参数为调用的函数或方法, 区别就是参数是一个个的传进去还是一个数组传进去
call_user_func_array('callback', [3, 4]);


class Test
{
    public static function say($name, $age)
    {
        return "My name is {$name}, I'm {$age} years old!";
    }

    public function res()
    {
        return "Object method call";
    }
}

//调用静态方法
echo call_user_func('Test::say', 'zhangsan', 20);

//调用实例方法
$test = new Test();
echo call_user_func([$test, 'res']);
