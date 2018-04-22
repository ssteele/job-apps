<?php

namespace SteveSteele\JobApp\Application;

abstract class Processed extends Base
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
     * @param  boolean  $print    Echo if true
     */
    public function renderApplications($print = true)
    {
        $output = $this->renderRow();

        if ($print) {
            echo $output;
        }

        return $output;
    }

    /**
     * Driver to render potential job row
     * @param  boolean  $print    Echo if true
     */
    public function renderPotentials($print = true)
    {
        return false;
    }
}
