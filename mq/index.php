<?php
require_once "Task.php";

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

while (true) {
    $t = new Task('13822542983', time());//实例化一个任务
    $t = serialize($t);
    $redis->lpush('TaskList', $t);//把耗时任务放入队列
}
