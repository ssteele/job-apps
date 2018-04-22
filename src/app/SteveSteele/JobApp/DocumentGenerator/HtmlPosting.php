<?php

namespace SteveSteele\JobApp\DocumentGenerator;

class HtmlPosting extends Base
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
        $this->setUrl($postUrl);
    }


    /**
     * File setter
     * @param string $fileName    Name
     */
    public function setFile($fileName = '')
    {
        $this->file = $fileName . '.php';
        return $this->file;
    }


    /**
     * URL setter
     * @param string $postUrl    Source job posting URL
     */
    public function setUrl($postUrl = '')
    {
        $this->url = $postUrl;
        return $this->url;
    }


    /**
     * Fetch job posting via cURL and save locally
     * @return boolean    True on success; False otherwise
     */
    private function curlPosting()
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
