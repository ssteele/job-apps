<?php

namespace SteveSteele\Interview;

use SteveSteele\Interview\Interview;

// Type: recruiter, code, phone, person, committee, contract
$type = 'phone';
$date = 'May 20, 2018';
$time = '9:00am';

// Company details
$company = '';
$jobTitle = '';
$interviewerName = '';
$interviewerTitle = '';

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
        'Have a background in science - I\'m excited to be back',
        'Have transitioned to more of a front-end role at current company. Would like to continue here',
        'Have 3+ years experience in an agency setting',
        'And another 3+ years experience in a software setting: really enjoy that collaboration',
        'Have some experience with similar JS frameworks: angularjs -> 2-way data binding, MVC',
        'Have a lot of experience building responsive websites',
        'Have experience with multisite and localization',
        'Favor unit testing and abiding by SOLID principles',
        'Lots of overlap between my skills and what you\'re looking for: ',
        'Also have a bunch of the nice-to-haves mentioned in the job posting: ',
        'Have lots of experience using technologies employed on your website: ',
        'Have experience using the products you develop',
        'Have used the site: great UI - it really looks like you guys are doing something right',
        'Lots of existing software and loads of companies: sounds like a healthy business niche',
        'Mention of agile approach in job posting is a big plus',
        'Mentioned use of Jira in job posting is a big plus',
        'Sounds like a think-on-your-feet sort of position: favor dynamic work environments',
        'Worked in Fintech at FinanceGenius - Loan Origination Software',
        'Have experience integrating with an SAP/ERP system',
        'Have experience working remotely',
        'It sounds like a product I can believe in',
    ],
]);

// Prepared questions
$interviews[] = new Interview([
    'class'  => 'qa',
    'title'  => 'Interview Questions',
    'list'   => 'ul',
    'items'  => [
        'Are you an internal recruiter?'                                                    => '',
        'Is this a new role? If not, where is the former employee?'                         => '',
        'Do you allow work from home?'                                                      => '',
        'What is the tech stack I would be working in?'                                     => '',
        'What is the funding situation?'                                                    => '',
        'How much of a startup are you? Do you expect the developer to work 60-hour weeks?' => '',
        'How large is the development group?'                                               => '',
        'What challenges is the group facing right now?'                                    => '',
        'How are tasks distributed? Focus on team or individual work?'                      => '',
        'What sort of products would I be working on?'                                      => '',
        'How long is a typical dev (product/feature) cycle?'                                => '',
        'Do you practice agile?'                                                            => '',
        'What is your bugs to features ratio for a typical sprint/iteration?'               => '',
        'How long are your sprints/iterations?'                                             => '',
        'How long are your planning meetings, demos, and retrospectives?'                   => '',
        'Tell me about your current sprint/iteration. How many tasks/story points?'         => '',
        'What kind of version control (Git, SVN)?'                                          => '',
        'How do you deploy code?'                                                           => '',
        'How often do you release?'                                                         => '',
        'Any growing pains at personal level being bought by a larger firm'                 => '',
        'Do you have any lingering questions or concerns about my experience?'              => '',
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
        <p>
            Notes
        </p>
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
