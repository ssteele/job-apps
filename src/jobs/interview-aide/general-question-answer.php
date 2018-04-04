<?php

namespace SteveSteele\Aide;

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    GENERAL INTERVIEW
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$general = [
    'title' => 'General Interview',
];

$general[] = new Question([
    'question' => 'About me',
    'answers'  => ['about-me-1', 'about-me-2', 'about-me-3', ],
]);

$general[] = new Question([
    'question' => 'Career Goals',
    'answers'  => ['career-goals', ],
]);

$general[] = new Question([
    'question' => 'Strength',
    'answers'  => ['science', 'learn-1', ],
]);

$general[] = new Question([
    'question' => 'Weakness',
    'answers'  => ['weakness-1', 'weakness-2', ],
]);

$general[] = new Question([
    'question' => 'Difficulies/Challenges',
    'answers'  => ['challenges-1', 'challenges-2', 'challenges-3', ],
]);

// $general[] = new Question([
//     'question' => 'Programming challenges',
//     'answers'  => ['program-challenge-1', 'program-challenge-2', ],
// ]);

$general[] = new Question([
    'question' => 'Motivation',
    'answers'  => ['motivation-1', 'motivation-2', ],
]);

$general[] = new Question([
    'question' => 'Rewarding',
    'answers'  => ['mesomodel-2', 'mesomodel-1', ],
]);

$general[] = new Question([
    'question' => 'Success',
    'answers'  => ['success-1', 'success-2', 'personal-dev-1', 'personal-dev-2', ],
]);

$general[] = new Question([
    'question' => 'Teamwork',
    'answers'  => ['bs-team-1', 'fg-team-1', 'w2o-team-1', 'w2o-team-2', 'pcs-team-1', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    PROFESSIONAL EXPERIENCE
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$experience = [
    'title' => 'Professional Experience',
];

$experience[] = new Question([
    'question' => 'Bite Squad',
    'answers'  => ['bs-1', ],
]);

$experience[] = new Question([
    'question' => 'FinanceGenius',
    'answers'  => ['fg-1', ],
]);

$experience[] = new Question([
    'question' => 'W2O Group',
    'answers'  => ['w2o-1', ],
]);

$experience[] = new Question([
    'question' => 'VM Foundry',
    'answers'  => ['vmf-1', ],
]);

$experience[] = new Question([
    'question' => 'Prison Call Solutions',
    'answers'  => ['pcs-team-1', 'pcs-1', 'cron-1', ],
]);

$experience[] = new Question([
    'question' => 'Adapt Training',
    'answers'  => ['adapt-1', 'adapt-2', 'adapt-3', ],
]);

$experience[] = new Question([
    'question' => 'The Greenwood School',
    'answers'  => ['greenwood', ],
]);

$experience[] = new Question([
    'question' => 'New Media Arc',
    'answers'  => ['new-media-arc', ],
]);

$experience[] = new Question([
    'question' => 'Mesoscale Model',
    'answers'  => ['mesomodel-1', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    MASTERS THESIS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$thesis = [
    'title' => 'Masters Thesis',
];

$thesis[] = new Question([
    'question' => 'Research',
    'answers'  => ['thesis-research', ],
]);

$thesis[] = new Question([
    'question' => 'Data',
    'answers'  => ['thesis-data', ],
]);

$thesis[] = new Question([
    'question' => 'Method',
    'answers'  => ['thesis-method', ],
]);

$thesis[] = new Question([
    'question' => 'Findings',
    'answers'  => ['thesis-findings-1', 'thesis-findings-2', ],
]);

$thesis[] = new Question([
    'question' => 'Conference Presentation',
    'answers'  => ['conference', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    TYPICAL INTERVIEW
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$typical = [
    'title' => 'Typical Interview',
];

$typical[] = new Question([
    'question' => 'Hobbies and Interests: What do you do for fun?',
    'answers'  => ['hobbies', 'travel', ],
]);

$typical[] = new Question([
    'question' => 'Salary Requirements',
    'answers'  => ['salary-1', 'salary-2', ],
]);


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//    INTERVIEW AIDE
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$aide = new Aide([
    'general'    => $general,
    'experience' => $experience,
    'thesis'     => $thesis,
    'typical'    => $typical,
]);
