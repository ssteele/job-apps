<?php

namespace SteveSteele\JobApp\DocumentGenerator;

use PHPUnit\Framework\TestCase;

class PhpDocumentTest extends TestCase
{

    public $serverPath;
    public $filePath;
    public $fileName;
    public $phpDocument;

    public function setup()
    {
        $this->serverPath = $_SERVER['PWD'];
        $this->filePath = JOBS_INTERVIEWS_PATH;
        $this->fileName = '06-01-2015_junior_devops_engineer_w2o_group';

        $this->phpDocument = new PhpDocument($this->serverPath, $this->filePath, $this->fileName);
    }

    public function testConstruct()
    {
        $this->assertEquals($this->serverPath . '/' . $this->filePath . '/', $this->phpDocument->getPath());
        $this->assertEquals($this->fileName . '.php', $this->phpDocument->getFile());
    }

    public function testGenerate()
    {
        $expectedMessage = 'Document generated';
        $this->assertEquals($expectedMessage, $this->phpDocument->generate());

        $expectedFile = $this->phpDocument->getPath() . $this->phpDocument->getFile();
        $this->assertFileExists($expectedFile);

        // delete generated file if exists
        if (file_exists($expectedFile)) {
            unlink($expectedFile);
        }
    }
}
