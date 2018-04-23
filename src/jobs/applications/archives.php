<?php

namespace SteveSteele\JobApp;

use SteveSteele\JobApp\Job;

/*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    ARCHIVED APPLICATIONS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*

Example of all options available

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '05.15.2018',
    'appDate'        => '05.16.2018',
    'title'          => 'DevOps Engineer',
    'company'        => 'W2O Group',
    'localPosting'   => true,
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'resume'         => true,
    'letter'         => true,
    'network'        => false,
    'headhunter'     => false,
    'interviews'     => [
        '06-01-2018' => 'recruiter',
        '06-06-2018' => 'code',
        '06-18-2018' => 'phone',
        '06-25-2018' => 'face',
        '06-30-2018' => 'contract',
    ],
]);

*/

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '04.15.2015',
    'appDate'        => '04.16.2015',
    'title'          => 'Senior DevOps Engineer',
    'company'        => 'W2O Group',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '05.05.2015',
    'appDate'        => '05.06.2015',
    'title'          => 'DevOps Engineer',
    'company'        => 'W2O Group',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'interviews'     => [
        '06-18-2015' => 'phone',
    ],
]);
