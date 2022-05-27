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
    'status'         => 'potential',
    'searchDate'     => '05.15.2018',
    'appDate'        => '05.16.2018',
    'searchLink'     => 'Larajobs',
    'recruiter'      => 'Some Agency',
    'company'        => 'W2O Group',
    'title'          => 'DevOps Engineer',
    'role'           => 'contributor',
    'location'       => 'Austin',
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

$lastSearch = '05.15.2015';

$jobs[] = Job::create([
    'status'         => 'potential',
    'searchDate'     => '05.15.2015',
    'company'        => 'W2O Group',
    'title'          => 'Junior DevOps Engineer',
    'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
]);

/*

Default new application

$jobs[] = Job::create([
    'status'         => 'potential',
    'searchDate'     => '.2018',
    'title'          => '',
    'company'        => '',
    'publicPosting'  => '',
]);

*/
