<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false, //跳过证书检查
        "verify_peer_name"=>false,
    ),
);  
$response = file_get_contents("https://www.random.org/sequences/?min=1&max=52&col=1&format=plain&rnd=new", false, stream_context_create($arrContextOptions));
$response = explode("\n", rtrim($response, "\n"));
echo "<pre>";
var_dump($response);
echo "</pre>";

//文档地址 https://www.random.org/clients/http/