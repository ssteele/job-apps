<?php

namespace SteveSteele\JobApp\DocumentGenerator;

class TextDocument extends Base
{

    private $template = 'latex/cover_steve-steele.txt';

    /**
     * File setter
     * @param string $fileName    Name
     */
    public function setFile($fileName = '')
    {
        $this->file = $fileName . '.txt';
        return $this->file;
    }


    /**
     * Document generator
     * @return string    PHP generator output
     */
    public function generate()
    {
        $status = copy($this->path . $this->template, $this->path . $this->file);
        $output = ($status) ? 'Document generated' : 'Failed to copy Text';

        return $output;
    }
}
