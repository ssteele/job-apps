<?php

namespace SteveSteele\Interview;

use SteveSteele\Interview\Interview;

// Type: recruiter, code, phone, face, contract
$type = 'phone';
$date = 'April 21, 2015';
$time = '9:00am';

// Company details
$company = 'W2O Group';
$jobTitle = 'Senior DevOps Engineer';
$interviewerName = 'Bob';
$interviewerTitle = 'Super Senior DevOps Engineer';

// About the company
$interviews[] = new Interview([
    'title'  => 'About the company',
    'list'   => 'ul',
    'items'  => [
        '...stuff here',
    ],
]);

// Why this job
$interviews[] = new Interview([
    'title'  => 'Why this job?',
    'list'   => 'ul',
    'items'  => [
        '...stuff here',
    ],
]);

// Prepared questions
$interviews[] = new Interview([
    'class'  => 'qa',
    'title'  => 'Interview Questions',
    'list'   => 'ul',
    'items'  => [
        '...my answered question'   => '...their answer',
        '...my unanswered question' => '',
    ],
]);
