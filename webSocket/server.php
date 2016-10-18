<?php
//创建服务
$serv = new swoole_websocket_server("0.0.0.0", 8080);

//所有客户端保存到数组
$clients = [];

//绑定open事件
$serv->on('Open', function ($server, $req) use (&$clients) {
    $clients[$req->fd] = 0;
    echo "客户端" . $req->fd . "加入\n";
});

//收到消息并处理
$serv->on('Message', function ($server, $frame) use (&$clients) {
    echo "message: " . $frame->data . "\n";
    foreach ($clients as $k => $c) {
        $server->push($k, $frame->data);
    }
});

//客户端关闭
$serv->on('Close', function ($server, $fd) use (&$clients) {
    unset($clients[$fd]);
    echo "客户端" . $fd . "关闭\n";
});

$serv->start();
