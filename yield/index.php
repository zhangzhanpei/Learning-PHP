<?php
//迭代器，每次只返回一个元素，而不是创建个大数组一次返回
//例如下面的读取文件，每次只返回一行，而不是将整个文件都一次性读入内存
function getLines($file)
{
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            yield $line;
        }
    } finally {
        fclose($f);
    }
}

foreach (getLines("file.txt") as $n => $line) {
    echo $line;
}
