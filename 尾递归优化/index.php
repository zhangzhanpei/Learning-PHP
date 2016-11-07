<?php
//计算整数n的阶乘
//普通递归方式
function factorial($n)
{
    if ($n == 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

//尾递归优化
//相比普通递归, 尾递归并不能降低时间复杂度, 但尾递归不会发生栈溢出, 是一种空间复杂度的优化
function factorial($n, $total = 1)
{
    if ($n == 1) {
        return $total;
    } else {
        return factorial($n - 1, $total * $n);
    }
}

//迭代
function factorial($n)
{
    $total = 1;
    for ($i = 1; $i <= $n; $i ++) {
        $total = $total * $i;
    }
    return $total;
}
