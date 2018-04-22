<?php

namespace SteveSteele\JobApp\DocumentGenerator;

class LatexDocument extends Base
{


    /**
     * Constructor
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     * @param string $fileName      Name
     * @param string $postUrl       Fetch URL
     */
    public function __construct($serverPath = '', $filePath = '', $fileName = '', $postUrl = '')
    {
        parent::__construct($serverPath, $filePath, $fileName, $postUrl);
        $this->setScript($serverPath, $filePath);
    }


    /**
     * Script setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    public function setScript($serverPath = '', $filePath = '')
    {
        $scriptPath = 'latex/generate-auto.bash';
        if (! $this->path) {
            $this->script = $this->path . $scriptPath;
        } else {
            $this->script = $this->setPath($serverPath, $filePath) . $scriptPath;
        }
        return $this->script;
    }


    /**
     * File setter
     * @param string $fileName    Name
     */
    public function setFile($fileName = '')
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
