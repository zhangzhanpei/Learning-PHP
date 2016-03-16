<?php
require_once "Task.php";//unserialize反序列化字符串成Task对象前，要先引入Task.php类定义
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

while (true) {
    $task = $redis->brpop('TaskList', 0);//从队尾取出一个Task
    $task = unserialize($task[1]);
    fwrite(STDOUT, '号码:' . $task->tel . "内容:". $task->content ."\n");//执行任务
}
