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
    'status'         => 'rejected',
    'searchDate'     => '07.12.2014',
    'appDate'        => '07.14.2014',
    'title'          => 'JOB POSITION',
    'company'        => 'COMPANY',
    'localPosting'   => true,
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'resume'         => true,
    'letter'         => true,
    'network'        => false,
    'headhunter'     => false,
    'interviews'     => [
        '07-01-2014' => 'recruiter',
        '07-06-2014' => 'code',
        '07-18-2014' => 'phone',
        '07-25-2014' => 'face',
        '07-31-2014' => 'contract',
    ],
]);

*/

$jobs[] = Job::create([
    'status'         => 'rejected',
    'searchDate'     => '04.15.2015',
    'title'          => 'Senior DevOps Engineer',
    'company'        => 'W2O Group',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'interviews'     => [
        '04-21-2015' => 'phone',
    ],
]);

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '05.05.2015',
    'title'          => 'DevOps Engineer',
    'company'        => 'W2O Group',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);
