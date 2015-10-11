<?php

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

$last_search = '05.15.2015';

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
