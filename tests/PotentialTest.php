<?php

namespace SteveSteele\JobApp;

use SteveSteele\JobApp\Application\Potential;
use PHPUnit\Framework\TestCase;

class PotentialTest extends TestCase
{
    private $fieldDefaults = [
        'status'        => '',
        'searchDate'    => '',
        'appDate'       => '',
        'searchLink'    => '',
        'title'         => '',
        'company'       => '',
        'location'      => '',
        'localPosting'  => true,
        'publicPosting' => '',
        'tags'          => [],
        'resume'        => true,
        'letter'        => true,
        'network'       => false,
        'headhunter'    => false,
        'salary'        => '',
        'interviews'    => [],
    ];

    public function verifyFields(Potential $job, array $input)
    {
        $input = array_merge($this->fieldDefaults, $input);

        $this->assertEquals($input['status'], $job->status);
        $this->assertEquals($input['searchDate'], $job->searchDate);
        $this->assertEquals($input['appDate'], $job->appDate);
        $this->assertEquals($input['searchLink'], $job->searchLink);
        $this->assertEquals($input['title'], $job->title);
        $this->assertEquals($input['company'], $job->company);
        $this->assertEquals($input['location'], $job->location);
        $this->assertEquals($input['localPosting'], $job->localPosting);
        $this->assertEquals($input['publicPosting'], $job->publicPosting);
        $this->assertEquals($input['tags'], $job->tags);
        $this->assertEquals($input['resume'], $job->resume);
        $this->assertEquals($input['letter'], $job->letter);
        $this->assertEquals($input['network'], $job->network);
        $this->assertEquals($input['headhunter'], $job->headhunter);
        $this->assertEquals($input['salary'], $job->salary);
        $this->assertEquals($input['interviews'], $job->interviews);
    }

    public function testBasicAppWithoutAssets()
    {
        $input = [
            'status'         => 'potential',
            'searchDate'     => '05.15.2015',
            'title'          => 'Junior DevOps Engineer',
            'company'        => 'W2O Group',
            'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
        ];
        $jobs[] = Job::create($input);
        $job = array_pop($jobs);

        $this->assertInstanceOf(Potential::class, $job);
        $this->verifyFields($job, $input);
        $this->assertFalse($job->renderApplications(false));
    }

    public function testComplexAppWithoutAssets()
    {
        $input = [
            'status'         => 'potential',
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
                '06-18-2015' => 'phone',
            ],
        ];
        $jobs[] = Job::create($input);
        $job = array_pop($jobs);

        $this->assertInstanceOf(Potential::class, $job);
        $this->verifyFields($job, $input);
        $this->assertFalse($job->renderApplications(false));
    }

    public function testBasicAppWithAssets()
    {
        $input = [
            'status'         => 'potential',
            'searchDate'     => '05.05.2015',
            'title'          => 'DevOps Engineer',
            'company'        => 'W2O Group',
            'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
        ];
        $jobs[] = Job::create($input);
        $job = array_pop($jobs);

        $this->assertInstanceOf(Potential::class, $job);
        $this->verifyFields($job, $input);
        $this->assertFalse($job->renderApplications(false));
    }

    public function testComplexAppWithAssets()
    {
        $input = [
            'status'         => 'potential',
            'searchDate'     => '05.05.2015',
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
                '06-18-2015' => 'phone',
            ],
        ];
        $jobs[] = Job::create($input);
        $job = array_pop($jobs);

        $this->assertInstanceOf(Potential::class, $job);
        $this->verifyFields($job, $input);
        $this->assertFalse($job->renderApplications(false));
    }
}
