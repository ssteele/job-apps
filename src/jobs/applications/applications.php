<?php

namespace SteveSteele\JobApp;

use SteveSteele\JobApp\Job;

/*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    APPLICATIONS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*

Example of all options available

$jobs[] = Job::create([
    'status'         => 'rejected',
    'searchDate'     => '05.15.2015',
    'appDate'        => '05.16.2015',
    'title'          => 'DevOps Engineer',
    'company'        => 'W2O Group',
    'localPosting'   => true,
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
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

$lastSearch = '05.15.2015';

$jobs[] = Job::create([
    'status'         => 'potential',
    'searchDate'     => '05.15.2015',
    'title'          => 'Junior DevOps Engineer',
    'company'        => 'W2O Group',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);

/*

Default new application

$jobs[] = Job::create([
    'status'         => 'potential',
    'searchDate'     => '.2015',
    'title'          => '',
    'company'        => '',
    'publicPosting'  => '',
]);

*/