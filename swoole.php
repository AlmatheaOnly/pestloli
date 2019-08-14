<?php
/*
$serv = new Swoole\Server('0.0.0.0', 3000, SWOOLE_BASE, SWOOLE_SOCK_TCP);
$serv->set([
    'reactor_num' => 2, //线程数
    'worker_num' => 4, //进程数
    'backlog' => 128, //排队个数
    'max_request' => 50, //单进程最大请求量
    'dispatch_mode' => 1, //
    'max_conn' => 1000, //最大连接
    'daemonize' => 1, //转入守护
    'open_cpu_affinity' => 1, //cpu亲和
    'open_tcp_nodelay' => 1, //开启 tcp_nodelay
    'heartbeat_check_interval' => 30 //每n秒去检测连接存活
]);
$serv->on('connect',function($serv,$fd){
    //$serv->send($fd,'connect ok');
});
$serv->on('receive',function($serv,$fd,$reactor_id,$data){
    $serv->send($fd,'Swoole'.$data);
    if($data == 'stop') {
        $serv->stop();
        $serv->shutdown();//平滑终止
    }
    if($data == 'close'){
        $serv->close();//终止连接
    }
});
$serv->on('close',function($serv,$fd){

});
$serv->start();
//$serv->exist();//检测fd是否存在
//getClientInfo()//getClientList()
//SIGTERM 安全终止服务
//SIGUSR1 安全终止主进程
*/

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';




$serv = new Swoole\WebSocket\Server('0.0.0.0',3000);

$serv->set([
    'enable_static_handler' => true,
    'document_root' => '/',
    'daemonize' => 0, //转入守护
]);


$serv->on('open', function ($ws, $request) {

});

//监听WebSocket消息事件
$serv->on('message', function ($ws, $frame) {
    $request = Illuminate\Http\Request::capture();
    $ws->push($frame->fd,var_dump($request));
    $ws->stop();
    $ws->shutdown();
});

//监听WebSocket连接关闭事件
$serv->on('close', function ($ws, $fd) {

});
$serv->start();

while(true){

}