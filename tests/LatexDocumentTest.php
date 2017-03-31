<?php

namespace SteveSteele\JobApp;

class LatexDocumentTest extends \PHPUnit_Framework_TestCase
{

    public $serverPath;
    public $filePath;
    public $fileName;
    public $latexDocument;

    public function setup()
    {
        $this->serverPath = $_SERVER['PWD'];
        $this->filePath = JOBS_RESUMES_PATH;
        $this->fileName = '05-15-2015_junior_devops_engineer_w2o_group';

        $this->latexDocument = new LatexDocument($this->serverPath, $this->filePath, $this->fileName);
    }

    public function testConstruct()
    {
        $this->assertEquals($this->serverPath . '/' . $this->filePath . '/', $this->latexDocument->getPath());
        $this->assertEquals($this->latexDocument->getPath() . 'latex/generate-auto.bash', $this->latexDocument->getScript());
        $this->assertEquals($this->fileName, $this->latexDocument->getFile());
    }

    public function testGenerate()
    {
        $latexFile = $this->latexDocument->getPath() . 'latex/cv_steve-steele';

        // copy current files so that we can reset after auto-generation
        $extensions = ['dvi', 'pdf', 'log'];
        foreach ($extensions as $extension) {
            copy($latexFile . '.' . $extension, $latexFile . '.' . $extension . '.orig');
        }

        $expectedMessage = 'Document generated';
        $this->assertEquals($expectedMessage, $this->latexDocument->generate());

        $expectedFile = $this->latexDocument->getPath() . $this->latexDocument->getFile();
        $this->assertFileExists($expectedFile . '.pdf');

        // file resets
        if (file_exists($expectedFile . '.pdf')) {
            // delete generated files if exist
            unlink($expectedFile . '.tex');
            unlink($expectedFile . '.pdf');

            // reset to original latex files
            foreach ($extensions as $extension) {
                rename($latexFile . '.' . $extension . '.orig', $latexFile . '.' . $extension);
            }
        } else {
            foreach ($extensions as $extension) {
                // remove copied files
                unlink($latexFile . '.' . $extension . '.orig');
            }
        }
    }
}
