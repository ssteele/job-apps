<?php

namespace SteveSteele\JobApp;

class LatexDocument implements Document
{

    private $path = '';
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
        $this->setPath($serverPath, $filePath);
        $this->setScript($serverPath, $filePath);
        $this->setFile($fileName);
    }


    /**
     * Path setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    private function setPath($serverPath = '', $filePath = '')
    {
        $this->path = rtrim($serverPath, '/') . '/' . rtrim($filePath, '/') . '/';
        return $this->path;
    }


    /**
     * Path getter
     * @return string    Path relative to server root
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Script setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    private function setScript($serverPath = '', $filePath = '')
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
     * Script getter
     * @return string    Path to latex generator script
     */
    public function getScript()
    {
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
     * File getter
     * @return string    Filename
     */
    public function getFile()
    {
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
