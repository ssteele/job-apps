<?php

// Reqs
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/functions.php';
require_interview_classes();

// Load aide
require_once route( [INTERVIEW_PATH, 'interviews.php'] );
