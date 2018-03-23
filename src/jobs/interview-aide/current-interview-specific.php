<?php

namespace SteveSteele\Aide;

use SteveSteele\Interview\Interview;

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    JOB-SPECIFIC
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Company details
$company = 'COMPANY';
$jobTitle = 'JOB TITLE';
$interviewerName = 'INTERVIEWER';
$interviewerTitle = 'INTERVIEWER TITLE';

// About the company
$interviews[] = new Interview([
    'title'  => 'About the company',
    'list'   => 'ul',
    'items'  => [
        'They\'re just the greatest company',
    ],
]);

// Why this job
$interviews[] = new Interview([
    'title'  => 'Why this job?',
    'list'   => 'ul',
    'items'  => [
        'Well, for a bunch of reasons I suppose...',
    ],
]);

// Prepared questions
$interviews[] = new Interview([
    'class'  => 'qa',
    'title'  => 'Interview Questions',
    'list'   => 'ul',
    'items'  => [
        'Is this a new role? If not, where is the former employee?'            => '',
        'Why did former employee move on?'                                     => '',
        'How are tasks distributed? Focus on team or individual work?'         => '',
        'What sort of in-house products would I be working on?'                => '',
        'What kind of version control (Git, SVN)?'                             => '',
        'How do you deploy code?'                                              => '',
        'Are you agile? How much?'                                             => '',
        'How long are your sprints?'                                           => '',
        'How often do you release?'                                            => '',
        'Do you have any lingering questions or concerns about my experience?' => '',
    ],
]);
