<?php

// Reqs
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/functions.php';
require_aide_classes();
require_interview_classes();

// Load aide
require_once route( [AIDE_PATH, 'aide.php'] );
