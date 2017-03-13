<?php

// internal application fallback
if (! defined('APP_URL')) {
    define('APP_URL', 'http://shs.job-apps.com:8888/');
}

// internal application constants
const APP_PATH = 'src/app/';
const JOBS_PATH = 'src/jobs/';

// internal application derived
define('INTERVIEW_PATH', APP_PATH . 'interview/');
define('AIDE_PATH', APP_PATH . 'interview-aide/');
define('JOBS_URL', APP_URL . 'src/jobs/');
define('JOBS_RESUMES_PATH', JOBS_PATH . 'resumes/');
define('JOBS_COVER_LETTERS_PATH', JOBS_PATH . 'cover-letters/');
define('JOBS_POSTINGS_PATH', JOBS_PATH . 'postings/');
define('JOBS_INTERVIEWS_PATH', JOBS_PATH . 'interviews/');
