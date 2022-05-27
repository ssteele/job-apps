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
    'searchLink'     => 'Larajobs',
    'recruiter'      => 'Some Agency',
    'company'        => 'W2O Group',
    'title'          => 'DevOps Engineer',
    'role'           => 'contributor',
    'location'       => 'remote',
    'localPosting'   => true,
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'tags'           => ['php', 'javascript', 'api', 'agile'],
    'resume'         => true,
    'letter'         => true,
    'headhunter'     => false,
    'network'        => false,
    'salary'         => '',
    'interviews'     => [
        '06-01-2018' => ['recruiter' => 'hold'],
        '06-06-2018' => ['code' => 'prep'],
        '06-18-2018' => ['phone' => 'wait'],
        '06-25-2018' => ['person' => 'done'],
        '06-26-2018' => ['committee' => 'prep'],
        '06-30-2018' => ['contract' => 'kill'],
    ],
]);

*/

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '04.15.2015',
    'appDate'        => '04.16.2015',
    'company'        => 'W2O Group',
    'title'          => 'Senior DevOps Engineer',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);

$jobs[] = Job::create([
    'status'         => 'applied',
    'searchDate'     => '05.05.2015',
    'appDate'        => '05.06.2015',
    'company'        => 'W2O Group',
    'title'          => 'DevOps Engineer',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    'interviews'     => [
        '06-18-2015' => 'phone',
    ],
]);
