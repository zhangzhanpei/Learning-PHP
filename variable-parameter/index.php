<?php
function add(...$args)
{
    $result = 0;
    foreach ($args as $arg) {
        $result += $arg;
    }
    echo $result;
}

//这里传入的参数个数是可以改变的
add(1, 2, 3, 4);

//也可以传入数组，...会展开数组为多个参数
$args = [1, 2, 3, 4];
add(...$args);
