<?php

namespace SteveSteele\JobApp\DocumentGenerator;

// http://shs.job-apps.com:8888/src/app/ajax/curl-html-posting.php

$response = [
    'status'   => 'success',
    'message'  => '',
];

$postVars = ['filePath', 'fileName', 'postUrl'];

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

$htmlPosting = new HtmlPosting($serverPath, $filePath, $fileName, $postUrl);
$isGeneratedMessage = $htmlPosting->generate();

if ('Document generated' !== $isGeneratedMessage) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $isGeneratedMessage;
    echo json_encode($response);
    die();
}

$response['message'] = $isGeneratedMessage;

echo json_encode($response);
die;
