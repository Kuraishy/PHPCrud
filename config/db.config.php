<?php

// "host" => "db", // {docker container's name} Worked
// "host" => "172.22.112.1", // {some docker IP through ipconfig - may change on every instance - usually something like 172.x.x.x} Worked
// "host" => "127.0.0.1", // SQLSTATE[HY000] [2002] Connection refused
// "host" => "docker.host.internal", //  SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo failed: Name does not resolve
// "host" => "localhost", //  SQLSTATE[HY000] [2002] No such file or directory


return [
    //'host' => '127.0.0.1',
    'host' => 'database', //using docker container name
    'port' => 3306,
    'dbname' => 'php_database',
    'username' => 'root',
    'password' => 'password',
];

// 'mysql' => array(
//         'driver'    => 'mysql',
//         'host'      => '127.0.0.1',
//         'port'      => '8889',
//         'database'  => 'databaseName',
//         'username'  => 'root',
//         'password'  => 'root',
//         'charset'   => 'utf8',
//         'collation' => 'utf8_unicode_ci',
//         'prefix'    => '',
//     ),