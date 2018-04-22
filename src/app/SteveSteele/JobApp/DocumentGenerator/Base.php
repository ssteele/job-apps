<?php

namespace SteveSteele\JobApp\DocumentGenerator;

abstract class Base implements Contract
{
    protected $path = '';
    protected $script = '';
    protected $file = '';
    protected $url = '';
    protected $template = '';

    /**
     * Constructor
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     * @param string $fileName      Name
     * @param string $postUrl       Fetch URL
     */
    public function __construct($serverPath = '', $filePath = '', $fileName = '', $postUrl = '')
    {
        $this->setPath($serverPath, $filePath);
        $this->setFile($fileName);
    }

    /**
     * Path setter
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     */
    protected function setPath($serverPath = '', $filePath = '')
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
     * Script getter
     * @return string    Path to latex generator script
     */
    public function getScript()
    {
        return $this->script;
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
     * URL getter
     * @return string    Source job posting URL
     */
    public function getUrl()
    {
        return $this->url;
    }
}
