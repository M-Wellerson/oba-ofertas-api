<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host     = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

return [
    'connections' => [
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => $host,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    ]
];
