<?php

namespace SteveSteele\JobApp;

class HtmlPostingTest extends \PHPUnit_Framework_TestCase
{

    public $serverPath;
    public $filePath;
    public $fileName;
    public $postUrl;
    public $htmlPosting;

    public function setup()
    {
        $this->serverPath = $_SERVER['DOCUMENT_ROOT'];
        $this->filePath = JOBS_POSTINGS_PATH;
        $this->fileName = '05-15-2015_junior_devops_engineer_w2o_group';
        $this->postUrl = APP_URL . '/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php';

        $this->htmlPosting = new HtmlPosting($this->serverPath, $this->filePath, $this->fileName, $this->postUrl);
    }

    public function testConstruct()
    {
        $this->assertEquals('/' . $this->filePath . '/', $this->htmlPosting->getPath());
        $this->assertEquals($this->fileName . '.php', $this->htmlPosting->getFile());
        $this->assertEquals($this->postUrl, $this->htmlPosting->getUrl());
    }
}
