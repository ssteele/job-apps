<?php

namespace SteveSteele\JobApp\DocumentGenerator;

class PhpDocument extends Base
{

    private $template = '_template.php';

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
