<?php

require_once '../functions.php';

// recruiter, code, phone, face, contract
$type = 'phone';
$date = 'February 1, 2015';
$time = '9:00am';

$company = '';
$job_title = '';
$interviewer_name = '';
$interviewer_title = '';

// About the company
$interviews[] = new Interview([
    'title'  => 'About the company',
    'list'   => 'ul',
    'items'  => [
        '',
    ],
]);

// Why this job
$interviews[] = new Interview([
    'title'  => 'Why this job?',
    'list'   => 'ul',
    'items'  => [
        'Have transitioned to more of a front-end role at current company. Would like to continue here...',
        'Have lots of experience using technologies employed on your website: ',
        'Have some experience with similar JS frameworks: angularjs -> 2-way data binding, MVC',
        'Have a lot of experience building responsive websites',
        'Have 3+ years experience in an agency setting',
        'Lots of overlap between my skills and what you\'re looking for',
        'Have experience using the products you develop',
        'Have used the site: great UI... it really looks like you guys are doing something right',
        'Lots of existing software and loads of companies: sounds like a healthy business niche',
        'Mention of agile approach in job posting is a big plus',
        'Mentioned use of Jira in job posting is a big plus',
        'Sounds like a think-on-your-feet sort of position: favor dynamic work environments',
        'Not a customer-facing position',
        '',
    ],
]);

// Prepared questions
$interviews[] = new Interview([
    'class'  => 'qa',
    'title'  => 'Interview Questions',
    'list'   => 'ul',
    'items'  => [
        'Is this a new role? If not, where is the former employee?'                         => '',
        'Why did former employee move on?'                                                  => '',
        'How large is the development group?'                                               => '',
        'What challenges is the group facing right now?'                                    => '',
        'How are tasks distributed? Focus on team or individual work?'                      => '',
        'What sort of in-house products would I be working on?'                             => '',
        'How many products on offer? ...in the pipeline?'                                   => '',
        'How long is a typical dev (product/feature) cycle?'                                => '',
        'How agile are you?'                                                                => '',
        'How agile are you as an agency? Total BS or kinda BS?'                             => '',
        'How long are your sprints?'                                                        => '',
        'How long are your planning meetings, demos, and retrospectives?'                   => '',
        'Tell me about your current sprint. How many tasks/story points?'                   => '',
        'How often do you release?'                                                         => '',
        'What kind of version control (Git, SVN)?'                                          => '',
        'How do you deploy code?'                                                           => '',
        'How much of a startup are you? Do you expect the developer to work 60-hour weeks?' => '',
        'Any growing pains at personal level being bought by a larger firm'                 => '',
        'Do you have any lingering questions or concerns about my experience?'              => '',
        ''                                                                                  => '',
    ],
]);

// Interview aide
$interviews[] = new Interview([
    'status' => true,
    'class'  => 'aide',
    'title'  => 'Interview Aide',
    'list'   => '',
    'items'  => [
        '',
    ],
    'text'   => "

    ",
]);

// Notes
$interviews[] = new Interview([
    'text'   => "

    ",
]);

// Email communication
$interviews[] = new Interview([
    'class'  => 'email',
    'text'   => "
        May 1, 2015 - 1:00pm<br />
        <br />

    ",
]);

require_once '../render_interview.php';

?>
