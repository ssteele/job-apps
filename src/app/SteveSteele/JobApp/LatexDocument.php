<?php

namespace SteveSteele\JobApp;

class LatexDocument
{

    private $script = '';
    private $file = '';


    /**
     * Constructor
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     * @param string $fileName      Name
     */
    public function __construct($serverPath = '', $filePath = '', $fileName = '')
    {
        $this->setScript($serverPath, $filePath);
        $this->setFile($fileName);
    }


    /**
     * Latex generator script setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    private function setScript($serverPath = '', $filePath = '')
    {
        $this->script = $serverPath . '/' . $filePath . 'latex/generate-auto.bash';
        return $this->script;
    }


    /**
     * File setter
     * @param string $fileName    Name
     */
    private function setFile($fileName = '')
    {
        $this->file = $fileName;
        return $this->file;
    }


    /**
     * Document generator
     * @return string    Latex generator script output
     */
    public function generate()
    {
        $output = exec(escapeshellcmd($this->script . ' ' . $this->file), $commandLineOutput);
        return $output;
    }
}
