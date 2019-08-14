<?php
$fd = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
echo 'q'.socket_connect($fd,'localhost',3000);
echo 'q'.socket_send($fd,'stop',strlen('stop'),MSG_OOB);
echo socket_recv($fd,$name,1024,0);
echo $name;

