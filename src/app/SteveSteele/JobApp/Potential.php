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

        // generator markup
        $action = (AUTO_CURL_HTML_POSTINGS) ? 'generate auto-curl-html' : 'copy-to-clipboard';
        $output .= '<span class="' . $action . '" id="' . $this->terminalFriendlyFilepath . '" data-type="php" data-path="' . JOBS_POSTINGS_PATH . '" data-url="' . $this->publicPosting . '">(';
        $output .=      $this->searchDate;
        $output .= ')';

        // markup to render progress icon
        $output .= '<i class="fa fa-fw fa-refresh"></i>';
        $output .= '</span>';

        // markup to replace generator element after job posting fetched
        $output .= '<span style="display:none" data-ref="' . $this->terminalFriendlyFilepath . '">[';
        $output .= '<a href="' . JOBS_URL . 'postings/' . $this->localFilePath . '.php">';
        $output .=     $this->officialDate;
        $output .= '</a>';
        $output .= ']</span>';

        return $output;
    }


    /**
     * Do not render job interviews for potential applications
     * @return boolean    False always
     */
    protected function jobInterviews()
    {
        return false;
    }


    /**
     * Render cover letter link created for this job
     * @return string    HTML markup
     */
    protected function jobLetter()
    {
        if ($this->letter) {
            $output = '';

            $action = (AUTO_GENERATE_LATEX_DOCUMENTS) ? 'auto-generate-latex' : 'copy-to-clipboard';
            $output .= '<span class="icon submitted ' . $action . '" id="' . $this->terminalFriendlyFilepath . '" data-type="pdf" data-path="' . JOBS_COVER_LETTERS_PATH . '">';
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

            $action = (AUTO_GENERATE_LATEX_DOCUMENTS) ? 'auto-generate-latex' : 'copy-to-clipboard';
            $output .= '<span class="icon submitted ' . $action . '" id="' . $this->terminalFriendlyFilepath . '" data-type="pdf" data-path="' . JOBS_RESUMES_PATH . '">';
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
