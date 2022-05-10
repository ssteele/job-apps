<?php

namespace SteveSteele\JobApp\DocumentGenerator;

// http://shs.job-apps.com:8888/src/app/ajax/generate-php-document.php

$response = [
    'status'   => 'success',
    'message'  => '',
];

$postVars = ['filePath', 'fileName'];

// Cut off direct access
if ('POST' !== $_SERVER['REQUEST_METHOD'] || empty($_POST[$postVars[0]]) || empty($_POST[$postVars[1]])) {
    $response['status'] = 'invalid';
    $response['message'] = 'Invalid request: incomplete payload';
    echo json_encode($response);
    die();
}

$serverPath = $_SERVER['DOCUMENT_ROOT'];
require_once $serverPath . '/src/app/functions.php';

// Grab the post variables
foreach ($postVars as $p) {
    $$p = sanitizeInput($_POST[$p], 's');
}

$phpDocument = new PhpDocument($serverPath, $filePath, $fileName);
$isGeneratedMessage = $phpDocument->generate();

if ('Document generated' !== $isGeneratedMessage) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $isGeneratedMessage;
} else {
    $response['message'] = $isGeneratedMessage;
}

echo json_encode($response);
die;
