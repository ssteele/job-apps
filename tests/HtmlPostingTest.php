<?php

namespace SteveSteele\JobApp\DocumentGenerator;

use PHPUnit\Framework\TestCase;

class HtmlPostingTest extends TestCase
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
        $this->postUrl = 'http://www.steve-steele.com/content/themes/stevesteele/job-apps-unittest-asset.php';

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
