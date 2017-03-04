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
        if ($this->letter) {
            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->terminalFriendlyFilepath . '.pdf">';
            $output .= '    <i class="fa fa-envelope-o"></i>';
            $output .= '</span>';

            return $output;
        }

        return false;
    }


    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function jobResume()
    {
        if ($this->resume) {
            $output = '';

            $output .= '<span class="icon submitted copy-to-clipboard" id="' . $this->terminalFriendlyFilepath . '.pdf">';
            $output .= '    <i class="fa fa-file-o"></i>';
            $output .= '</span>';

            return $output;
        }

        return false;
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
