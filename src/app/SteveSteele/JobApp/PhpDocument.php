<?php

namespace SteveSteele\JobApp;

class PhpDocument implements Document
{

    private $path = '';
    private $file = '';
    private $template = 'template.php';


    /**
     * Constructor
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     * @param string $fileName      Name
     */
    public function __construct($serverPath = '', $filePath = '', $fileName = '')
    {
        $this->setPath($serverPath, $filePath);
        $this->setFile($fileName);
    }


    /**
     * PHP document path setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    private function setPath($serverPath = '', $filePath = '')
    {
        $this->path = rtrim($serverPath, '/') . '/' . rtrim($filePath, '/') . '/';
        return $this->path;
    }


    /**
     * File setter
     * @param string $fileName    Name
     */
    private function setFile($fileName = '')
    {
        $this->file = $fileName . '.php';
        return $this->file;
    }


    /**
     * Document generator
     * @return string    PHP generator output
     */
    public function generate()
    {
        $status = copy($this->path . $this->template, $this->path . $this->file);
        $output = ($status) ? 'Document generated' : 'Failed to generate PHP';

        return $output;
    }
}
