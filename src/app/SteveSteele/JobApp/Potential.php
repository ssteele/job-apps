<?php

namespace SteveSteele\JobApp;

class Potential extends Application
{

    /**
     * Application date markup
     * ...overridden here to add copy to clipboard functionality
     * @return string    Application date
     */
    protected function officialDateMarkup()
    {
        $output = '';

        $output .= '<span class="copy-to-clipboard" id="' . $this->terminalFriendlyFilepath . '.php">';
        $output .=     $this->searchDate;
        $output .= '</span>';

        return $output;
    }


    /**
     * Render cover letter link created for this job
     * @return string    HTML markup
     */
    protected function jobLetter()
    {
        $return = parent::jobLetter();

        if ($this->letter && false === $return) {
            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->terminalFriendlyFilepath . '.pdf">';
            $output .= '    <i class="fa fa-envelope-o"></i>';
            $output .= '</span>';

            return $output;
        }

        return $return;
    }


    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function jobResume()
    {
        $return = parent::jobResume();

        if ($this->resume && false === $return) {
            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->terminalFriendlyFilepath . '.pdf">';
            $output .= '    <i class="fa fa-file-o"></i>';
            $output .= '</span>';

            return $output;
        }

        return $return;
    }


    /**
     * Driver to render job application row
     */
    public function renderApplications()
    {
        return false;
    }


    /**
     * Driver to render potential job row
     */
    public function renderPotentials()
    {
        $this->renderRow();
    }
}
