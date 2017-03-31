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
        $this->serverPath = $_SERVER['PWD'];
        $this->filePath = JOBS_POSTINGS_PATH;
        $this->fileName = '05-15-2015_junior_devops_engineer_w2o_group';
        $this->postUrl = APP_URL . '/src/jobs/postings/05-05-2015_devops_engineer_w2o_group.php';

        $this->htmlPosting = new HtmlPosting($this->serverPath, $this->filePath, $this->fileName, $this->postUrl);
    }

    public function testConstruct()
    {
        $this->assertEquals($this->serverPath . '/' . $this->filePath . '/', $this->htmlPosting->getPath());
        $this->assertEquals($this->fileName . '.php', $this->htmlPosting->getFile());
        $this->assertEquals($this->postUrl, $this->htmlPosting->getUrl());
    }

    public function testGenerate()
    {
        $expectedMessage = 'Document generated';
        $this->assertEquals($expectedMessage, $this->htmlPosting->generate());

        $expectedFile = $this->htmlPosting->getPath() . $this->htmlPosting->getFile();
        $this->assertFileExists($expectedFile);

        // delete generated file if exists
        if (file_exists($expectedFile)) {
            unlink($expectedFile);
        }
    }
}
