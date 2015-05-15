<?php

$last_search = '05.15.2015';
$applications = [];

include_once 'archives.php';

/*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    APPLICATIONS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*

Example of all options available

$jobs[] = Job::create([
    'status'         => 'rejected',
    'search_date'    => '05.15.2015',
    'app_date'       => '05.16.2015',
    'title'          => 'DevOps Engineer',
    'company'        => 'W2O Group',
    'local_posting'  => true,
    'public_posting' => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'resume'         => true,
    'letter'         => true,
    'network'        => false,
    'headhunter'     => false,
    'interviews'     => [
        '06-01-2015' => 'recruiter',
        '06-06-2015' => 'code',
        '06-18-2015' => 'phone',
        '06-25-2015' => 'face',
        '06-30-2015' => 'contract',
    ],
]);

*/

$jobs[] = Job::create([
    'status'         => 'potential',
    'search_date'    => '05.15.2015',
    'title'          => 'Junior DevOps Engineer',
    'company'        => 'W2O Group',
    'public_posting' => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);

/*

Default new application

$jobs[] = Job::create([
    'status'         => 'potential',
    'search_date'    => '.2015',
    'title'          => '',
    'company'        => '',
    'public_posting' => '',
]);

*/


/*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    USEFUL META
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

$links = [
    'steve-steele.com' => 'http://steve-steele.com/cv/',
    'Interview Aide'   => 'interviews/aide.php',
];

$list = [
    'Indeed (Laravel)' => 'http://www.indeed.com/jobs?q=%22PHP%22+Laravel+-Java+-.Net+-C+-C%2B%2B+-C%23+-designer&l=Austin%2C+TX&sort=date',
];

$companies = [
    'Google' => 'https://www.google.com/about/careers/search#t=sq&q=j&jl=Kirkland%2CWA%26jl%3DSeattle%2CWA&jc=SOFTWARE_ENGINEERING',
];

?>
