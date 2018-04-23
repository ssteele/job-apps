<?php

namespace SteveSteele\JobApp\Application;

class Potential extends Base
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
        $output .= '<span class="' . $action . '" id="' . $this->terminalFriendlyFilepath . '" data-type="php" data-path="' . JOBS_POSTINGS_PATH . '" data-url="' . $this->publicPosting . '">';

        // markup to render progress icon
        $output .= (AUTO_CURL_HTML_POSTINGS) ? '<i class="show-for-large-up fa fa-fw fa-' . $this->faType('generate') . '"></i>' : '';

        $output .= '(' . $this->searchDate . ')';
        $output .= '</span>';

        // markup to replace generator element after job posting fetched
        if (AUTO_CURL_HTML_POSTINGS) {
            $output .= '<span style="display:none" data-ref="' . $this->terminalFriendlyFilepath . '">[';
            $output .= '<a href="' . JOBS_URL . '/postings/' . $this->localFilePath . '.php">';
            $output .=     $this->searchDate;
            $output .= '</a>';
            $output .= ']</span>';
        }

        return $output;
    }

    /**
     * Render save link to locally persist the job posting
     * @return string    HTML markup
     */
    protected function jobPostingGenerator()
    {
        if ($this->letter) {
            $output = '';

            $action = (AUTO_CURL_HTML_POSTINGS) ? 'generate auto-curl-html' : 'copy-to-clipboard';
            $output .= '<span';
            $output .= '    class="show-for-large-up icon asset ' . $action . '"';
            $output .= '    id="' . $this->terminalFriendlyFilepath . '"';
            $output .= '    data-type="php"';
            $output .= '    data-path="' . JOBS_POSTINGS_PATH . '"';
            $output .= '    data-url="' . $this->publicPosting . '"';
            $output .= '>';
            $output .=     $this->faIcon('generate-posting');
            $output .= '</span>';

            return $output;
        }

        return false;
    }

    /**
     * Render cover letter link created for this job
     * @return string    HTML markup
     */
    protected function jobLetterGenerator()
    {
        if ($this->letter) {
            $output = '';

            $action = (AUTO_GENERATE_LATEX_DOCUMENTS) ? 'auto-generate-latex' : 'copy-to-clipboard';
            $output .= '<span';
            $output .= '    class="show-for-large-up icon asset ' . $action . '"';
            $output .= '    id="' . $this->terminalFriendlyFilepath . '"';
            $output .= '    data-type="pdf"';
            $output .= '    data-path="' . JOBS_COVER_LETTERS_PATH . '"';
            $output .= '>';
            $output .=     $this->faIcon('generate-letter');
            $output .= '</span>';

            return $output;
        }

        return false;
    }

    /**
     * Render resume link created for this job
     * @return string    HTML markup
     */
    protected function jobResumeGenerator()
    {
        if ($this->resume) {
            $output = '';

            $action = (AUTO_GENERATE_LATEX_DOCUMENTS) ? 'auto-generate-latex' : 'copy-to-clipboard';
            $output .= '<span';
            $output .= '    class="show-for-large-up icon asset ' . $action . '"';
            $output .= '    id="' . $this->terminalFriendlyFilepath . '"';
            $output .= '    data-type="pdf"';
            $output .= '    data-path="' . JOBS_RESUMES_PATH . '"';
            $output .= '>';
            $output .=     $this->faIcon('generate-resume');
            $output .= '</span>';

            return $output;
        }

        return false;
    }

    /**
     * Render generated assets
     * @return string    HTML markup
     */
    protected function jobInterviews()
    {
        $output = '';

        $output .= $this->jobResumeGenerator();
        $output .= $this->jobLetterGenerator();
        $output .= $this->jobPostingGenerator();

        return $output;
    }

    /**
     * Driver to render job application row
     * @param  boolean  $print    Echo if true
     */
    public function renderApplications($print = true)
    {
        return false;
    }

    /**
     * Driver to render potential job row
     * @param  boolean  $print    Echo if true
     */
    public function renderPotentials($print = true)
    {
        $output = $this->renderRow();

        if ($print) {
            echo $output;
        }

        return $output;
    }
}
