<?php

namespace SteveSteele\JobApp;

class PotentialTest extends \PHPUnit_Framework_TestCase
{

    public function testRenderMethodsOnBasicAppWithoutAssets()
    {
        $jobs[] = Job::create([
            'status'         => 'potential',
            'searchDate'     => '05.15.2015',
            'title'          => 'Junior DevOps Engineer',
            'company'        => 'W2O Group',
            'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
        ]);

        $job = array_pop($jobs);
        $this->assertInstanceOf(Potential::class, $job);

        $expectedMarkup = '<div class="row hide-for-medium-up"><div class="small-12 columns mobile-pad"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; Junior DevOps Engineer</a></span></div></div><div class="row"><div class="small-3 medium-2 large-2 columns"><span class="postings"><span class="generate auto-curl-html" id="05-15-2015_junior_devops_engineer_w2o_group" data-type="php" data-path="src/jobs/postings" data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">(05.15.2015)<i class="fa fa-fw fa-refresh"></i></span><span style="display:none" data-ref="05-15-2015_junior_devops_engineer_w2o_group">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-15-2015_junior_devops_engineer_w2o_group.php">05.15.2015</a>]</span></span></div><div class="show-for-medium-up medium-5 large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; Junior DevOps Engineer</a></span></div><div class="small-6 medium-3 large-4 columns"></div><div class="small-3 medium-2 large-1 columns"><span class="icon submitted auto-generate-latex" id="05-15-2015_junior_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/resumes"><i class="fa fa-file-o"></i></span><span class="icon submitted auto-generate-latex" id="05-15-2015_junior_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/cover-letters"><i class="fa fa-envelope-o"></i></span></div></div>';
        $this->assertEquals($expectedMarkup, $job->renderPotentials(false));

        $this->assertFalse($job->renderApplications(false));
    }

    public function testRenderMethodsOnComplexAppWithoutAssets()
    {
        $jobs[] = Job::create([
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
        ]);

        $job = array_pop($jobs);
        $this->assertInstanceOf(Potential::class, $job);

        $expectedMarkup = '<div class="row hide-for-medium-up"><div class="small-12 columns mobile-pad"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-3 medium-2 large-2 columns"><span class="postings"><span class="generate auto-curl-html" id="05-15-2015_devops_engineer_w2o_group" data-type="php" data-path="src/jobs/postings" data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">(05.15.2015)<i class="fa fa-fw fa-refresh"></i></span><span style="display:none" data-ref="05-15-2015_devops_engineer_w2o_group">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-15-2015_devops_engineer_w2o_group.php">05.16.2015</a>]</span></span></div><div class="show-for-medium-up medium-5 large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="small-6 medium-3 large-4 columns"></div><div class="small-3 medium-2 large-1 columns"><span class="icon submitted auto-generate-latex" id="05-15-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/resumes"><i class="fa fa-file-o"></i></span><span class="icon submitted auto-generate-latex" id="05-15-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/cover-letters"><i class="fa fa-envelope-o"></i></span></div></div>';
        $this->assertEquals($expectedMarkup, $job->renderPotentials(false));

        $this->assertFalse($job->renderApplications(false));
    }

    public function testRenderMethodsOnBasicAppWithAssets()
    {
        $jobs[] = Job::create([
            'status'         => 'potential',
            'searchDate'     => '05.05.2015',
            'title'          => 'DevOps Engineer',
            'company'        => 'W2O Group',
            'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
        ]);

        $job = array_pop($jobs);
        $this->assertInstanceOf(Potential::class, $job);

        $expectedMarkup = '<div class="row hide-for-medium-up"><div class="small-12 columns mobile-pad"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-3 medium-2 large-2 columns"><span class="postings">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php">05.05.2015</a>]</span></div><div class="show-for-medium-up medium-5 large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="small-6 medium-3 large-4 columns"></div><div class="small-3 medium-2 large-1 columns"><span class="icon submitted auto-generate-latex" id="05-05-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/resumes"><i class="fa fa-file-o"></i></span><span class="icon submitted auto-generate-latex" id="05-05-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/cover-letters"><i class="fa fa-envelope-o"></i></span></div></div>';
        $this->assertEquals($expectedMarkup, $job->renderPotentials(false));

        $this->assertFalse($job->renderApplications(false));
    }

    public function testRenderMethodsOnComplexAppWithAssets()
    {
        $jobs[] = Job::create([
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
        ]);

        $job = array_pop($jobs);
        $this->assertInstanceOf(Potential::class, $job);

        $expectedMarkup = '<div class="row hide-for-medium-up"><div class="small-12 columns mobile-pad"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-3 medium-2 large-2 columns"><span class="postings">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php">05.16.2015</a>]</span></div><div class="show-for-medium-up medium-5 large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="small-6 medium-3 large-4 columns"></div><div class="small-3 medium-2 large-1 columns"><span class="icon submitted auto-generate-latex" id="05-05-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/resumes"><i class="fa fa-file-o"></i></span><span class="icon submitted auto-generate-latex" id="05-05-2015_devops_engineer_w2o_group" data-type="pdf" data-path="src/jobs/cover-letters"><i class="fa fa-envelope-o"></i></span></div></div>';
        $this->assertEquals($expectedMarkup, $job->renderPotentials(false));

        $this->assertFalse($job->renderApplications(false));
    }
}
