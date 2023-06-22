<?php

$server = $_SERVER;
$uri = $server['REQUEST_URI'];

// world's crappest ever router

// @route /hello/{name}
if (\preg_match('#^\/hello\/(?<name>\w+)$#', $uri, $matches)) {
    $data = [
        'result' => 'success',
        'message' => 'Hello, ' . $matches['name'],
    ];
} elseif ($uri === '/tests/pact-state-setup') {
    $data = [
        'state' => true
    ];
} else {
    \header('HTTP/1.1 404 Not Found');
    $data = ['error' => 'HTTP/1.1 404 Not Found'];
}


\header('Content-Type: application/json');
echo \json_encode($data);
exit;

