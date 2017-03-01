<?php

namespace SteveSteele\JobApp;

abstract class Processed extends Application
{

    /**
     * Render job application date
     * @return string    HTML markup
     */
    protected function jobApplicationDate()
    {
        $output = '';
        $output .= '<span class="applied-for"></span>';

        $output .= parent::jobApplicationDate();

        return $output;
    }


    /**
     * Driver to render job application row
     */
    public function renderApplications()
    {
        $this->renderRow();
    }


    /**
     * Driver to render potential job row
     */
    public function renderPotentials()
    {
        return false;
    }

}
