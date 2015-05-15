<?php

require_once 'functions.php';


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    JOB-SPECIFIC
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$company = 'COMPANY';
$job_title = 'JOB TITLE';
$interviewer_name = 'INTERVIEWER';
$interviewer_title = 'INTERVIEWER TITLE';

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



// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    GENERAL INTERVIEW
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$general = [
    'title' => 'General Interview',
];

$general[] = new Aide([
    'title' => 'About me',
    'items' => ['about-me', ],
]);

$general[] = new Aide([
    'title' => 'Career Goals',
    'items' => ['career-goals', ],
]);

$general[] = new Aide([
    'title' => 'Strength',
    'items' => ['science', 'learn-1', ],
]);

$general[] = new Aide([
    'title' => 'Weakness',
    'items' => ['weakness-1', 'weakness-2', ],
]);

$general[] = new Aide([
    'title' => 'Difficulies/Challenges',
    'items' => ['challenges-1', 'challenges-2', ],
]);

$general[] = new Aide([
    'title' => 'Programming challenges',
    'items' => ['program-challenge-1', 'program-challenge-2', ],
]);

$general[] = new Aide([
    'title' => 'Motivation',
    'items' => ['motivation-1', 'learn-2', 'motivation-2', ],
]);

$general[] = new Aide([
    'title' => 'Rewarding',
    'items' => ['mesomodel-2', 'mesomodel-1', 'learn-2', ],
]);

$general[] = new Aide([
    'title' => 'Success',
    'items' => ['success-1', 'success-2', 'personal-dev-1', 'personal-dev-2', ],
]);

$general[] = new Aide([
    'title' => 'Teamwork',
    'items' => ['w2o-team-1', 'w2o-team-2', 'pcs-team-1', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    PROFESSIONAL EXPERIENCE
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$experience = [
    'title' => 'Professional Experience',
];

$experience[] = new Aide([
    'title' => 'W2O Group',
    'items' => ['w2o-1', ],
]);

$experience[] = new Aide([
    'title' => 'VM Foundry',
    'items' => ['vmf-1', ],
]);

$experience[] = new Aide([
    'title' => 'Prison Call Solutions',
    'items' => ['pcs-team-1', 'pcs-1', 'cron-1', ],
]);

$experience[] = new Aide([
    'title' => 'Adapt Training',
    'items' => ['adapt-1', 'adapt-2', 'adapt-3', ],
]);

$experience[] = new Aide([
    'title' => 'The Greenwood School',
    'items' => ['greenwood', ],
]);

$experience[] = new Aide([
    'title' => 'New Media Arc',
    'items' => ['new-media-arc', ],
]);

$experience[] = new Aide([
    'title' => 'Mesoscale Model',
    'items' => ['mesomodel-1', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    MASTERS THESIS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$thesis = [
    'title' => 'Masters Thesis',
];

$thesis[] = new Aide([
    'title' => 'Research',
    'items' => ['thesis-research', ],
]);

$thesis[] = new Aide([
    'title' => 'Data',
    'items' => ['thesis-data', ],
]);

$thesis[] = new Aide([
    'title' => 'Method',
    'items' => ['thesis-method', ],
]);

$thesis[] = new Aide([
    'title' => 'Findings',
    'items' => ['thesis-findings-1', 'thesis-findings-2', ],
]);

$thesis[] = new Aide([
    'title' => 'Conference Presentation',
    'items' => ['conference', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    TYPICAL INTERVIEW
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$typical = [
    'title' => 'Typical Interview',
];

$typical[] = new Aide([
    'title' => 'Hobbies and Interests: What do you do for fun?',
    'items' => ['hobbies', 'travel', ],
]);

$typical[] = new Aide([
    'title' => 'Salary Requirements',
    'items' => ['salary-1', 'salary-2', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    INTERVIEW AIDE
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$aide = [
    'general'    => $general,
    'experience' => $experience,
    'thesis'     => $thesis,
    'typical'    => $typical,
];

require_once 'render_aide.php';

?>
