<?php

namespace SteveSteele\JobApp;

use SteveSteele\JobApp\Application\Potential;
use PHPUnit\Framework\TestCase;

class PotentialTest extends TestCase
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

        $expectedMarkup = '<div class="row hide-for-large-up collapse"><div class="small-12 columns mobile-row"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; Junior DevOps Engineer</a></span></div></div><div class="row"><div class="small-6 medium-3 large-2 columns"><span class="postings">(05.15.2015)</span></div><div class="show-for-large-up large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; Junior DevOps Engineer</a></span></div><div class="show-for-medium-up medium-7 large-4 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_junior_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_junior_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-15-2015_junior_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div><div class="small-6 medium-2 large-1 columns"></div></div>';
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

        $expectedMarkup = '<div class="row hide-for-large-up collapse"><div class="small-12 columns mobile-row"><span class="online"><a class="potential interviewing" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-6 medium-3 large-2 columns"><span class="postings">(05.15.2015)</span></div><div class="show-for-large-up large-5 columns"><span class="online"><a class="potential interviewing" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="show-for-medium-up medium-7 large-4 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-15-2015_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div><div class="small-6 medium-2 large-1 columns"></div></div><div class="hide-for-medium-up small-12 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-15-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-15-2015_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div>';
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

        $expectedMarkup = '<div class="row hide-for-large-up collapse"><div class="small-12 columns mobile-row"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-6 medium-3 large-2 columns"><span class="postings">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php">05.05.2015</a>]</span></div><div class="show-for-large-up large-5 columns"><span class="online"><a class="potential" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="show-for-medium-up medium-7 large-4 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-05-2015_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div><div class="small-6 medium-2 large-1 columns"><a href="src/jobs/resumes/05-05-2015_devops_engineer_w2o_group.pdf" class="icon asset" title="Resume"><i class="fa fa-fw fa-file" aria-hidden="true"></i></a><a href="src/jobs/cover-letters/05-05-2015_devops_engineer_w2o_group.pdf" class="icon asset" title="Cover Letter"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i></a></div></div>';
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

        $expectedMarkup = '<div class="row hide-for-large-up collapse"><div class="small-12 columns mobile-row"><span class="online"><a class="potential interviewing" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div></div><div class="row"><div class="small-6 medium-3 large-2 columns"><span class="postings">[<a href="http://shs.job-apps.com:8888/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php">05.05.2015</a>]</span></div><div class="show-for-large-up large-5 columns"><span class="online"><a class="potential interviewing" href="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs">W2O Group &#8226; DevOps Engineer</a></span></div><div class="show-for-medium-up medium-7 large-4 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-05-2015_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div><div class="small-6 medium-2 large-1 columns"><a href="src/jobs/resumes/05-05-2015_devops_engineer_w2o_group.pdf" class="icon asset" title="Resume"><i class="fa fa-fw fa-file" aria-hidden="true"></i></a><a href="src/jobs/cover-letters/05-05-2015_devops_engineer_w2o_group.pdf" class="icon asset" title="Cover Letter"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i></a></div></div><div class="hide-for-medium-up small-12 columns"><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/resumes"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset auto-generate-latex"    id="05-05-2015_devops_engineer_w2o_group"    data-type="pdf"    data-path="src/jobs/cover-letters"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i></span><span    class="show-for-large-up icon asset generate auto-curl-html"    id="05-05-2015_devops_engineer_w2o_group"    data-type="php"    data-path="src/jobs/postings"    data-url="http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs"><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i></span></div>';
        $this->assertEquals($expectedMarkup, $job->renderPotentials(false));

        $this->assertFalse($job->renderApplications(false));
    }
}
