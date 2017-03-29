<?php

namespace SteveSteele\JobApp;

class HtmlPosting implements Document
{

    private $path = '';
    private $file = '';
    private $url = '';


    /**
     * Constructor
     * @param string $serverPath    Absolute server path
     * @param string $filePath      Path relative to server root
     * @param string $fileName      Name
     */
    public function __construct($serverPath = '', $filePath = '', $fileName = '', $postUrl = '')
    {
        $this->setPath($serverPath, $filePath);
        $this->setFile($fileName);
        $this->setUrl($postUrl);
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
     * File setter
     * @param string $fileName    Name
     */
    private function setFile($fileName = '')
    {
        $this->file = $fileName . '.php';
        return $this->file;
    }


    /**
     * File getter
     * @return string    Name
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * URL setter
     * @param string $postUrl    Source job posting URL
     */
    private function setUrl($postUrl = '')
    {
        $this->url = $postUrl;
        return $this->url;
    }


    /**
     * URL getter
     * @return string    Source job posting URL
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * Fetch job posting via cURL and save locally
     * @return boolean    True on success; False otherwise
     */
    public function curlPosting()
    {
        $ch = curl_init($this->url);
        $fp = fopen($this->path . $this->file, 'w');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $error = '';
        if (! $status = curl_exec($ch)) {
            $error = curl_error($ch);
        }
        curl_close($ch);
        fclose($fp);

        return $status;
    }


    /**
     * Document generator
     * @return string    PHP generator output
     */
    public function generate()
    {
        $status = $this->curlPosting();
        $output = ($status) ? 'Document generated' : 'Failed to fetch job posting';

        return $output;
    }
}
